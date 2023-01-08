<?php

include 'libs/autoload.php';

$upload_path = get_config('upload_path');
$fname = $_GET['name'];
$image_path = $upload_path . $fname;

// To prevent directory traversel
$image_path = str_replace('..', '', $image_path);

if(is_file($image_path)){
    header("Content-Type:".mime_content_type($image_path));
    header("Content-Length:".filesize($image_path));
    echo file_get_contents($image_path);
}
