<?php

include '../bootstrap.php';

if (isset($_GET['file'])) {
    $fname = $_GET['file'];
    
    // Determine the upload path based on the namespace
    if ($_GET['namespace'] == 'posts') {
        $path = APP_STORAGE_PATH . '/posts/';
    } elseif ($_GET['namespace'] == 'avatars') {
        $path = APP_STORAGE_PATH . '/avatars/';
    } else {
        exit;
    }
    
    // To prevent directory traversal
    $fname = str_replace('..', '', $fname);
    
    $image_path = $path . $fname;

    if (is_file($image_path)) {
        header("Content-Type:" . mime_content_type($image_path));
        header("Content-Length:" . filesize($image_path));
        header('Cache-control: max-age=' . (60 * 60 * 24 * 365));
        header('Expires: ' . gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));
        header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($image_path)));
        header_remove('Pragma');
        echo(file_get_contents($image_path));
    }
} else {
    exit;
}
