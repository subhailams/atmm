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
        $userNameCnd = array("username" => $this->session->userdata("UserName"));
        $this->user = current($this->Adminmodel->CSearch($userNameCnd, "username as UserName", "usr", "", "", "", "", "", "", ""));
        $this->userid = current($this->Adminmodel->CSearch($userNameCnd, "user_id as UserId", "usr", "", "", "", "", "", "", ""));
        $this->userRole = current($this->Adminmodel->CSearch($userNameCnd, "role as UserRole", "usr", "Y", "Y", "", "", "", "", ""));
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

    public function showallusers() {
        $this->render("showallusers", get_defined_vars());
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
        $CtrlRole = $this->db->where(array("user_id" => $_SESSION["UserId"]))->join("roles", "roleid=role")->get("users")->row_array();
        if ((!empty($CtrlRole)) && (strtoupper($CtrlRole['rolename']) == strtoupper($Class))) {
            if (strtoupper($_SESSION["UserRole"]) == strtoupper($Class)) {
                return true;
            } else {
                redirect("/index.php/" . strtolower($CtrlRole['rolename']) . "/index");
            }
        } else {
            if (!empty($CtrlRole['rolename'])) {
                redirect("/index.php/" . strtolower($CtrlRole['rolename']) . "/index");
            } else {
                redirect("/error/logs/InitiThrought");
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        session_unset();
        session_destroy();
        $this->session->set_userdata("Auth", "Y");
        $_SESSION = null;
        exit($this->load->view("homepage/login", get_defined_vars(), true));
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
        $mail->Password = "rmkenggcollegee";
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
                    array('field' => 'confirmationpassword', 'label' => 'Confirmation Password', 'rules' => 'required'),
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
                    array('field' => 'Name', 'label' => 'Name', 'rules' => 'max_length[25]'),
                    array('field' => 'EmailID', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'Address1', 'label' => 'Address1', 'rules' => ''),
                    array('feild' => 'Address2', 'label' => 'Address2', 'rules' => ''),
                    array('field' => 'AadhaarNumber', 'label' => 'Aadhaar Number', 'rules' => ''),
                    array('field' => 'MobileNumber', 'label' => 'Mobile Number', 'rules' => ''),
                    array('field' => 'City', 'label' => 'city', 'rules' => ''),
                    array('field' => 'State', 'label' => 'State', 'rules' => ''),
                    array('field' => 'UserName', 'label' => 'User Name', 'rules' => ''),
                    array('field' => 'Country', 'label' => 'Country', 'rules' => ''),
                    array('field' => 'Role', 'label' => 'Role', 'rules' => '')
                );
                break;
            case "cases":
                $rules = array(
                    array('field' => 'victimname', 'label' => 'Name', 'rules' => 'required'),
                    array('field' => 'victimemail', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'victimaddress', 'label' => 'Address', 'rules' => 'required'),
                    array('field' => 'victimaadhaar', 'label' => 'Aadhaar Number', 'rules' => ''),
                    array('field' => 'victimmobile', 'label' => 'Mobile Number', 'rules' => 'required|integer'),
                    array('field' => 'victimcity', 'label' => 'City', 'City' => 'required'),
                    array('field' => 'victimdistrict', 'label' => 'Victim District', 'rules' => 'required'),
                    array('field' => 'offendername', 'label' => 'Name', 'rules' => 'required|alpha'),
                    array('field' => 'offenderaddress', 'label' => 'Address', 'rules' => 'required'),
                    array('field' => 'offendermobile', 'label' => 'Mobile Number', 'rules' => 'integer'),
                    array('field' => 'offendercity', 'label' => 'City', 'rules' => 'required'),
                    array('field' => 'ifothers', 'label' => 'If Others', 'rules' => 'max_length[100]'),
                    array('field' => 'offenderdistrict', 'label' => 'Offender District', 'rules' => 'required'),
                    array('field' => 'offencedate', 'label' => 'Offence Date', 'rules' => 'required'),
                    array('field' => 'victimgender', 'label' => 'Gender', 'rules' => 'required'),
                    array('field' => 'casedescription', 'label' => 'Case Description', 'rules' => 'required|max_length[400]'),
                    array('field' => 'victimdob', 'label' => 'Date Of Birth', 'rules' => 'required'),
                    array('field' => 'victimemail', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'offendergender', 'label' => 'Gender', 'rules' => 'required'),
                    array('field' => 'fir_no', 'label' => 'FIR Number', 'rules' => 'required'),
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

//
    public function addtoDB() {
        $postData = $this->input->post();
        if ($this->form_validation("casehistory")):
        //logic
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
    }

    public function CaseHistoryShow($id) {
        $condition = array("caseid" => $id);
        $select = "caseid as CaseID ,fir_no as FirNumber , victimname as VictimName, victimaddress as VictimAddress , vicitmdob as VictimDob , victimgender as VictimGender , victimmobile as VictimMobile, victimemail as VictimEmail  , offendername as OffenderName , offenderaddress as OffenderAddress , offendergender as OffenderGender , casedescription as CaseDescription ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "", "", "", "", "", "", "");
    }

    public function CaseHistoryComments($id) {
        $condition = array("caseid" => $id);
        $select = "casehistorydesc as CaseHistoryDesc";
        return $this->Adminmodel->CSearch($condition, $select, "casehis", "Y", "", "", "", "", "", "");
    }

    public function CaseHistorySave() {
        $postData = $this->input->post();

        if ($this->form_validation("casehistory")):

            $condition = array("casehistoryid" => "");
            $DBData = array("casehistorydesc" => $postData['casehistory'],
                "userid" => $_SESSION['UserId'], "caseid" => $postData['caseid']);

            $this->Adminmodel->AllInsert($condition, $DBData, "", "casehis");
            
            $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "casehis");
            if (!empty($response)):
                $Message = $this->load->view("emaillayouts/commentupdate", get_defined_vars(), true);
                $Subject = "Atrocity Case Management - New Comment Updated";
                $this->SendEmail(trim($postData['rukhmanivenkatesan@gmail.com']), $Message, "N", $Subject, "");
                $this->session->set_flashdata('ME_SUCCESS', 'Comment updated successfully');
            else:
                $this->session->set_flashdata('ME_ERROR', 'Data not Saved. Kindly Re Enter');
            endif;
        else:
            $_SESSION['formError'] = validation_errors();
            $this->session->set_flashdata('ME_FORM', "ERROR");
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
            case "allsolvedcases";
                $render = "showallsolvedcases";
                break;
            case "allpendingcases";
                $render = "showallpendingcases";
                break;


            case "alloffenders";
                $render = "showalloffenders";
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

    public function user($options = null) {
        $render = "";
        switch (strtolower($options)) {
            case "allusers";
                $render = "showallusers";
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
                $casedatabase = $this->CaseHistoryShow($id);
                $casecomments = $this->CaseHistoryComments($id);
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

    public function users_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "users":
                $Condition = array();
                $TableListname = "usr";
                $ColumnOrder = array('name', 'username', 'mobilenumber', 'email', 'city');
                $ColumnSearch = array('name', 'username', 'mobilenumber', 'email', 'city');
                $OrderBy = array('userid' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $UserNotice) {
            $no++;
            $row = array();
            $row[] = $UserNotice->name;
            $row[] = $UserNotice->username;
            $row[] = $UserNotice->mobilenumber;
            $row[] = $UserNotice->email;
            $row[] = $UserNotice->city;
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/showallusers' . $UserNotice->userid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function CaseRegisterSave() {
        $postData = $this->input->post();
//         echo "<pre>";
//            print_r(get_defined_vars());
//             exit();
        if ($this->form_validation("cases")):
            //add to database
//            echo "<pre>";
//            print_r(get_defined_vars());
//             exit();
          
                $condition = array("caseid" => "");
            $DBData = array(
                "offid" => $postData['offenece'],  "userid" => "1",
                "fir_no" => $postData['fir_no'],
                "victimname" => $postData['victimname'],
                "victimaddress" => $postData['victimaddress'],
                "vicitmdob" => $postData['victimdob'],
                "victimgender" => $postData['victimgender'],
                "victimmobile" => $postData['victimmobile'],
                "victimemail" => $postData['victimemail'],
                "victimaadhar" => $postData['victimaadhar'],
                "victimcity" => $postData['victimcity'],
                 "victimdistrict" => $postData['victimdistrict'],
                 //"victimstate" => $postData['victimstate'],
                "offendername" => $postData['offendername'],
                "offenderaddress" => $postData['offenderaddress'],
                "offendergender" => $postData['offendergender'],
                "offendermobile" => $postData['offendermobile'],
                "offenderemail" => $postData['offenderemail'],
                "casedescription" => $postData['casedescription'],
                "offendercity" => $postData['offendercity'],
                 "offenderdistrict" => $postData['offenderdistrict'],
                 //"offenderstate" => $postData['offenderstate'],
                 "casestatus" => "1"
            );
//            echo "<pre>";
//            print_r(get_defined_vars());
//             exit();
            $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "case");
            if (!empty($response)):
                $Message = $this->load->view("emaillayouts/registercase", get_defined_vars(), true);
                $Subject = "Atrocity Case Management - New Case Registered";
                 $this->SendEmail(trim($postData['EmailID']), $Message, "N", $Subject, "");
                $this->session->set_flashdata('ME_SUCCESS', 'Case Registred Successfully');
            else:
                $this->session->set_flashdata('ME_ERROR', 'Data not Saved. Kindly Re Enter');
            endif;
        else:
            $_SESSION['formError'] = validation_errors();
            $this->session->set_flashdata('ME_FORM', "ERROR");
        endif;
        redirect('index.php/' . strtolower($this->router->fetch_class()) . '/cases/allcases');
    }
    public function TotalUserCount() {
        $condition = array();
        $response = $this->Adminmodel->count_all("usr", $condition);
        return $response;
    }

    public function TotalCaseCount() {
        $condition = array();
        $response = $this->Adminmodel->count_all("case", $condition);
        return $response;
    }

    public function PendingCaseCount() {
        $condition = array("casestatus" => '3');
        $response = $this->Adminmodel->count_all("case", $condition);
        return $response;
    }

    public function SolvedCaseCount() {
        $condition = array("casestatus" => '2');
        $response = $this->Adminmodel->count_all("case", $condition);
        return $response;
    }

    public function NewCaseShow() {
        $condition = array("casestatus" => '1');
        $select = "fir_no as FIR,victimname as VictimName , victimmobile as VictimMobile ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "Y", "", "", "", "", "", "");
    }

    public function SolvedCaseShow() {
        $condition = array("casestatus" => '2');
        $select = "fir_no as FIR,victimname as VictimName , victimmobile as VictimMobile ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "Y", "", "", "", "", "", "");
    }

    public function PendingCaseShow() {
        $condition = array("casestatus" => '3');
        $select = "fir_no as FIR,victimname as VictimName , victimmobile as VictimMobile ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "Y", "", "", "", "", "", "");
    }

    public function offenders_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "offenders":
                $Condition = array();

                $TableListname = "case";

                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'offendername', 'createdat', 'casestatus');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile', 'casestatus');
                $OrderBy = array('caseid' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $logNotice) {
            $no++;
            $row = array();
            $row[] = $logNotice->fir_no;
            $row[] = $logNotice->victimname;
            $row[] = $logNotice->victimmobile;
            $row[] = $logNotice->offendername;
            $row[] = $logNotice->createdat;
            $row[] = $logNotice->casestatus;
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/casehistory/show/' . $logNotice->caseid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
  
}
