<?php

/**
 * Description of About
 *
 * @author VidhyaPrakash
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Organization extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!in_array($this->router->fetch_method(), $FunctionS)):
            if (strtolower($_SESSION["UserRoleName"]) != strtolower(__CLASS__)) {
                $this->Inti(__CLASS__);
            }
        endif;
        $userNameCnd = array("username" => $this->session->userdata("UserName"));
        $this->user = current($this->Adminmodel->CSearch($userNameCnd, "username as UserName", "usr"));
        $this->userid = current($this->Adminmodel->CSearch($userNameCnd, "user_id as UserId", "usr"));
        $this->userRole = current($this->Adminmodel->CSearch($userNameCnd, "role as UserRole", "usr", "", TRUE));
    }

    public function index() {
        $usercount = $this->TotalUserCount();
        $casecount = $this->TotalCaseCount();
        $pendingcount = $this->PendingCaseCount();
        $solvedcount = $this->SolvedCaseCount();
        $newcase = $this->NewCaseShow();
        $solvedcase = $this->SolvedCaseShow();
        $pendingcase = $this->PendingCaseShow();
        $this->render("dashboard", get_defined_vars());
    }

}
