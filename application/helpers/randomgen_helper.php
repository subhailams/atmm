<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * function randomgen
 * 
 */

function randomgen($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function calculateexp($months)
{
    $year = floor($months / 12);
    if ($year > 1):
        $year = $year . " Years";
    elseif ($year === 1):
        $year = $year . " Year";
    else:
        $year = $year . " Year";
    endif;
    $mth = $months % 12;
    if ($mth > 1):
        $mth = $mth . " Months";
    elseif ($mth === 1):
        $mth = $mth . " Months";
    else:
        $mth = "";
    endif;
    return $year . " " . $mth;
}

function passwordhashencode($Password)
{
    $options = array("cost" => 4);
    return password_hash($Password, PASSWORD_BCRYPT, $options);
}

function verifypassword($password, $hashPassword)
{
    if (password_verify($password, $hashPassword)) {
        return true;
    } else {
        return false;
    }
}