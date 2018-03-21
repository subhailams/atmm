<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Homepage extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $FunctionS = array("index","forgotpassword","userregister"
           );

        if (!in_array($this->router->fetch_method(), $FunctionS)):
            if (strtolower($_SESSION["UserRoleName"]) != strtolower(__CLASS__)) {
                $this->Inti(__CLASS__);
            }
        endif;

        $userNameCnd = array("username" => $this->session->userdata("UserName"));
        $this->user = current($this->Adminmodel->CSearch($userNameCnd, "username as UserName", "usr", "", "", "", "", "", "", ""));
        $this->userid = current($this->Adminmodel->CSearch($userNameCnd, "user_id as UserId", "usr", "", "", "", "", "", "", ""));
        $this->userRole = current($this->Adminmodel->CSearch($userNameCnd, "role as UserRole", "usr", "Y", "Y", "", "", "", "", ""));
    }

    public function index() {
         $casecount=$this->TotalCaseCount();
         $pendingcount=$this->PendingCaseCount();
         $solvedcount=$this->SolvedCaseCount();
//         echo "<pre>";
//         print_r(get_defined_vars());exit();
          $this->load->view('homepage/dashboard', get_defined_vars());
    }

    public function email() {
        $Message = $this->load->view("emaillayouts/usersignup", get_defined_vars(), true);
        $Subject = "Atrocity Case Management - New Account Created";
        $this->SendEmail(trim("vidhyaprakash85@gmail.com"), $Message, "N", $Subject, "");
    }

    public function userregister() {
        $this->load->view('homepage/userregister');
    }

    public function UserRegisterSave() {
        $postData = $this->input->post();
      echo "<pre>";
            print_r(get_defined_vars());
            exit();
        if ($this->form_validation("userreg")):
            //add to database
//            echo "<pre>";
//            print_r(get_defined_vars());
//            exit();
            
            $condition = array("user_id" => "");
            $DBData = array(
                "role" => $postData['Role'],
                "name" => $postData['PersonName'],
                "username" => $postData['UserName'],
                "password" => $postData['Password'],
                "address1" => $postData['Address1'],
                "address2" => $postData['Address2'],
                "city" => $postData['City'],
                "state" => $postData['State'],
                "country" =>$postData['Country'],
                "mobilenumber" => $postData['MobileNumber'],
                "email" => $postData['EmailID']
            );

            $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "usr");
            if (!empty($response)):
                $Message = $this->load->view("emaillayouts/usersignup", get_defined_vars(), true);
                $Subject = "Atrocity Case Management - New Account Created";
             //   $this->SendEmail(trim($postData['EmailID']), $Message, "N", $Subject, "");
                $this->session->set_flashdata('ME_SUCCESS', 'User Registered Successfully');
            else:
                $this->session->set_flashdata('ME_ERROR', 'Data not Saved. Kindly Re Enter');
            endif;
        else:
            $_SESSION['formError'] = validation_errors();
            $this->session->set_flashdata('ME_FORM', "ERROR");
        endif;
        $this->load->view('homepage/userregister');
    }

    public function ForgotPasswordSave() {
        $postData = $this->input->post();
        if ($this->form_validation("forgot")):
            //add to database
            $condition = array("email" => $postData['emailid'], "mobilenumber" => $postData['mobilenumber']);
            $select = "mobilenumber as MobileNumber,email as EmailID,user_id as UID";
            $result = $this->Adminmodel->CSearch($condition, $select, "usr", "", "", "", "", "", "", "");
            if (!empty($result)):
                $RandomPassword = randomgen(100000, 999999, 1);
                $condition = array("user_id" => $result['UID']);
                $DBData = array("password" => $RandomPassword[0]);
                $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "usr");
                if (!empty($response)):
                    $Message = $this->load->view("emaillayouts/forgotpass", get_defined_vars(), true);
                    $Subject = "Atrocity Case Managment - Password Reset";
                    //$this->SendEmail(trim($result['EmailID']), $Message, "N", $Subject, "");
                    $this->session->set_flashdata('ME_SUCCESS', 'Password Changed Successfully');
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Data not Saved. Kindly Contact Adminsitrator');
                endif;
            else:
                $this->session->set_flashdata('ME_ERROR', 'Your data not matched with our records');
            endif;
        else:
            $_SESSION['formError'] = validation_errors();
            $this->session->set_flashdata('ME_FORM', "ERROR");
        endif;
        $this->load->view('homepage/dashboard');
    }

    public function login() {
        $this->load->view('homepage/login');
    }

    public function forgotpassword() {
        $this->load->view('homepage/forgotpassword');
    }

}
