<?php

/**
 * Description of About
 *
 * @author VidhyaPrakash
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Police extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render("dashboard", get_defined_vars());
    }

}
