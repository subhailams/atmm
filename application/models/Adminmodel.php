<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Adminmodel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->TableList = array("prio" => "priority", "tick_sta" => "ticket_status", "tick" => "tickets", "exp" => "experience", "aca" => "academicyear", "msg" => "messages", "anx1_hod" => "annexure1_hod", "ax_bk" => "annexure1_books", "ax_cf" => "annexure1_conference", "ax_cs" => "annexure1_consultancy", "ax_fdp" => "annexure1_fdp", "ax_ms" => "annexure1_membership", "ax_pp" => "annexure1_paper", "ax_rs" => "annexure1_research", "ax_rg" => "annexure1_research_guidance", "ax_sd" => "annexure1_sponsored", "ax_su" => "annexure1_subject", "dept" => "departments", "desg" => "designation", "evt" => "eventtype", "ite" => "item_details", "mem" => "membershiptype", "ptc_o" => "partc_others", "ptc_t" => "partc_top", "qua" => "qualification", "sem" => "semester", "stp" => "staffprofile", "usr" => "user_role", "psta" => "projectstatus", "ax_pat" => "annexure1_patent");
        $this->SeqID = array("priority" => "pri_id", "ticket_status" => "tick_st_id", "tickets" => "tic_id", "experience" => "exp_id", "academicyear" => "aca_id", "messages" => "msg_id", "annexure1_hod" => "anx1_id", "annexure1_books" => "anx1_id", "annexure1_conference" => "anx1_id", "annexure1_consultancy" => "anx1_id", "annexure1_fdp" => "anx1_id", "annexure1_membership" => "anx1_id", "annexure1_paper" => "anx1_id", "annexure1_research" => "anx1_id", "annexure1_research_guidance" => "anx1_id", "annexure1_sponsored" => "anx1_id", "annexure1_subject" => "anx1_id", "departments" => "dept_id", "designation" => "des_id", "eventtype" => "eve_id", "item_details" => "item_id", "membershiptype" => "mem_id", "partc_others" => "ptc_id", "partc_top" => "ptc_id", "qualification" => "qua_id", "semester" => "sem_id", "staffprofile" => "stp_id", "user_role" => "role_id", "projectstatus" => "pst_id", "annexure1_patent" => "anx1_id");
    }

    public function FetchData($Condition, $Select, $TableList, $SelectAll, $GroupBY, $OrderBY) {
        $TableName = $this->TableList[$TableList];
        return $this->CSearch($Condition, $Select, $TableName, $SelectAll, $GroupBY, $OrderBY);
    }

    public function AllInsert($condition, $dataDB, $Select, $Tble) {
        return $this->Crud($condition, $dataDB, $Select, $Tble);
    }

    public function Crud($Condition, $DBdata, $Select, $TableList, $JoinRequired = true) {
        $IPAdress = ($this->input->ip_address() === "::1") ? "127.0.0.1" : $this->input->ip_address();
        $TableName = $this->TableList[$TableList];
        $CrudDetails = $this->CSearch($Condition, $Select, $TableName, null, False);
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

    public function CSearch($Condition, $Select, $TableName, $SelectAll, $JoinRequired, $JoinType, $Distinct, $Omit, $LeftJoin, $GroupBY) {
        $JoinType = NULL;
        if (!empty($Select)) {
            $this->db->select($Select, FALSE);
        }
        $_TableName = $this->TableList[$TableName];
        if (!empty($_TableName)) {
            $TableName = $_TableName;
        }
        if ($JoinRequired) {
            $this->JoinData($TableName, $JoinType, $Omit, $LeftJoin);
        }
        if ($Distinct) {
            $this->db->distinct();
        }
        if ($Condition) {
            $this->db->distinct($Condition);
        }
        if (!empty($Condition)) {
            $this->db->where($Condition);
        }
        if (!empty($GroupBY)) {
            $this->db->group_by($GroupBY);
        }
        $this->db->order_by($this->SeqId[$TableName], "asc");
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

}
