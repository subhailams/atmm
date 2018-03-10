<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    function __construct()
    {
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

    protected function UserFrom()
    {
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

    public function render($Render, $RenderData = null)
    {
        $Layout = "layout/body";
        $this->render = $Render;
        $this->load->view($Layout, $RenderData);
    }

    public function Inti($Class)
    {
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

    public function Logout()
    {
        $this->session->sess_destroy();
        session_unset();
        session_destroy();
        $this->session->set_userdata("Auth", "Y");

        exit($this->load->view("error/login", get_defined_vars(), true));
    }

    public function accessdeined()
    {
        $this->render("accessdeined", get_defined_vars());
    }

    public function SendEmail($EmailTo, $Message, $ReturnData, $Subject, $EmailBcc)
    {

        $mail = $this->emailConfig();
        $mail->setFrom('vidhyaprakash85@gmail.com', 'Mailer');
        $mail->addAddress($EmailTo);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $Subject;
        $mail->Body = $Message;

        if (!$mail->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function emailConfig()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'tls://smtp.gmail.com:587';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';                 // SMTP username
        $mail->Password = '';
        return $mail;
    }

    public function forms($option)
    {
        switch (strtolower($option)):
            case "password_reset":
                $this->render(strtolower($option), get_defined_vars());
                break;
        endswitch;
    }

    public function cases($options = null)
    {
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
     public function casehistory($options = null)
    {
        $render = "";
        switch (strtolower($options)) {
            case "show";
                $render = "casehistory";
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
      public function email($options = null)
    {
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
