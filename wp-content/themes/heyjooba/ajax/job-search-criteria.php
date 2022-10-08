<?php
session_start();
include('../../../../wp-config.php');

if(isset($_POST['keyword']) && $_POST['keyword'] != ''){
    $_SESSION['keyword'] = $_POST['keyword'];
}

if(isset($_POST['city']) && $_POST['city'] != ''){
    $_SESSION['city'] = $_POST['city'];
}

if(isset($_POST['date_posted']) && $_POST['date_posted'] != ''){
    $_SESSION['date_posted'] = $_POST['date_posted'];
}

if(isset($_POST['salary_expectation']) && $_POST['salary_expectation'] != ''){
    $_SESSION['salary_expectation'] = $_POST['salary_expectation'];
}

if(isset($_POST['experience']) && $_POST['experience'] != ''){
    $_SESSION['experience'] = $_POST['experience'];
}

if(isset($_POST['onsite_remote']) && $_POST['onsite_remote'] != ''){
    $_SESSION['onsite_remote'] = $_POST['onsite_remote'];
}
echo 1;
?>