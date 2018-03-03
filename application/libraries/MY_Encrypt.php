<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Encrypt extends CI_Encrypt {

    function encode($string, $key = "", $url_safe = TRUE) {
        // you may change these values to your own
        $secret_key = 'RMKEcSTAfF';
        $secret_iv = 'ViDCsE';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        return $output;
    }

    function decode($string, $key = "") {
        // you may change these values to your own
        $secret_key = 'RMKEcSTAfF';
        $secret_iv = 'ViDCsE';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }

}
