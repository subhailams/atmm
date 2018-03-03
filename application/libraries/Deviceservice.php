<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Arugement Validation CodeIgniter implementation
 *
 * PHP version 5
 *
 * @category  CodeIgniter
 * @package   Api Render
 * @author    Sabarinathan Kalidass (sabarinathancs.@gmail.com)
 * @version   0.1
 */
class Deviceservice {

    public function __construct() {
        $this->obj = & get_instance();
    }

    public function DeviceUpdate($Updata = array(), $Condition = array(), $DUpdate = array()) {
        $Postdata = $this->obj->input->get(null, true);
        if ((empty($this->obj->UUid))):
            exit($this->obj->apirender->ThowError("Due to the Security reason this device cannot be use \n Please Try to use other device \n *Note: We are supporting only Android and IOS Devices ErrorCode:404 Email", "ResetApp()"));
        endif;
        if (0 == 0):
            if (empty($Condition)):
                $DevCondition = array("di_refer_id" => $this->obj->ReferId, "di_uuid" => $this->obj->UUid);
            else:
                $DevCondition = array("di_refer_id" => $this->obj->ReferId);
            endif;

            $DevUpdate = array(
                "di_device_name" => substr($Postdata['deviceName'], 0, 99),
                "di_os" => substr($Postdata['osVersion'], 0, 19),
                "di_platform" => $Postdata['platform'],
                "di_tran_hit" => 1,
                "di_uuid" => $Postdata['uuid'],
                "di_email" => $Postdata['deviceOwnerEmail']
            );
            $this->obj->db->where((array) $DevCondition + array("di_status" => "A"));
            $ExixtingDev = (array) $this->obj->db->get("deviceinfo")->row();
            if (empty($ExixtingDev)):
                $this->obj->db->set(array_merge((array) $DevCondition, (array) $DUpdate, (array) $DevUpdate));
                $this->obj->db->insert("deviceinfo");
            else:
                $DevUpdate["di_tran_hit"] = $ExixtingDev['di_tran_hit'] + 1;
                $this->obj->db->where($DevCondition);
                $this->obj->db->set(array_merge((array) $DUpdate, (array) $DevUpdate));
                $this->obj->db->update("deviceinfo");
            endif;
        else:
            exit($this->obj->apirender->ThowError("Due to the Security reason this device cannot be use \n Please Try to use other device \n *Note: We are supporting only Android and IOS Devices ErrorCode: 404 Device", "formcheck()"));
        endif;
        return true;
    }

    public function DevVerifi($PhoneId, $Colvalue, $Colomnid, $ThrowError = null, $ReturnAll = null) {
        if (!empty($Colomnid)) {
            if (!empty($PhoneId)) {
                $PhoneAdd = array("di_uuid" => $PhoneId);
            }
            $Extra = array($Colomnid => $Colvalue, "du_status" => "A") + (array) $PhoneAdd;
        } elseif (!empty($PhoneId)) {
            $Extra = array("di_uuid" => $PhoneId);
        } else {
            exit($this->obj->apirender->ThowError("Due to Security Reason Your Account is cannot Acess.", "ResetApp()"));
        }
        $DevCondition = array("di_status" => "A") + (array) $Extra;
        $ExUser = (array) $this->obj->db->where($DevCondition)->join("deviceuser", "deviceinfo.di_refer_id=deviceuser.du_id", LEFT)->join("devicecategory","d_id=du_category")->get("deviceinfo")->row();

        if (!empty($ExUser)):
            $ExUser = ($ExUser);
            $this->obj->ReferId = $ExUser["di_refer_id"];
            if (empty($ReturnAll)) {
                return empty($ExUser["du_phone_no"]) ? $ExUser['du_email_id'] : $ExUser["du_phone_no"];
            } else {
                return $ExUser;
            }
        else:
            if (empty($ThrowError)) {
                exit($this->obj->apirender->ThowError("This device already activated \n Note:Each account should use the unique  device to login ErrorCode:Login-404.", "ResetApp()"));
            } else {
                return null;
            }
        endif;
    }

    public function randomgen($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        $condition = array("du_user_id" => current($numbers));
        $RandomStaus = (array) $this->obj->db->where($condition)->get("deviceuser")->row();
        while (!empty($RandomStaus)) {
            shuffle($numbers);
            $condition = array("du_user_id" => current($numbers));
            $RandomStaus = (array) $this->obj->db->where($condition)->get("deviceuser")->row();
        }
        return array_slice($numbers, 0, $quantity);
    }

}
