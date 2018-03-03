<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth {

    public function __construct() {
        $this->obj = & get_instance();
    }

    function Authencation($FirstLogin = null, $Class = null) {
        $Postdata = $this->obj->input->post();
        $_SESSION = $this->obj->session->userdata;
        $HttpRequestType = $this->obj->auth->UserRequestFrom();
        $LoginData = "error/login";
        $Class = strtolower($Class);
        if (!empty($_SESSION['UserId'])) {
            return true;
        }
        //captacha checking
        elseif ($Postdata['question'] != $Postdata['answer']) {
            $Error = "Invalid Capatcha. Please Try Again!!";
            if ($HttpRequestType) {
                $Error = array("Error" => $Error);
                exit(json_encode($Error));
            } else {
                exit($this->obj->load->view($LoginData, get_defined_vars(), true));
            }
        } elseif (!empty($Postdata['username']) && !empty($Postdata['password']) && !empty($Postdata['role'])) {
            $Userdetails = $this->obj->db->select(array("dept_id as DepartmentID", "dept_name as DepartmentName", "aca_name as AcademicYearFull", "aca_id as AcademicYear", "stp_id as ID", "stp_name as FullName", "stp_username as UserName", "stp_status as Status", "role_id as RoleID", "role_name as RoleName", "des_name as DesgName", "des_short_name as DesgShortName"))->where(array("stp_username" => $Postdata['username'], "stp_password" => $Postdata['password'], "stp_role" => $Postdata['role']))->join("user_role", "role_id=stp_role")->join("designation", "des_id=stp_desg")->join("academicyear", "aca_id=" . $Postdata['academicyear'])->join("departments", "dept_id=stp_dept")->get("staffprofile")->row_array();
            if (!empty($Userdetails)):
                $this->obj->session->set_userdata("Auth", "Y");
                $this->obj->session->set_userdata("UserName", $Userdetails['UserName']);
                $this->obj->session->set_userdata("UserFullName", $Userdetails['FullName']);
                $this->obj->session->set_userdata("UserId", $Userdetails['ID']);
                $this->obj->session->set_userdata("UserType", $Userdetails['Status']);
                $this->obj->session->set_userdata("UserRoleID", $Userdetails['RoleID']);
                $this->obj->session->set_userdata("UserRoleName", $Userdetails['RoleName']);
                $this->obj->session->set_userdata("DepartmentName", $Userdetails['DepartmentName']);
                $this->obj->session->set_userdata("DepartmentID", $Userdetails['DepartmentID']);
                $this->obj->session->set_userdata("DesgName", $Userdetails['DesgName']);
                $this->obj->session->set_userdata("DesgShortName", $Userdetails['DesgShortName']);
                $this->obj->session->set_userdata("AcademicYear", $Userdetails['AcademicYear']);
                $this->obj->session->set_userdata("AcademicYearFull", $Userdetails['AcademicYearFull']);
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

    public function UserRequestFrom() {
        if (($_POST['Api'] == "Webview") || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            return true;
        } else {
            return false;
        }
    }

}
