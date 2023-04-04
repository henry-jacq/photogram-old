<?php

include 'libs/autoload.php';

// var_dump($_SERVER);

// $old_time = time();

// $old_time = time() - 5 * 24 * 60 * 60;

// echo "Old time: $old_time<br>Current time: $current_time<br>";

// echo "Balance time: ".$current_time - $old_time;

// This is the time that user has taken
// sleep(3);

// $time_now = time();

// $time = $time_now - $old_time;

// if ($time < 1800) {
//     echo "Validated<br>Balance time: $time";
// } else {
//     echo "Not validated";
// }

// $date = "2022-12-16 15:08:13";

// $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

// echo("Time stamp: ".$dateTime->getTimestamp()."\n");
// echo("Current time:".time()."\n");

// $balance = time() - $dateTime->getTimestamp();

// echo("Balance time: ".$balance)."\n";


// if (Session::isAuthenticated()) {
//     print Session::isAuthenticated();
// }

// $p = new Post(1);

// print($p->getOwner());

// $image_tmp = $_FILES['post_image']['tmp_name'];
// $text = $_POST['post_text'];

// echo "Image location: $image_tmp<br>";
// echo "Caption: $text<br><br>";

// Post::registerPost($image_tmp, $text);

// $filename = $_SERVER['DOCUMENT_ROOT']."/../uploads/0a8bab831341a9f893e9f21214bbbfa2.png";

// if (file_exists($filename)) {
//     if (!unlink($filename)) {
//         echo "File '$filename' cannot be deleted.\n";
//     } else {
//         echo "File '$filename' deleted !\n";
//     }
// } else {
//     echo "File '$filename' not found !\n";
// }

// Getting the files name
// $filenames = array("/files/9f027206802862f9661eb1b0566ff82e.jpeg", "/files/d75c1bef31855589f02566ebf646eafe.png");

// foreach ($filenames as $filename) {
//     echo(get_config('upload_path').basename($filename));
//     echo "\n";
// }

// $p = new Post(110);

// $p->deletePost();

// echo "\n";
