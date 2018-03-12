<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Homepage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('homepage/dashboard');
    }

    public function email()
    {
        $this->load->view('emaillayouts/usersignup');
    }
     public function loginscreen()
    {
        $this->load->view('homepage/login');
    }
     public function forgot()
    {
        $this->load->view('homepage/forgotpassword');
    }
}

