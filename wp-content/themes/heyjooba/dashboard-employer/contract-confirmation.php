<?php
/*
Template Name: Contract Confirmation
*/
if(!empty($_GET['can_id'])){
    confirm_contract($_GET['can_id'],$_GET['emp_id'],$_GET['rec_id']);
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>! Heyjobba !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" sizes="32x32" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-employer/css/custom.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-employer/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">

</head>
    <section class="dashboard-section confirm">
        <div class="container">
        <div class="">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>Confirm Contract</h4>
                </div>
                
            </div>
            <div class="candidate-submission-wrap">
                        <div class="success-icon"></div>
                        <h4>Thanks for your confirmation</h4>
                        <p>
                            You confirmed that your candidate has recieved and signed the contract!
                        </p>
                    </div>
            </div>
        </div>
    </section>