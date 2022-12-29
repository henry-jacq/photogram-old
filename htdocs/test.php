<?php

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

$date = "2022-12-16 15:08:13";

$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

echo("Time stamp: ".$dateTime->getTimestamp()."\n");
echo("Current time:".time()."\n");

$balance = time() - $dateTime->getTimestamp();

echo("Balance time: ".$balance)."\n";

