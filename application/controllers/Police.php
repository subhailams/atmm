<?php

/**
 * Description of About
 *
 * @author VidhyaPrakash
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Police extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $FunctionS = array("SendEmail");
        if (!in_array($this->router->fetch_method(), $FunctionS)):
            if (strtolower($_SESSION["UserRoleName"]) != strtolower(__CLASS__)) {
                $this->Inti(__CLASS__);
            }
        endif;
        $userNameCnd = array("stp_username" => $this->session->userdata("UserName"));
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

    public function cases_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "cases":
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

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, "N");
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
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy, false),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
