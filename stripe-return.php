<?php
$data = file_get_contents("php://input");

include('wp-config.php');
global $wpdb;
$events = json_decode($data, true);
$serData = serialize($events);

// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("pradeep.kumar@imarkinfotech.com","My subject",$serData);
?>