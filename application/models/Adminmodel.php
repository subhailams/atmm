<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Adminmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->TableList = array("log" => "logs", "rol" => "roles", "usr" => "users" );
        $this->SeqID = array("logs" => "id", "roles" => "roleid", "users" => "user_id");
    }

    public function FetchData($Condition, $Select, $TableList, $SelectAll, $GroupBY, $OrderBY) {
        $TableName = $this->TableList[$TableList];
        return $this->CSearch($Condition, $Select, $TableName, $SelectAll, $GroupBY, $OrderBY);
    }

    public function AllInsert($condition, $dataDB, $Select, $Tble) {
        return $this->Crud($condition, $dataDB, $Select, $Tble);
    }

    public function Crud($Condition, $DBdata, $Select, $TableList, $JoinRequired = false) {
        $IPAdress = ($this->input->ip_address() === "::1") ? "127.0.0.1" : $this->input->ip_address();
        $CrudDetails = $this->CSearch($Condition, $Select, $TableList, null,null,null,null,null,null);
        $TableName = $this->TableList[$TableList];
        $this->db->set($DBdata);
        if (!(empty($CrudDetails))) {
            $this->db->where($Condition);
            $this->db->set("updatedBy", $_SESSION["UserFullName"]);
            $this->db->set("updatedAt", "CURRENT_TIMESTAMP", false);
            $this->db->set("updatedIP", ip2long($IPAdress), false);
            $this->db->update($TableName);
            return $CrudDetails[$this->SeqID[$TableName]];
        } else {
            $this->db->set($Condition);
            $this->db->set("createdBy", empty($_SESSION["UserFullName"]) ? NULL : $_SESSION["UserFullName"]);
            $this->db->set("createdAt", "CURRENT_TIMESTAMP", false);
            $this->db->set("createdIP", ip2long($IPAdress), false);
            $this->db->insert($TableName);
            return $this->db->insert_id();
        }
    }

    public function CSearch($Condition, $Select, $TableName, $SelectAll, $JoinRequired, $Distinct, $Omit, $LeftJoin, $GroupBY) {
        if (!empty($Select)) {
            $this->db->select($Select, FALSE);
        }
        $TableName = $this->TableList[$TableName];
        if (!empty($_TableName)) {
            $TableName = $_TableName;
        }
        if ($JoinRequired) {
            $this->JoinData($TableName, $JoinType, $Omit, $LeftJoin);
        }
        if ($Distinct) {
            $this->db->distinct();
        }
        if (!empty($Condition)) {
            $this->db->where($Condition);
        }
        if (!empty($GroupBY)) {
            $this->db->group_by($GroupBY);
        }
        $this->db->order_by($this->SeqID[$TableName], "asc");
        $Result = $this->db->get($TableName);

        if (empty($SelectAll)):
            return (empty($Result)) ? null : (array) $Result->row();
        else:
            return (empty($Result)) ? null : (array) $Result->result_array();
        endif;
    }

    protected function JoinData($TableName, $JoinType, $Omit, $LeftJoin) {
        switch ($TableName) {
            case "staffprofile":
                $JoinTable = array(
                    "user_role" => "role_id=stp_role",
                    "designation" => "des_id=stp_desg",
                    "departments" => "dept_id=stp_dept",
                    "qualification" => "qua_id=stp_qual"
                );
                break;
            case "annexure1_subject":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "semester" => "sem_id=anx1_sem",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                );
                break;
            case "annexure1_membership":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "membershiptype" => "mem_id=anx1_membership_type",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                );
                break;
            case "annexure1_fdp":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                );
                break;
            case "annexure1_research":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                    "journaltype" => "jot_id=anx1_journal_type"
                );
                break;
            case "annexure1_conference":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "eventtype" => "eve_id=anx1_conference_type",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                );
                break;
            case "annexure1_paper":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                    "eventtype" => "eve_id=anx1_event_ref",
                );
                break;
            case "annexure1_sponsored":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                    "projectstatus" => "pst_id=anx1_status"
                );
                break;
            case "annexure1_consultancy":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                    "projectstatus" => "pst_id=anx1_status"
                );
                break;
            case "annexure1_books":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "booktype" => "bty_id=anx1_book_type_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                );
                break;
            case "annexure1_patent":
                $JoinTable = array(
                    "academicyear" => "aca_id=anx1_acayear",
                    "staffprofile" => "stp_id=anx1_staff_ref",
                    "departments" => "dept_id=stp_dept",
                    "designation" => "des_id=stp_desg",
                    "patenttype" => "pat_id=anx1_patent_ref"
                );
                break;
            case "tickets":
                $JoinTable = array(
                    "academicyear" => "aca_id=tic_aca_year",
                    "staffprofile" => "stp_id=tic_staffprofile",
                    "priority" => "pri_id=tic_priority",
                    "ticket_status" => "tick_st_id=tic_status",
                );
                break;
        }
        if (!empty($JoinTable)) {
            foreach ($JoinTable as $key => $val) {
                if (!in_array($key, $Omit)) {
                    $JoinType = (in_array($key, $LeftJoin)) ? "LEFT" : $JoinType;
                    $this->db->join($key, $val, $JoinType);
                }
            }
        }
    }

    public function Delete($id, $idval, $table) {
        $this->db->where($id, $idval);
        return $this->db->delete($table);
    }

    public function DropData($condition, $table) {
        $TableName = $this->TableList[$table];
        $this->db->where($condition);
        $status = $this->db->delete($TableName);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    private function _get_datatables_query($tableName, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy) {
        $this->db->from($tableName);
        $this->db->where($Condition);
        $i = 0;
        foreach ($ColumnSearch as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($ColumnSearch) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($ColumnOrder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($OrderBy)) {
            $order = $OrderBy;
            $this->db->order_by(key($order));
        }
    }

    function get_datatables($TableList, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy) {
        $TableName = $this->TableList[$TableList];
        $this->_get_datatables_query($TableName, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($TableList, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy) {
        $TableName = $this->TableList[$TableList];
        $this->_get_datatables_query($TableName, $Condition, $ColumnOrder, $ColumnSearch, $OrderBy);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($TableList, $Condition) {
        $TableName = $this->TableList[$TableList];
        $this->db->from($TableName);
        $this->db->where($Condition);
        return $this->db->count_all_results();
    }

}
