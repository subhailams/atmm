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
        if ((!empty($CtrlRole)) && ($CtrlRole['rolename'] == strtoupper($Class))) {
            if (strtoupper($_SESSION["UserRole"]) == strtoupper($Class)) {
                return true;
            } else {
                redirect("/index.php/" . strtolower($CtrlRole['rolename']) . "/index");
            }
        } else {
            if (!empty($CtrlRole['rolename'])) {
                redirect("/index.php/" . strtolower($CtrlRole['rolename']) . "/index");
            } else {
                redirect("/error/index/InitiThrought");
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
                    array('field' => 'PersonName', 'label' => 'Person Name', 'rules' => 'required|max_length[30]'),
                    array('field' => 'EmailID', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'Password', 'label' => 'Password', 'rules' => 'required|max_length[10]'),
                    array('feild' => 'ConfirmationPassword', 'label' => 'Confirmation Password', 'rules' => 'required'),
                    array('field' => 'Address1', 'label' => 'Address1', 'rules' => 'required'),
                    array('feild' => 'Address2', 'label' => 'Address2', 'rules' => ''),
                    array('field' => 'AadhaarNumber', 'label' => 'Aadhaar Number', 'rules' => ''),
                    array('field' => 'MobileNumber', 'label' => 'Mobile Number', 'rules' => 'required|integer'),
                    array('field' => 'City', 'label' => 'Name', 'City' => 'required'),
                    array('field' => 'State', 'label' => 'Name', 'State' => ''),
                    array('field' => 'UserName', 'label' => 'User Name', 'rules' => 'required|max_length[35]'),
                    array('field' => 'Country', 'label' => 'Country', 'rules' => ''),
                    array('field' => 'Role', 'label' => 'Role', 'rules' => 'required')
                );

                break;
            case "profile":
                $rules = array(
                    array('field' => 'Name', 'label' => 'Name', 'rules' => 'required|max_length[30]'),
                    array('field' => 'EmailID', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'Address1', 'label' => 'Address1', 'rules' => 'required'),
                    array('feild' => 'Address2', 'label' => 'Address2', 'rules' => ''),
                    array('field' => 'AadhaarNumber', 'label' => 'Aadhaar Number', 'rules' => ''),
                    array('field' => 'MobileNumber', 'label' => 'Mobile Number', 'rules' => 'required|integer'),
                    array('field' => 'City', 'label' => 'city', 'rules' => 'required'),
                    array('field' => 'State', 'label' => 'State', 'rules' => ''),
                    array('field' => 'UserName', 'label' => 'User Name', 'rules' => 'required'),
                    array('field' => 'Country', 'label' => 'Country', 'rules' => ''),
                    array('field' => 'Role', 'label' => 'Role', 'rules' => 'required')
                );
                break;
            case "email":
                $rules = array(
                    array('field' => 'emailto', 'label' => 'Email To', 'rules' => 'required|valid_email'),
                    array('field' => 'subject', 'label' => 'Subject', 'rules' => 'required|max_length[45]'),
                    array('field' => 'emaildetail', 'label' => 'Email Detail', 'rules' => 'required|max_length[400]'),
                );
                break;
            case "cases":
                $rules = array(
                    array('field' => 'victimname', 'label' => 'Name', 'rules' => 'required'),
                    array('field' => 'victimemail', 'label' => 'Email ID', 'rules' => 'valid_email'),
                    array('field' => 'victimaddress', 'label' => 'Address', 'rules' => 'required'),
                    array('field' => 'victimaadhaar', 'label' => 'Aadhaar Number', 'rules' => ''),
                    array('field' => 'victimmobile', 'label' => 'Mobile Number', 'rules' => 'required|integer'),
                    array('field' => 'victimcity', 'label' => 'City', 'rules' => 'required'),
                    array('field' => 'victimdistrict', 'label' => 'Victim District', 'rules' => 'required'),
                    array('field' => 'victimstate', 'label' => 'Victim State', 'rules' => ''),
                    array('field' => 'offendername', 'label' => 'Name', 'rules' => 'required'),
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
                    array('field' => 'offenderstate', 'label' => 'Offender State', 'rules' => ''),
                    array('field' => 'fir_no', 'label' => 'FIR Number', 'rules' => 'required'),
                    array('field' => 'offenderage', 'label' => 'Age', 'rules' => 'required'),
                );
                break;
            case "fir":
                $rules = array(
                    array('field' => 'fir_no', 'label' => 'FIR No', 'rules' => 'required'),
                    array('field' => 'police_station', 'label' => 'Police Station', 'rules' => 'required'),
                    array('field' => 'district', 'label' => 'District', 'rules' => 'required'),
                    array('field' => 'year', 'label' => 'Year', 'rules' => 'required'),
                    array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
                    array('field' => 'act1', 'label' => 'Act 1', 'rules' => 'required'),
                    array('field' => 'section1', 'label' => 'Section1', 'rules' => 'required'),
                    array('field' => 'act2', 'label' => 'Act 2', 'rules' => ''),
                    array('field' => 'section2', 'label' => 'Section2', 'rules' => ''),
                    array('field' => 'offence_day', 'label' => 'Offence Day', 'rules' => 'required'),
                    array('field' => 'date_from', 'label' => 'Date From', 'rules' => 'required'),
                    array('field' => 'date_to', 'label' => 'Date To', 'rules' => 'required'),
                    array('field' => 'time_from', 'label' => 'Time From', 'rules' => ''),
                    array('field' => 'time_to', 'label' => 'Time To', 'rules' => ''),
                    array('field' => 'receiveddate', 'label' => 'Received Date', 'rules' => 'required'),
                    array('field' => 'time', 'label' => 'Time', 'rules' => 'required'),
                    array('field' => 'place_of_occurrence', 'label' => 'Place Of Occurrence', 'rules' => 'required'),
                    array('field' => 'type_of_information', 'label' => 'Type Of Information', 'rules' => 'required'),
                    array('field' => 'complianantname', 'label' => 'Complianant name', 'rules' => 'required'),
                    array('field' => 'complianantdob', 'label' => 'Complianant Dob ', 'rules' => 'required'),
                    array('field' => 'nationality', 'label' => 'Nationality', 'rules' => 'required'),
                    array('field' => 'occupation', 'label' => 'Occupation', 'rules' => ''),
                    array('field' => 'address', 'label' => 'Address', 'rules' => 'required'),
                    array('field' => 'suspectparticulars', 'label' => 'Suspect Particulars', 'rules' => 'required'),
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

    /* Function for saving Cases in Database Starts here */

    public function CaseRegisterSave() {
        $postData = $this->input->post();
        if ($this->form_validation("cases")):
            //verify offender in offender master
            $condition = array("offendername" => $postData['offendername'], "offendermobile" => $postData['offendermobile']);
            $select = "offendername as OffenderName , offendermobile as OffenderMobile";
            $response = $this->Adminmodel->CSearch($condition, $select, "off_mst", "Y", "Y", "", "", "", "", "");

            if (empty($response)) {
                $condition1 = array("offenderid" => "");
                $DBData = array(
                    "offendername" => $postData['offendername'],
                    "offenderaddress" => $postData['offenderaddress'],
                    "offendergender" => $postData['offendergender'],
                    "offendermobile" => $postData['offendermobile'],
                    "offenderemail" => $postData['offenderemail'],
                    "offendercity" => $postData['offendercity'],
                    "offenderdistrict" => $postData['offenderdistrict'],
                    "offenderage" => $postData['offenderage'],
                    "offenderstate" => $postData['offenderstate'],
                );

                $response1 = $this->Adminmodel->AllInsert($condition1, $DBData, "", "off_mst");
            }
            $condition = array("offendername" => $postData['offendername'], "offendermobile" => $postData['offendermobile']);
            $select = "offenderid as OffenderId";
            $response = $this->Adminmodel->CSearch($condition, $select, "off_mst", "", "Y", "", "", "", "", "");
            $condition = array("caseid" => "");

            $DBData = array(
                "offenderid" => $response['OffenderId'],
                "offid" => $postData['offenece'],
                "userid" => "1",
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
                "victimstate" => $postData['victimstate'],
                "casedescription" => $postData['casedescription'],
                "offencedate" => $postData['offencedate'],
                "casestatus" => "1"
            );
            $response1 = $this->Adminmodel->AllInsert($condition, $DBData, "", "case");
            if (!empty($response1)):
                $Message = $this->load->view("emaillayouts/registercase", get_defined_vars(), true);
                $Subject = "Atrocity Case Management - New Case Registered";
                // $this->SendEmail(trim($postData['EmailID']), $Message, "N", $Subject, "");
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

    /* Function for saving Cases in Database Ends here */

    public function CaseHistoryShow($id) {
        $condition = array("caseid" => $id);
        $select = "caseid as CaseID ,fir_no as FirNumber , victimname as VictimName, victimaddress as VictimAddress , vicitmdob as VictimDob , victimgender as VictimGender , victimmobile as VictimMobile, victimemail as VictimEmail,victimcity as VictimCity,victimdistrict as VictimDistrict,victimstate as VictimState, offendername as OffenderName , offenderaddress as OffenderAddress , offendergender as OffenderGender,victimcity as VictimCity,offenderdistrict as OffenderDistrict,offenderstate as OffenderState,casedescription as CaseDescription ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "", "Y", "", "", "", "", "");
    }

    public function CaseHistoryComments($id) {
        $condition = array("caseid" => $id);
        $select = "casehistorydesc as CaseHistoryDesc,casehistory.createdat as CreatedOn,casehistory.createdby as CreatedBy";
        return $this->Adminmodel->CSearch($condition, $select, "casehis", "Y", true);
    }

    /* Maps Ajax Cases list statrs from here */

    public function map_ajax_list($options = "", $id = "") {
        switch (strtolower($options)) {
            case "cases":
                $Condition = array("casestatus" => '1', "victimdistrict" => $id);
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'casestatus');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile');
                $OrderBy = array('caseid' => 'desc');
                break;
            case "solvedcases":
                $Condition = array("casestatus" => '2', "victimdistrict" => $id);
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'casestatus');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile');
                $OrderBy = array('caseid' => 'desc');
                break;
            case "pendingcases":
                $Condition = array("casestatus" => '3', "victimdistrict" => $id);
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'casestatus');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile');
                $OrderBy = array('caseid' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, false);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $logNotice) {
            $no++;
            $row = array();
            $row[] = $logNotice->fir_no;
            $row[] = $logNotice->victimname;
            $row[] = $logNotice->victimmobile;
            //add html for action
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, "N"),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /* Maps Ajax Cases list ends from here */

    /* Function for saving Case History in Database Starts here */

    public function CaseHistorySave() {
        $postData = $this->input->post();
        if ($this->form_validation("casehistory")):
            $condition = array("casehistoryid" => "");
            $DBData = array("casehistorydesc" => $postData['casehistory'],
                "userid" => $_SESSION['UserId'], "caseid" => $postData['caseid']);
            $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "casehis");
            if (!empty($response)):
                $Message = $this->load->view("emaillayouts/commentupdate", get_defined_vars(), true);
                $Subject = "Atrocity Case Management - New Comment Updated";
                //$this->SendEmail(trim(]), $Message, "N", $Subject, "");
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

    /* Function for saving Case History in Database Ends here */

    /* Function for fetching cases files from  views starts here */

    public function cases($options = null, $id = "") {
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
            case "districtcases";
                $render = "districtcases";
                $districtID = $id;
                break;
            case "alloffenders";
                $render = "showalloffenders";
                break;
            case "firshow";
                $render = "fir";
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

    /* Function for fetching cases files from  views ends here */

    /* Function for fetching  offender's offences file from  views starts here */

    public function offenders($options = null, $id = null) {
        $render = "";
        switch (strtolower($options)) {
            case "alloffences";
                $render = "offender_offences";
                $OffenderDetails = $this->OffenderDetail($id);
                echo "<pre>";
                print_r(get_defined_vars());
                exit();
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

    /* Function for fetching  offender's offences file from  views ends here */

    private function OffenderDetail($id) {
        $condition = array("cases.offenderid" => $id);
        $select = "offendername as OffenderName,offendermobile as OffenderMobile,case_status_name as CaseStatus";
        return $this->Adminmodel->CSearch($condition, $select, "case", "Y", true, "", "", "", "", "");
    }

    /* Function for fetching  allusers file from  views starts here */

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

    /* Function for fetching  allusers file from  views ends here */

    /* Function for fetching  casehistory file from  views starts here */

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

    /* Function for fetching  casehistory file from  views ends here */

    /* Function for fetching  Messages files from  views starts here */

    public function messages($options = null) {
        $render = "";
        switch (strtolower($options)) {
            case "show";
                $render = "inbox";
                $email = $this->EmailShow();
                break;
            case "composemail";
                $render = "compose";
                break;
            case "sent";
                $render = "sent";
                $email = $this->EmailShow();
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

    /* Function for fetching  email files from  views ends here */

    public function profileshow($id) {
        $condition = array("user_id" => $id);
        $select = "name as Name ,role as Role ,username as Username , email as EmailID ,address1 as Address1,address2 as Address2,city as City,state as State,country as Country,mobilenumber as Mobilenumber,aadhar as Aadhaarnumber";
        return $this->Adminmodel->CSearch($condition, $select, "usr", "", "", "", "", "", "", "");
    }

    /* Ajax Function for fetching users starts here */

    public function users_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "users":
                $Condition = array();
                $TableListname = "usr";
                $ColumnOrder = array('name', 'username', 'mobilenumber', 'email', 'city');
                $ColumnSearch = array('name', 'username', 'mobilenumber', 'email', 'city');
                $OrderBy = array('user_id' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, false);
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
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/allusers' . $UserNotice->userid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, false),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /* Ajax Function for fetching users ends here */

    /* Ajax function for fetching Cities from District Starts Here */

    public function FetchCities() { // Ajaxcall Fetch Board
        $DistrictID = $this->input->post('id', TRUE);
        $condition = array("districtref" => $DistrictID);
        $select = "cityid as CityID ,cityname as Cityname";
        $CityDetails = $this->Adminmodel->CSearch($condition, $select, "city", "Y", "", "", "", "", "", "");
        $output = "<option value=''>Select City</option>";
        foreach ($CityDetails as $row) {
            $output .= "<option value='" . $row['CityID'] . "'>" . strtoupper($row['Cityname']) . "</option>";
        }
        echo $output;
    }

    /* Ajax function for fetching Cities from District Ends Here */

    /*  Function for count of Users,Cases Starts Here */

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

    /*  Function for count of Users,Cases Ends Here */

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

    /* Ajax Function for fetching offenders starts here */

    public function offenders_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "offenders":
                $Condition = array();
                $TableListname = "off_mst";
                $ColumnOrder = array('offenderid', 'offendername', 'gender_name', 'offendermobile', 'cityname', 'districtname');
                $ColumnSearch = array('offendername');
                $OrderBy = array('offenderid' => 'desc');
                break;

            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, true);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $logNotice) {
            $no++;
            $row = array();
            $row[] = $logNotice->offendername;
            $row[] = $logNotice->gender_name;
            $row[] = $logNotice->offendermobile;
            $row[] = $logNotice->cityname;
            $row[] = $logNotice->districtname;
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/offenders/alloffences/' . $logNotice->offenderid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, true),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /* Ajax Function for fetching offenders ends here */

    public function offences_ajax_list($options = null) {
        switch (strtolower($options)) {

            case "offender_offences":
                $Condition = array();
                $TableListname = "case";
                $ColumnOrder = array('offenece', 'offdate');
                $ColumnSearch = array('offdate');
                $OrderBy = array('offenderid' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, true);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $logNotice) {
            $no++;
            $row = array();
            $row[] = $logNotice->offenece;
            $row[] = $logNotice->offdate;

            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/casehistory/show/' . $logNotice->caseid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, true),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
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

    public function EmailSave() {
        $postData = $this->input->post();
        if ($this->form_validation("email")):

            $condition = array("email" => $postData['emailto']);
            $select = "email as Email , user_id as EmailTo";
            $response = $this->Adminmodel->CSearch($condition, $select, "usr", "Y", "Y", "", "", "", "", "");
            if (!empty($response)) {
                $condition1 = array("msgid" => "");
                $DBData = array(
                    "msgfrom" => $_SESSION['UserId'],
                    "msgto" => $response[0]['EmailTo'],
                    "msgdetails" => $postData['emaildetail'],
                        //   "subject" => $postData['subject'],
                );
                $response1 = $this->Adminmodel->AllInsert($condition1, $DBData, "", "pm");
            }

            $this->session->set_flashdata('ME_SUCCESS', 'Form Validation Successfully');
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function EmailShow() {
        $condition = array("msgto" => $_SESSION['UserId'],);
        $select = "msgto as Msgto , msgdetails as Emaildetails";
        return $this->Adminmodel->CSearch($condition, $select, "pm", "Y", "Y", "", "", "", "", "");
    }
     public function EmailSent() {
        $condition = array("msgfrom" => $_SESSION['UserId'],);
        $select = "msgfrom as Msgfrom , msgdetails as Emaildetails";
        return $this->Adminmodel->CSearch($condition, $select, "pm", "Y", "Y", "", "", "", "", "");
    }

    public function showallusers() {
        $this->render("showallusers", get_defined_vars());
    }

    public function updateprofile() {
        $render = "";

        $userdatabase = $this->profileshow($_SESSION['UserId']);
        $render = "updateprofile";
        $this->render($render, get_defined_vars());
    }

    public function offencesandpunishments() {
        $render = "";

        $userdatabase = $this->profileshow($id);
        $render = "offencesandpunishments";
        $this->render($render, get_defined_vars());
    }

    public function changepassword() {
        $render = "";

        $userdatabase = $this->profileshow($id);
        $render = "changepassword";
        $this->render($render, get_defined_vars());
    }

    public function importantcontacts() {
        $render = "";

        $userdatabase = $this->profileshow($id);
        $render = "importantcontacts";
        $this->render($render, get_defined_vars());
    }

    public function FirRegisterSave() {
        $postData = $this->input->post();
//        echo "<pre>";
//                     print_r(get_defined_vars());
//                    exit();
        if ($this->form_validation("fir")):
//            echo "<pre>";
//            print_r(get_defined_vars());
//            exit();

            $condition = array("fir_id" => "");
            $DBData = array(
                "district" => $postData['district'],
                "policestation" => $postData['police_station'],
                "year" => $postData['year'],
                "date" => $postData['date'],
                "firno" => $postData['fir_no'],
                "act1" => $postData['act1'],
                "act2" => $postData['act2'],
                "section1" => $postData['section1'],
                "section2" => $postData['section2'],
                "offenceday" => $postData['offence_day'],
                "offencedatefrom" => $postData['date_from'],
                "offencedateto" => $postData['date_to'],
                "timefrom" => $postData['time_from'],
                "timeto" => $postData['time_to'],
                "inforecvddate" => $postData['receiveddate'],
                "infoerecvdtime" => $postData['time'],
                "infotype" => $postData['type_of_information'],
                "offenceplace" => $postData['place_of_occurrence'],
                "complianantname" => $postData['complianantname'],
                "complianantdob" => $postData['complianantdob'],
                "nationality" => $postData['nationality'],
                "occupation" => $postData['occupation'],
                "address" => $postData['address'],
                "suspectparticulars" => $postData['suspectparticulars'],
            );
            $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "fir");


        endif;
    }

    /* Ajax Function for fetching all cases */

    public function cases_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "cases":
                $Condition = array();
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'offendername', 'offencedate', 'case_status_name');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile');
                $OrderBy = array('caseid' => 'desc');
                break;
            case "solvedcases":
                $Condition = array("casestatus" => '2');
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'offendername', 'offencedate', 'case_status_name');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile', 'case_status_name');
                $OrderBy = array('caseid' => 'desc');
                break;
            case "pendingcases":
                $Condition = array("casestatus" => '3');
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'offendername', 'offencedate', 'case_status_name');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile', 'case_status_name');
                $OrderBy = array('caseid' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, true);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $logNotice) {
            $no++;
            $row = array();
            $row[] = $logNotice->fir_no;
            $row[] = $logNotice->victimname;
            $row[] = $logNotice->victimmobile;
            $row[] = $logNotice->offendername;
            $row[] = $logNotice->offencedate;
            $row[] = $logNotice->case_status_name;
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/casehistory/show/' . $logNotice->caseid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, true),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
