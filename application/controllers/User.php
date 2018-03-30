<?php

/**
 * Description of About
 *
 * @author VidhyaPrakash
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->render("dashboard", get_defined_vars());
    }

    public function users_cases_ajax_list($options = null) {
        switch (strtolower($options)) {
            case "cases":
                $Condition = array("userid" => $_SESSION['UserId']);
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'offendername', 'offencedate', 'case_status_name');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile');
                $OrderBy = array('caseid' => 'desc');
                break;
            case "solvedcases":
                $Condition = array("casestatus" => '2', "userid" => $_SESSION['UserId']);
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'offendername', 'offencedate', 'case_status_name');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile', 'case_status_name');
                $OrderBy = array('caseid' => 'desc');
                break;
            case "pendingcases":
                $Condition = array("casestatus" => '3', "userid" => $_SESSION['UserId']);
                $TableListname = "case";
                $ColumnOrder = array('fir_no', 'victimname', 'victimmobile', 'offendername', 'offencedate', 'case_status_name');
                $ColumnSearch = array('fir_no', 'victimname', 'victimmobile', 'case_status_name');
                $OrderBy = array('caseid' => 'desc');
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
            $row[] = $logNotice->fir_no;
            $row[] = $logNotice->victimname;
            $row[] = $logNotice->victimmobile;
            $row[] = $logNotice->offendername;
            $row[] = $logNotice->offencedate;
            $row[] = $logNotice->case_status_name;
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="' . base_url('index.php/' . $this->router->fetch_class() . '/casehistory/show/' . $logNotice->caseid) . '" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a>';
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

    public function UpdatePassword() {
        $postData = $this->input->post();
        if ($this->form_validation("password")):
            //add to database
            $condition = array("user_id" => "1", "password" => $postData['oldpassword']);
            $select = "user_id as ID,email as EmailID";
            $result = $this->Adminmodel->CSearch($condition, $select, "usr", "", "", "", "", "", "", "");
            if (!empty($result)):
                $condition = array("user_id" => "1");
                $DBData = array("password" => $postData['newpassword']);
                $response = $this->Adminmodel->AllInsert($condition, $DBData, "", "usr");

                if (!empty($response)):
                    $Message = $this->load->view("emaillayouts/userpasswordupdate", get_defined_vars(), true);
                    $Subject = "Atrocity Case Management - Your password has been updated.";
                    // $this->SendEmail(trim($result['EmailID']), $Message, "N", $Subject, "");
                    $this->session->set_flashdata('ME_SUCCESS', 'Password Changed Successfully');
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Data not Saved. Kindly Re Enter');
                endif;
            endif;
        else:

            $this->session->set_flashdata('ME_FORM', "ERROR");
        endif;
        $this->load->view('homepage/dashboard');
    }

}
