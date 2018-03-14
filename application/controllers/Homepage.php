<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Homepage extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('homepage/dashboard');
    }

    public function email() {
        $Message = $this->load->view("emaillayouts/usersignup", get_defined_vars(), true);
        $Subject = "Atrocity Case Management - New Account Created";
        $this->SendEmail(trim("vidhyaprakash85@gmail.com"), $Message, "N", $Subject,"");
    }

    public function userregister() {
        $this->load->view('homepage/userregister');
    }

    public function register() {
        $postData = $this->input->post();
        if ($this->form_validation("userreg")):
            //add to database
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
                "country" => "INDIA",
                "mobilenumber" => $postData['MobileNumber'],
                "email" => $postData['EmailID']
            );

            $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "usr");
            if (!empty($response)):
                $Message = $this->load->view("emaillayouts/usersignup", get_defined_vars(), true);
                $Subject = "Atrocity Case Management - New Account Created";
                $this->SendEmail(trim($postData['EmailID']), $Message, "N", $Subject,"");
                $this->session->set_flashdata('ME_SUCCESS', 'User Registred Successfully');
            else:
                $this->session->set_flashdata('ME_ERROR', 'Data not Saved. Kindly Re Enter');
            endif;
        else:
            $_SESSION['formError'] = validation_errors();
            $this->session->set_flashdata('ME_FORM', "ERROR");
        endif;
        $this->load->view('homepage/userregister');
    }

     public function login()
    {
        $this->load->view('homepage/login');
    }
     public function forgot()
    {
        $this->load->view('homepage/forgotpassword');
    }
}

