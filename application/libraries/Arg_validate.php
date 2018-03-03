<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Arugement Validation CodeIgniter implementation
 *
 * PHP version 5
 *
 * @category  CodeIgniter
 * @package   Arugement validation CI
 * @author    Sabarinathan Kalidass (sabarinathancs.@gmail.com)
 * @version   0.1
 */
class Arg_validate {

    public function __construct() {
        $this->obj = & get_instance();
    }

    function ValidateData($Method, $CheckData = null, $Runtype = null) {
        
        if (empty($CheckData)) {
            $_POST = $_REQUEST;
        } else {
            $_POST = $_REQUEST;
            $_POST = (!empty($_POST)) ? array_merge($_POST, $CheckData) : $CheckData;
        }
        $NoValiarray = array("ShowError", "RunTime", "TypeRun");
        $Rules = ($this->obj->config->item("ValidationArray"));
        $RulesM[$Method] = (empty($Rules[$Method][$Runtype])) ? $Rules[$Method] : $Rules[$Method][$Runtype];
        unset($Rules);
        if (!empty($Rules[$Method])):
            $Keys = array_keys($Rules[$Method]);
        endif;
        $Rules[$Method] = ($Keys[0] == $Runtype) ? $RulesM[$Method] : null;
        if (!empty($Rules[$Method])) {
            foreach ($Rules[$Method] as $key => $val) {
                if (!in_array($key, $NoValiarray)) {
                    $this->obj->form_validation->set_rules($key, $val['Message'], $val['validate']);
                    if (!empty($val['Default'])) {
                        foreach ($val['Default'] as $MeKey => $Meval) {
                            $this->obj->form_validation->set_message($MeKey, $Meval);
                }
            }
                }
            }
            $FormValidateStatus = $this->obj->form_validation->run();
            $HttpRequestType = $this->obj->input->is_ajax_request();
            if ($FormValidateStatus == false) {
                if ($Rules[$Method]['RunTime'] == "ajax") {
                $message = validation_errors("(-)<div>", '<div>');
                } else {
                    $message = validation_errors("(-)", '');
                }
                $this->obj->FormError = (!empty($message)) ? explode("(-)", $message) : null;
            }
           
            
//ajax call
            if (($Rules[$Method]['RunTime'] == "ajax") && ($HttpRequestType)) {
                if ($Rules[$Method]['ShowError'] == "Y") {
                    $this->obj->FormError = (empty($this->obj->FormError)) ? null : (array_filter($this->obj->FormError));
                } else {
                    $this->obj->FormError = array("Access Denied");
                }
                //http call
            } elseif (($Rules[$Method]['RunTime'] != "ajax") && (!$HttpRequestType)) {
                if ($Rules[$Method]['ShowError'] == "Y") {
                    $this->obj->FormError = (empty($this->obj->FormError)) ? null : (array_filter($this->obj->FormError));
                } else {
                    $this->obj->FormError = array("Access Denied");
                }
            } elseif (($Rules[$Method]['RunTime'] == "api")) {
                if ($Rules[$Method]['ShowError'] == "Y") {
                    $this->obj->FormError = (empty($this->obj->FormError)) ? null : (array_filter($this->obj->FormError));
                } else {
                    $this->obj->FormError = array("Access Denied");
                }
            } else {
                if (SysRun == "Local") {
                    $this->obj->FormError = (empty($this->obj->FormError)) ? null : (array_filter($this->obj->FormError));
                } else {
                    show_error("ERROR", 500);
                }
            }
            return $FormValidateStatus;
        } else {
            return true;
        }
    }
}

?>