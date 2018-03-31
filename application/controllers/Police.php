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

    public function complaint($options = null, $id = null) {
        $render = "";
        switch (strtolower($options)) {
            case "allcomplaints";
                $render = "viewallcomplaints";
                break;
            case "action";
                $render = "complaintaction";
                $VerifyStatus = $this->toVerifyAssigned($id);
                break;
            default:
                break;
        }
        $this->render($render, get_defined_vars());
    }

    protected function toVerifyAssigned($id) {
        $condition = array("complaintsid" => $id);
        $select = "isassignedto as AssignedTo ";
        return $this->Adminmodel->CSearch($condition, $select, "comp");
    }

    public function complaints_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "complaints":
                $Condition = array();
                $TableListname = "comp";
                $ColumnOrder = array('name', 'city', 'mobilenumber', 'comp_comments');
                $ColumnSearch = array('name', 'city');
                $OrderBy = array('complaintsid' => 'desc');
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
            $row[] = $logNotice->name;
            $row[] = $logNotice->city;
            $row[] = $logNotice->mobilenumber;
            $row[] = $logNotice->comp_comments;

            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/complaint/action/' . $logNotice->complaintsid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
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
