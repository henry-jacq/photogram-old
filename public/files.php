<?php

include '../bootstrap.php';

use App\Core\View;

if (!isset($_GET['file'])) {
    View::renderPage();
    exit;
}

$namespace = $_GET['namespace'] ?? '';
$fname = $_GET['file'] ?? '';

$validNamespaces = ['posts', 'avatars'];

if (!in_array($namespace, $validNamespaces)) {
    View::renderPage();
    exit;
}

// To prevent directory traversal
$fname = str_replace('..', '', $fname);

$imagePath = APP_STORAGE_PATH.'/'.$namespace.'/'.$fname;

if (file_exists($imagePath) && is_file($imagePath)) {
    header("Content-Type:" . mime_content_type($imagePath));
    header("Content-Length:" . filesize($imagePath));
    header('Cache-control: max-age=' . (60 * 60 * 24 * 365));
    header('Expires: ' . gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));
    header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($imagePath)));
    header_remove('Pragma');
    echo file_get_contents($imagePath);
} else {
    View::renderPage();
}
