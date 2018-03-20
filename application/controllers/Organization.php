<?php

/**
 * Description of About
 *
 * @author VidhyaPrakash
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Organization extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
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
        $this->render("dashboard", get_defined_vars());
    }
public function TotalUserCount() {
        $condition=array();
         $response = $this->Adminmodel->count_all("usr", $condition);
        return $response;
    }
    public function TotalCaseCount() {
        $condition=array();
         $response= $this->Adminmodel->count_all("case", $condition);
        return $response;
    }
    
    public function PendingCaseCount() {
        $condition=array("casestatus"=>'3');
         $response = $this->Adminmodel->count_all("case", $condition);
        return $response;
    }
    
    public function SolvedCaseCount() {
        $condition=array("casestatus"=>'2');
         $response = $this->Adminmodel->count_all("case", $condition);
        return $response;
    }
    
     public function NewCaseShow() {
        $condition = array("casestatus"=>'1');
        $select = "fir_no as FIR,victimname as VictimName , victimmobile as VictimMobile ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "Y", "", "", "", "", "", "");
    }
    public function SolvedCaseShow() {
        $condition = array("casestatus"=>'2');
        $select = "fir_no as FIR,victimname as VictimName , victimmobile as VictimMobile ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "Y", "", "", "", "", "", "");
    }

    
        public function PendingCaseShow() {
        $condition = array("casestatus"=>'3');
        $select = "fir_no as FIR,victimname as VictimName , victimmobile as VictimMobile ";
        return $this->Adminmodel->CSearch($condition, $select, "case", "Y", "", "", "", "", "", "");
    }

    
}
