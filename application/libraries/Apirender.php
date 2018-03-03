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
 * @version   0.2
 */
class Apirender {

    public function __construct() {
        $this->obj = & get_instance();
    }

    public function ThowError($Error, $Script) {
        $Script = $this->obj->apirender->ScriptModify($Script);
        $Error = array("Userinfo" => $this->obj->UserAcess, "Script" => $Script, "StatusCode" => 500, "Error" => str_replace(array("<div>", "</div>"), "", $Error));
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Content-Type: text/javascript');
//        if ($this->obj->Browser == "Y") {
//            debugdata("", "db");
//            debugdata(get_defined_vars());
//        }
        $this->obj->apirender->FinialRender($Error);
    }

    public function RenderData($AddEle = null) {
        $Render = array("Userinfo" => $this->obj->UserAcess, "StatusCode" => 200, "Adddata" => $AddEle, "form" => $_GET['form'], "restore" => $AddEle["restore"]);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Content-Type: text/javascript');
        $this->obj->apirender->FinialRender($Render);
    }

    public function RenderHtml($Data, $AddHtml = null, $Submit) {
        $Render = array("submit" => $Submit, "Userinfo" => $this->obj->UserAcess, "StatusCode" => "HTML", "Data" => $Data, "htmlrender" => $AddHtml, "form" => $_GET['form']);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Content-Type: text/javascript');
        $this->obj->apirender->FinialRender($Render);
    }

    public function HttpAthu() {
        return true;
        if ((!isset($_SERVER['PHP_AUTH_USER'])) || (empty($_SERVER['PHP_AUTH_USER']) || (empty($_SERVER['PHP_AUTH_PW'])))) {
            $HttpRequestType = $this->obj->input->is_ajax_request();
            if (!$HttpRequestType) {
                $this->obj->apirender->ThowError("API REQUEST KEY.");
            } else {
                header('WWW-Authenticate: Digest realm="API_REQUEST_LOGIN", qop="auth", nonce="' . null . '", opaque="' . md5("API") . '"');
                header('HTTP/1.0 401 Unauthorized');
                $this->obj->apirender->ThowError("User restrictions(File Not Found).");
            }
        } else {
            return true;
        }
    }

    public function FinialRender($Render) {
        if (!empty($_GET['callback'])) {
            exit($_GET['callback'] . "(" . json_encode($Render) . ")");
        } else {
            exit(json_encode($Render));
        }
    }

    public function ScriptModify($Script) {
        switch ($_GET['version']):
            case "1":
                if (!empty($Script)):
                    $ScriptArray = (explode(")", $Script));
                    foreach ($ScriptArray as $key => $val) {
                        $ReturnScript.=str_replace("(", "-", $val);
                    }
                endif;
                return $ReturnScript;
                break;
            default :
                return $Script;
                break;
        endswitch;
    }

}

?>