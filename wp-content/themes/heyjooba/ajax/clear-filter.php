<?php
session_start();
include('../../../../wp-config.php');

if(isset($_SESSION['keyword']) && $_SESSION['keyword'] != ''){
    unset($_SESSION['keyword']);
}

if(isset($_SESSION['city']) && $_SESSION['city'] != ''){
    unset($_SESSION['city']);
}

if(isset($_SESSION['date_posted']) && $_SESSION['date_posted'] != ''){
    unset($_SESSION['date_posted']);
}

if(isset($_SESSION['salary_expectation']) && $_SESSION['salary_expectation'] != ''){
    unset($_SESSION['salary_expectation']);
}

if(isset($_SESSION['experience']) && $_SESSION['experience'] != ''){
    unset($_SESSION['experience']);
}
if(isset($_SESSION['onsite_remote']) && $_SESSION['onsite_remote'] != ''){
    unset($_SESSION['onsite_remote']);
}


echo 1;
?>