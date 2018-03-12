<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This help to switch language
 */
class LanguageSwitcher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    function switchLang($language = "")
    {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        if ($language != null):
            $this->session->set_flashdata('ME_SUCCESS', ucfirst($language).' Language Changed Successfully');
        else:
            $this->session->set_flashdata('ME_ERROR', 'Something went wrong');
        endif;
        redirect($_SERVER['HTTP_REFERER']);

    }
}