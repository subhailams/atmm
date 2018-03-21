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

    
}
