<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Arugement Validation CodeIgniter implementation
 *
 * PHP version 5
 *
 * @category  CodeIgniter
 * @package   Bug Tracker CI
 * @author    Sabarinathan Kalidass (sabarinathancs.@gmail.com)
 * @version   0.1
 */
class Errorreport {

    public function __construct() {
        $this->obj = & get_instance();
    }

    public function Bug($message, $UserInfo = null, $RetunInfo = null) {
        $OutSideUrlAccess = curl_init("http://smart-ip.net/geoip-json");
        if (empty($UserInfo)):
            $OutSideUrlAccess = curl_init("http://www.telize.com/geoip");
            curl_setopt($OutSideUrlAccess, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($OutSideUrlAccess, CURLOPT_REFERER, "http://www.telize.com/geoip");
            $UserInfo = curl_exec($OutSideUrlAccess);
            $UserInfo = (array) (json_decode($UserInfo));
            if (!empty($RetunInfo)):
                return $UserInfo;
            endif;
        endif;
        $Bug = $this->obj->load->database('default', TRUE);
        $Condition = array("ae_al_ref_id" => $this->obj->AuditRefID, "ae_message" => $message);
        $Bug->where($Condition);
        $ReturnData = $Bug->get("audit_error");
        $ReturnData = $ReturnData->result_array();
        $DBData = array(
            "ae_server_ip" => $_SERVER['SERVER_ADDR'],
            "ae_lang" => $UserInfo['latitude'],
            "ae_long" => $UserInfo['longitude'],
            "ae_isp" => $UserInfo['isp'],
            "ae_city" => $UserInfo['city'],
            "ae_ip" => $UserInfo['ip']
        );
        $Bug->set($DBData);
        if (empty($ReturnData)) {
            $Bug->set($Condition);
            $Bug->insert("audit_error");
        } else {
            $Bug->where($Condition);
            $Bug->update("audit_error");
        }
    }

    function GetIpAdd() {
        $OutSideUrlAccess = curl_init("http://www.telize.com/geoip");
        curl_setopt($OutSideUrlAccess, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($OutSideUrlAccess, CURLOPT_REFERER, "http://www.telize.com/geoip");
        $UserInfo = curl_exec($OutSideUrlAccess);
        $UserInfo = (json_decode($UserInfo));
        return $UserInfo->ip;
    }

}
