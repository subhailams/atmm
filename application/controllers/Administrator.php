<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Administrator extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $FunctionS = array("");
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


    public function index()
    {
        
      $usercount=$this->TotalUserCount();
      $casecount=$this->TotalCaseCount();
       $pendingcount=$this->PendingCaseCount();
       $solvedcount=$this->SolvedCaseCount();
       $newcase=$this->NewCaseShow();
       $solvedcase=$this->SolvedCaseShow();
       $pendingcase=$this->PendingCaseShow();
//       echo "<pre>";
//            print_r($newcase);
//            exit();

    

        $this->render("dashboard", get_defined_vars());
    }

    public function demo() {
        $condition = array("casestatus" => '1');
        $select = "fir_no as FIR,victimname as VictimName , victimmobile as VictimMobile,gender_name as Gender";
        $temp = $this->Adminmodel->CSearch($condition, $select, "case", "Y", "Y", "", "", "", "", "");
          
    }

    public function logs($options = null, $id = null) {
        $render = "";
        switch (strtolower($options)) {
            case "notices";
                $render = "showallnotices";
                break;
            case "warnings";
                $render = "showallwarnings";
                break;
            case "errors";
                $render = "showallerrors";
                break;
            case "shownotice":
                $render = "shownotice";
                $noticeinformation = $this->shownotice($id);
                break;
            case "all";
                $render = "showall";
                break;
            default:
                $logsNotice = $this->getlogs_notices();
                $logsWarning = $this->getlogs_warning();
                $logsError = $this->getlogs_error();
                $logsAll = $this->getlogs_all();
                $render = "logs";
                break;
        }
        $this->render($render, get_defined_vars());
    }

    public function logs_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "notices":
                $Condition = array("errtype" => "Notice");
                $TableListname = "log";
                $ColumnOrder = array('errstr', 'errfile', 'errline', 'time');
                $ColumnSearch = array('errstr', 'errfile', 'errline', 'time');
                $OrderBy = array('id' => 'desc');
                break;
            case "warnings":
                $Condition = array("errtype" => "Warning");
                $TableListname = "log";
                $ColumnOrder = array('errstr', 'errfile', 'errline', 'time');
                $ColumnSearch = array('errstr', 'errfile', 'errline', 'time');
                $OrderBy = array('id' => 'desc');
                break;
            case "errors":
                $Condition = array("errtype" => "Error");
                $TableListname = "log";
                $ColumnOrder = array('errstr', 'errfile', 'errline', 'time');
                $ColumnSearch = array('errstr', 'errfile', 'errline', 'time');
                $OrderBy = array('id' => 'desc');
                break;
            case "all":
                $Condition = array();
                $TableListname = "log";
                $ColumnOrder = array('errstr', 'errfile', 'errline', 'time');
                $ColumnSearch = array('errstr', 'errfile', 'errline', 'time');
                $OrderBy = array('id' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $logNotice) {
            $no++;
            $row = array();
            $row[] = $logNotice->errstr;
            $row[] = $logNotice->errfile;
            $row[] = $logNotice->errline;
            $row[] = $logNotice->time;
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/logs/shownotice/' . $logNotice->id) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
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

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy);
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
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function users_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "users":
                $Condition = array();
                $TableListname = "usr";
                $ColumnOrder = array('name', 'username', 'mobilenumber', 'email', 'city');
                $ColumnSearch = array('name', 'username', 'mobilenumber', 'email', 'city');
                $OrderBy = array('userid' => 'desc');
                break;
            default:
                $Condition = array();
                break;
        }

        $list = $this->Adminmodel->get_datatables($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy);
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
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/casehistory/show/' . $UserNotice->userid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname, $Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    protected function shownotice($id) {
        $condition = array("id" => $id);
        $select = "errstr as ErrorString, errfile as ErrorFilename, errline as ErrorLine,time as Time";

        return $this->Adminmodel->CSearch($condition, $select, "log", "", "", "", "", "", "", "");
    }

    protected function getlogs_notices() {
        $condition = array("errtype" => "Notice");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

    protected function getlogs_warning() {
        $condition = array("errtype" => "Warning");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

    protected function getlogs_error() {
        $condition = array("errtype" => "Error");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

    protected function getlogs_all() {
        $condition = array("");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

    public function CaseRegisterSave() {
        $postData = $this->input->post();
        if ($this->form_validation("cases")):
            //add to database
            $condition = array("caseid" => "");
            $DBData = array(
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
                "offendername" => $postData['offendername'],
                "offenderaddress" => $postData['offenderaddress'],
                "offendergender" => $postData['offendergender'],
                "offendermobile" => $postData['offendermobile'],
                "offendermail" => $postData['offenderemail'],
                "casedescription" => $postData['casedescription'],
                "casestatus" => "1"
            );
            $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "case");
            if (!empty($response)):
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

}
