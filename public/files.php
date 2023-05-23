<?php

include 'libs/autoload.php';

if (!isset($_GET['name'])) {
    exit;
}

$upload_path = APP_POST_UPLOAD_PATH;
$fname = $_GET['name'];

// To prevent directory traversel
if (str_contains($fname, '..')) {
    $fname = str_replace('..', '', $fname);
}

$image_path = $upload_path . $fname;

if(is_file($image_path)) {
    header("Content-Type:".mime_content_type($image_path));
    header("Content-Length:".filesize($image_path));
    header('Cache-control: max-age='.(60*60*24*365));
    header('Expires: '.gmdate(DATE_RFC1123, time()+60*60*24*365));
    header('Last-Modified: '.gmdate(DATE_RFC1123, filemtime($image_path)));
    header_remove('Pragma');
    echo(file_get_contents($image_path));
}
