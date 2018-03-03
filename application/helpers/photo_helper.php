
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function photo($nodaftar) {
    $Findme = 'image';
    $path = "/var/www/html/isis-apps/gambar_dasar/" . $nodaftar; // set upload path
    $ext = array('jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF');
    if (SysRun == "Local"):
        return $photo_path = "http://dummyimage.com/600x400/000/eaebf2.jpg&text=Your+Image";
        foreach ($ext as $extentions) {
            $MyString = implode("-", get_headers('http://isis-apps.um.edu.my/gambar_dasar/' . $nodaftar . '.' . $extentions));
            $pos = strpos($MyString, $Findme);
            if (!($pos === false)) {
                return 'http://isis-apps.um.edu.my/gambar_dasar/' . $nodaftar . '.' . $extentions;
                break;
            }
        }
    else:
        foreach ($ext as $extentions) {
            if (file_exists($path . '.' . $extentions)) {
                $file_path = $path . '.' . $extentions;
                $file_name = $nodaftar . "." . $extentions;
                break;
            }
        } // end foreach
        if (!$file_path) {
            $photo_path = base_url('public/images/blankuser.png');
        } else {
            $photo_path = "http://isis-apps.um.edu.my/gambar_dasar/" . $file_name;
        }
        return $photo_path;
    endif;
}

// end function
?>
