<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('message', $this->session->userdata('site_lang'));
        $this->layoutfolder = $this->config->item("layoutfolder");
        //$this->encrypt->set_cipher(MCRYPT_BLOWFISH);
        $this->UserFrom();
        $config = array("question_format" => "numeric",
            "operation" => "addition");
        $this->mathcaptcha->init($config);
        $userNameCnd = array("stp_username" => $this->session->userdata("UserName"));
        //$this->user = current($this->Adminmodel->CSearch($userNameCnd, "stp_username as UserName", "stp"));
        //$this->userid = current($this->Adminmodel->CSearch($userNameCnd, "stp_id as UserId", "stp"));
        //$this->userRole = current($this->Adminmodel->CSearch($userNameCnd, "stp_role as UserRole", "stp", "", TRUE));
        //$this->userDesg = current($this->Adminmodel->CSearch($userNameCnd, "des_name as Desgination", "stp", "", TRUE));
        date_default_timezone_set('Asia/Kolkata');
    }

    protected function UserFrom() {
        if ($this->agent->is_browser()) {
            return $this->UserAcess = $this->agent->platform() . ' and ' . $this->agent->browser() . ' - ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            return $this->UserAcess = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            return $this->UserAcess = $this->agent->mobile();
        } else {
            return $this->UserAcess = 'Unidentified User Agent';
        }
    }

    public function render($Render, $RenderData = null) {
        $Layout = "layout/body";
        $this->render = $Render;
        $this->load->view($Layout, $RenderData);
    }

    public function Inti($Class) {
        $ClassNo = array(array("register"), "homepage" => array("forgotpwd"));
        if (!(in_array($this->router->fetch_method(), $ClassNo[$Class]))) {
            if (empty($_SESSION["UserId"])) {
                $AuthVal = $this->auth->Authencation("Y", "error");
                if (!$AuthVal) {
                    $this->session->set_flashdata('LoginError', 'User Name or Password is not matches');
                    redirect("/");
                }
            }
        }
        $CtrlRole = $this->db->where(array("stp_id" => $_SESSION["UserId"]))->join("user_role", "role_id=stp_role")->get("staffprofile")->row_array();
        if ((!empty($CtrlRole)) && ($CtrlRole['role_name'] == strtoupper($Class))) {
            if (strtoupper($_SESSION["UserRole"]) == strtoupper($Class)) {
                return true;
            } else {
                redirect("/" . strtolower($CtrlRole['role_name']) . "/logs");
            }
        } else {
            if (!empty($CtrlRole['role_name'])) {
                redirect("/" . strtolower($CtrlRole['role_name']) . "/logs");
            } else {
                redirect("/error/logs/InitiThrought");
            }
        }
    }

    public function Logout() {
        $this->session->sess_destroy();
        session_unset();
        session_destroy();
        $this->session->set_userdata("Auth", "Y");

        exit($this->load->view("error/login", get_defined_vars(), true));
    }

    public function accessdeined() {
        $this->render("accessdeined", get_defined_vars());
    }

    public function SendEmail($EmailTo, $Message, $ReturnData, $Subject, $EmailBcc) {
        try {
            $mail = $this->emailConfig();
            $mail->setFrom('atrocitymgnt@gmail.com', 'Atrocity Case Management');
            $mail->addAddress($EmailTo);     // Add a recipient
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $Subject;
            $mail->Body = $Message;
            if (!$mail->Send()) {
                return 1;
            } else {
                return 0;
            }
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        }
    }

    protected function emailConfig() {
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'tls://smtp.gmail.com:587';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = "atrocitymgnt@gmail.com";                 // SMTP username
        $mail->Password = "rmkenggcollege";
        return $mail;
    }

    public function forms($option) {
        switch (strtolower($option)):
            case "password_reset":
                $this->render(strtolower($option), get_defined_vars());
                break;
        endswitch;
    }

    /* Form Validation Starts Here */

    public function form_validation($option) {
        switch (strtolower($option)) {
            case "user":
                $rules = array(
                    array('field' => 'fullname', 'label' => 'Full Name ', 'rules' => 'required'),
                );
                break;
            case "casehistory":
                $rules = array(
                    array('field' => 'casehistory', 'label' => 'Case History ', 'rules' => 'required|max_length[400]'),
                );
                break;

            case "password":
                $rules = array(
                    array('field' => 'oldpassword', 'label' => 'Old Password', 'rules' => 'required'),
                    array('field' => 'newpassword', 'label' => 'New Password', 'rules' => 'required'),
                    array('field' => 'confirmationpassword', 'label' => 'Confirmation Password', 'rules' => 'required|match[newpassword]'),
                );
                break;

            case "login":
                $rules = array(
                    array('field' => 'emailid', 'label' => 'Email ID', 'rules' => 'required|valid_email'),
                    array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
                );
                break;
            case "forgot":
                $rules = array(
                    array('field' => 'emailid', 'label' => 'Email ID', 'rules' => 'required|valid_email'),

                    array('field' => 'verificationcode', 'label' => 'Verification Code', 'rules' => 'required'),
                    array('field' => 'newpassword', 'label' => 'New Password', 'rules' => 'required'),
                    array('field' => 'confirmationpassword', 'label' => 'Confirmation Password', 'rules' => 'required|match[newpassword]'),

                    array('field' => 'mobilenumber', 'label' => 'Mobile Number', 'rules' => 'required'),

                );
                break;


            case "userreg":
                $rules = array(
                    array('field' => 'PersonName', 'label' => 'Person Name', 'rules' => 'required|max_length[30]|alpha'),
                    array('field' => 'EmailID', 'label' => 'Email ID', 'rules' => 'required|valid_email'),
                    array('field' => 'Password', 'label' => 'Password', 'rules' => 'required|max_length[5]'),
                    array('feild' => 'ConfirmationPassword', 'label' => 'Confirmation Password', 'rules' => 'requird|match[Password]'),
                    array('field' => 'Address1', 'label' => 'Address1', 'rules' => 'required'),
                    array('feild' => 'Address2', 'label' => 'Address2', 'rules' => 'requird'),
                    array('field' => 'AadhaarNumber', 'label' => 'Aadhaar Number', 'rules' => 'required|exact_length[12]'),
                    array('field' => 'MobileNumber', 'label' => 'Mobile Number', 'rules' => 'required|integer|exact_length[10]'),
                    array('field' => 'City', 'label' => 'Name', 'City' => 'required'),
                    array('field' => 'State', 'label' => 'Name', 'State' => 'required'),
                    array('field' => 'UserName', 'label' => 'User Name', 'rules' => 'required|max_length[35]'),
                    array('field' => 'Country', 'label' => 'Country', 'rules' => 'required'),
                    array('field' => 'Role', 'label' => 'Role', 'rules' => 'required')
                );

                break;
            case "profile":
                $rules = array(
                    array('field' => 'PersonName', 'label' => 'Name', 'rules' => 'required|max_length[25]|alpha'),
                    array('field' => 'EmailID', 'label' => 'Email ID', 'rules' => 'required|valid_email'),
                    array('field' => 'Address1', 'label' => 'Address1', 'rules' => 'required'),
                    array('feild' => 'Address2', 'label' => 'Address2', 'rules' => 'requird'),
                    array('field' => 'AadhaarNumber', 'label' => 'Aadhaar Number', 'rules' => 'required|max_length[12]'),
                    array('field' => 'MobileNumber', 'label' => 'Mobile Number', 'rules' => 'required|exact_length[10]|integer'),
                    array('field' => 'City', 'label' => 'Name', 'City' => 'required'),
                    array('field' => 'State', 'label' => 'Name', 'State' => 'required'),
                    array('field' => 'Username', 'label' => 'User Name', 'rules' => 'required|max_length[35]'),
                    array('field' => 'Country', 'label' => 'Country', 'rules' => 'required'),
                    array('field' => 'Role', 'label' => 'Role', 'rules' => 'required')
                );
                break;
            case "cases":
                $rules = array(
                    array('field' => 'victimname', 'label' => 'Name', 'rules' => 'required|alpha'),
                    array('field' => 'victimemail', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'victimaddress', 'label' => 'Address', 'rules' => 'required'),
                    array('field' => 'victimaadhaar', 'label' => 'Aadhaar Number', 'rules' => ''),
                    array('field' => 'victimmobile', 'label' => 'Mobile Number', 'rules' => 'required|integer'),
                    array('field' => 'victimcity', 'label' => 'City', 'City' => 'required'),
                    array('field' => 'victimstate', 'label' => 'State', 'State' => 'required'),
                    array('field' => 'offendername', 'label' => 'Name', 'rules' => 'required|alpha'),
                    array('field' => 'offenderaddress', 'label' => 'Address', 'rules' => 'required'),
                    array('field' => 'offendermobile', 'label' => 'Mobile Number', 'rules' => 'integer'),
                    array('field' => 'offendercity', 'label' => 'City', 'rules' => 'required'),
                    array('field' => 'ifothers', 'label' => 'If Others', 'rules' => 'max_length[100]'),
                    array('field' => 'offenderstate', 'label' => 'State', 'rules' => 'required'),
                    array('field' => 'offencedate', 'label' => 'Offence Date', 'rules' => 'required'),
                    array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required'),
                    array('field' => 'casedescription', 'label' => 'Case Description', 'rules' => 'required|min_length[10]|max_length[400]'),
                    array('field' => 'victimdob', 'label' => 'Date Of Birth', 'rules' => 'required'),
                    array('field' => 'victimemail', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required'),
                );

                break;
        }
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE):
            return FALSE;
        else :
            return TRUE;
        endif;
    }

    /* Form Validation Ends Here */

    public function addtoDB() {
        $postData = $this->input->post();
        if ($this->form_validation("casehistory")):
        //logic
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
    }

    public function casehistorysave() {
        $postData = $this->input->post();

        if ($this->form_validation("casehistory")):
            echo "<pre>";
            print_r($postData);
            exit();
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function casessave() {
        $postData = $this->input->post();
        if ($this->form_validation("cases")):
            echo "<pre>";
            print_r($postData);
            exit();
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }



    public function passwordchange() {
        $postData = $this->input->post();
        if ($this->form_validation("password")):
            echo "<pre>";
            print_r($postData);
            exit();
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function forgotsave() {
        $postData = $this->input->post();

        if ($this->form_validation("forgot")):
            echo "<pre>";
            print_r($postData);
            exit();
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function loginsave() {
        $postData = $this->input->post();
        if ($this->form_validation("login")):
            echo "<pre>";
            print_r($postData);
            exit();
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function userregister() {
        $postData = $this->input->post();
        if ($this->form_validation("userreg")):
            echo "<pre>";
            print_r($postData);
            exit();
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function profilesave() {
        $postData = $this->input->post();
        if ($this->form_validation("profile")):
            echo "<pre>";
            print_r($postData);
            exit();
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cases($options = null) {
        $render = "";
        switch (strtolower($options)) {
            case "newcase";
                $render = "showregistercase";
                break;
            case "allcases";
                $render = "showallcases";
                break;
            case "casehistory";
                $render = "showcasehistory";
                break;
            default:
                $caseregister = $this->getcase_register();
                $caseallcases = $this->getcase_allcases();
                $casehistory = $this->getcase_casehistory();
                $render = "cases";
                break;
        }
        $this->render($render, get_defined_vars());
    }

    public function casehistory($options = null, $id = null) {
        $render = "";
        switch (strtolower($options)) {
            case "show";
                $render = "casehistory";

               /*$postData = $this->input->post();
                if ($this->form_validation("casehistory")):
                    //add to database
                    $condition = array("casehistoryid"=>"");
                    $select = "casehistoryid as casehisid";
                    $result = $this->Adminmodel->CSearch($condition, $select, "casehis", "", "", "", "", "", "", "");
                    echo "<pre>";
                    print_r(get_defined_vars($result));
                    exit();

                    if (!empty($result)):
                        $condition = array("casehistoryid" => "");
                        $DBData = array("password" => $postData['newPassword']);

                    else:

                    endif;

                    $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "casehis");
                    if (!empty($response)):
                        $Message = $this->load->view("emaillayouts/userpasswordupdate", get_defined_vars(), true);
                        $Subject = "Atrocity Case Management - Your password has been updated.";
                        $this->SendEmail(trim($result['EmailID']), $Message, "N", $Subject, "");
                        $this->session->set_flashdata('ME_SUCCESS', 'Password Changed Successfully');
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Data not Saved. Kindly Re Enter');
                    endif;
                else:
                    $_SESSION['formError'] = validation_errors();
                    $this->session->set_flashdata('ME_FORM', "ERROR");
                endif;
                $this->load->view('administrator/casehistory/casehistory');
                */


                break;
            default:
                $caseregister = $this->getcase_register();
                $caseallcases = $this->getcase_allcases();
                $casehistory = $this->getcase_casehistory();
                $render = "cases";

                break;

       
        
        default:
        $caseregister = $this->getcase_register();
        $caseallcases = $this->getcase_allcases();
        $casehistory = $this->getcase_casehistory();
        $render = "cases";
        break;
        }
        $this->render($render, get_defined_vars());
    }

    public function email($options = null) {
        $render = "";
        switch (strtolower($options)) {
            case "show";
                $render = "inbox";
                break;
            case "composemail";
                $render = "compose";
                break;
            default:
                $caseregister = $this->getcase_register();
                $caseallcases = $this->getcase_allcases();
                $casehistory = $this->getcase_casehistory();
                $render = "cases";
                break;
        }
        $this->render($render, get_defined_vars());
    }

}
