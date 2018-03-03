<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * function debugdata
 * 
 */

function debugdata($data, $Type, $Output = "") {
    $obj = & get_instance(); // create ci object
    $obj->ModelLoad[0]['DB'][0] = "db";
    switch ($Type) {
	case "db":
	    foreach (($obj->ModelLoad) as $key => $val) {
		foreach (($val) as $keys => $Values) {
		    foreach (($Values) as $Lkeys => $LValues) {
			$Model = explode("/", $LValues);

			if (empty($Output)) {
			    var_dump($Model[count($Model) - 1]);
			   echo $echo = "<pre>";
			}
			$_Queries = ($keys == "DB") ? $obj->$Model[count($Model) - 1]->queries : $obj->$Model[count($Model) - 1]->um->queries;
			$QueriesTime = ($keys == "DB") ? $obj->$Model[count($Model) - 1]->query_times : $obj->$Model[count($Model) - 1]->um->query_times;
			foreach ($_Queries as $keyQ => $valQ) {
			    $Queries[$keyQ . "-><span style='color:red;'>RunTime: " . round($QueriesTime[$keyQ], 3) . "</span>"] = $valQ;
			}
			if (empty($Output)) {
			    print_r($Queries);
			  echo  $echo .= "</pre>";
			} else {
			    $return[$Model[count($Model) - 1]] = $Queries;
			}
		    }
		}
	    }
	    return $return;
	    break;
	case "":
	    echo "<pre>";
	    print_r($data);
	    echo "</pre>";
	    break;
	case "array":
	    echo "<pre>";
	    if (is_array($data)) {
		$obj->array_run($data);
	    } else {
		print_r($data);
	    }
	    echo "</pre>";
	    break;
	case "con":
	case "conn":
	    echo "<pre>";
	    $DBerror = (($obj->db->db_debug) == "0") ? "Not Show DB Error" : "Show Db Error";
	    echo "<p>UserName = <b>" . ($obj->db->username);
	    echo "</b></p><p>Server = <b>" . ($obj->db->hostname);
	    echo "</b></p><p>DdSelected = <b>" . ($obj->db->database);
	    echo "</b></p><p>Dderror = <b>" . $DBerror;
	    echo "</b></p><p>DB_char_set = <b>" . ($obj->db->char_set);
	    echo "</b></p><p>DB_collation = <b>" . ($obj->db->dbcollat);
	    echo "</b></p><p>BenchmarkTime = <b>" . ($obj->db->benchmark) . "</b></p>";
	    echo "</pre>";
	    break;
	case "last":
	    foreach (($obj->ModelLoad) as $key => $val) {
		foreach (($val) as $keys => $Values) {
		    foreach (($Values) as $Lkeys => $LValues) {
			$Model = explode("/", $LValues);
			var_dump($Model[count($Model) - 1]);
			echo "<pre>";
			$Queries = ($keys == "DB") ? $obj->$Model[count($Model) - 1]->queries : $obj->$Model[count($Model) - 1]->um->queries;
			print_r($Queries[count($Queries) - 1]);
			echo "Total Quires= " + count($Queries);
			echo "</pre>";
		    }
		}
	    }
	    break;
    }
}

?>
