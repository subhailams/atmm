<?php

/**
 * Description of About
 *
 * @author VidhyaPrakash
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Administrator extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render("dashboard", get_defined_vars());
    }
    public function users()
    {
         $this->render("newuser", get_defined_vars());
         
    }
   
   


    public function logs($options = null)
    {
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


    public function logs_ajax_list($options = null)
    {
        switch (strtolower($options)) {
            case "notices":
                $Condition = array("errtype" => "Notice");;
                break;
            case "warnings":
                $Condition = array("errtype" => "Warning");
                break;
            case "errors":
                $Condition = array("errtype" => "Error");
                break;
            case "all":
                $Condition = array();
                break;
            default:
                $Condition = array();
                break;
        }

        $TableListname = "log";
        $ColumnOrder = array('errstr', 'errfile', 'errline', 'time');
        $ColumnSearch = array('errstr', 'errfile', 'errline', 'time');
        $OrderBy = array('id' => 'desc');
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
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $logNotice->id . "'" . ')"><i class="fa fa-eye"></i>   View</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Adminmodel->count_all($TableListname,$Condition),
            "recordsFiltered" => $this->Adminmodel->count_filtered($TableListname, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    protected function getlogs_notices()
    {
        $condition = array("errtype" => "Notice");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

    protected function getlogs_warning()
    {
        $condition = array("errtype" => "Warning");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

    protected function getlogs_error()
    {
        $condition = array("errtype" => "Error");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

    protected function getlogs_all()
    {
        $condition = array("");
        $select = "id as ID, errstr as ErrorString, time as Time";
        return $this->Adminmodel->CSearch($condition, $select, "log", "Y", "Y", "", "", "", "", "");
    }

}
