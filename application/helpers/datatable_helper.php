<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Morris Chart CodeIgniter implementation
 *
 * PHP version 5
 *
 * @category  CodeIgniter
 * @package   Morris Chart CI
 * @author    Vidhya Prakash 
 * @version   0.1
 * Copyright (c) 2016 Vidhya Prakash
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 */
if (!function_exists('chart_js')) {

    function chart_js($element, $data, $xkey, $ykeys, $labels) {
        $chart_js .= '<script type="text/javascript">(function (window, document, $, undefined) {';
        $chart_js .= 'Morris.Bar({';
        $chart_js .= "element:'" . $element . "',";
        $chart_js .= "data:[{y: '2011 Q1', a: 3, b: 2, c: 3}";
        $chart_js .= "],";
        $chart_js .= "xkey:'" . $xkey . "',";
        $chart_js .= "ykeys:[" . $ykeys . "],";
        $chart_js .= "labels:[" . $labels . "],";
        $chart_js .= "barColors: $('#" . $element . "').data('colors').split(',')";
        $chart_js .= "});";
        $chart_js .= "});(window, document, window.jQuery);</script>";

        return $chart_js;
    }

}