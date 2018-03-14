<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth
{

    public function __construct()
    {
        $this->obj = &get_instance();
    }

    function Authencation($FirstLogin = null, $Class = null)
    {
        $Postdata = $this->obj->input->post();
        $_SESSION = $this->obj->session->userdata;
        $HttpRequestType = $this->obj->auth->UserRequestFrom();
        $LoginData = "homepage/login";

        $Class = strtolower($Class);
        if (!empty($_SESSION['UserId'])) {
            return true;
        } //captacha checking
        /* elseif ($Postdata['question'] != $Postdata['answer']) {
            $Error = "Invalid Capatcha. Please Try Again!!";
            if ($HttpRequestType) {
                $Error = array("Error" => $Error);
                exit(json_encode($Error));
            } else {
                exit($this->obj->load->view($LoginData, get_defined_vars(), true));
            }
        }*/
        elseif (!empty($Postdata['username']) && !empty($Postdata['password'])) {
            $Userdetails = $this->obj->db->select(array("role as RoleID", "rolename as RoleName", "user_id as ID", "name as FullName", "username as UserName"))->where(array("username" => $Postdata['username'], "password" => $Postdata['password']))->join("roles", "roleid=role")->get("users")->row_array();
            if (!empty($Userdetails)):
                $this->obj->session->set_userdata("Auth", "Y");
                $this->obj->session->set_userdata("UserName", $Userdetails['UserName']);
                $this->obj->session->set_userdata("UserFullName", $Userdetails['FullName']);
                $this->obj->session->set_userdata("UserId", $Userdetails['ID']);
                $this->obj->session->set_userdata("UserRoleID", $Userdetails['RoleID']);
                $this->obj->session->set_userdata("UserRoleName", $Userdetails['RoleName']);
                $this->obj->session->set_userdata('site_lang', "english");
                $_SESSION = $this->obj->session->userdata;


                return true;
            else:
                $Error = "User Name or Password is not match";
                if ($HttpRequestType) {
                    $Error = array("Error" => $Error);
                    exit(json_encode($Error));
                } else {
                    exit($this->obj->load->view($LoginData, get_defined_vars(), true));
                }
            endif;
        } else {
            if (!empty($FirstLogin)):
                exit($this->obj->load->view($LoginData, get_defined_vars(), true));
            endif;
            $Error = "User Name or Password is not should be empty.";
            if ($HttpRequestType) {
                $Error = array("Error" => $Error);
                exit(json_encode($Error));
            } else {
                exit($this->obj->load->view($LoginData, get_defined_vars(), true));
            }
        }
    }

    public function UserRequestFrom()
    {
        if (($_POST['Api'] == "Webview") || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            return true;
        } else {
            return false;
        }
    }

}
