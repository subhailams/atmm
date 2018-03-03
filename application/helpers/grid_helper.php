<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Flexigrid CodeIgniter implementation
 *
 * PHP version 5
 *
 * @category  CodeIgniter
 * @package   Flexigrid CI
 * @author    Frederico Carvalho (frederico@eyeviewdesign.com)
 * @version   0.3
 * Copyright (c) 2008 Frederico Carvalho  (http://flexigrid.eyeviewdesign.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 */
if (!function_exists('build_datatable')) {

    function build_datatable($grid_id, $url, $ServerData) {
        
        //Basic propreties
        $grid_js = '<script type="text/javascript">
                     datatableUrl="' . $url . '"
                    $(document).ready(function(){';
        
        $grid_js .= '$("#' . $grid_id . '").DataTable({';
        
        if (!empty($ServerData)) {
            $grid_js .= ' "ajax": { "url": "' . $url . '","data": Clinetdata },';
        } else {
            $grid_js .= ' "ajax": "' . $url . '",';
        }
        $grid_js .= ' "serverSide": true,';
//        $grid_js .= ' "data": function(d){ d.mydata="data"  },';
        $grid_js .= ' "processing": true,"oLanguage": {  "sSearch": "Search all columns:"  },"sPaginationType": "full_numbers","dom": \'T<"clear">lfrtip\',"tableTools": { "sSwfPath": "' . base_url("assets/theme/js/plugins/datatables/copy_csv_xls_pdf.swf") . '" }';
        $grid_js .= '}); });</script>';
        
        return $grid_js;
    }

}
?>