<?php
/*
Template Name:View Offer
*/

echo $offer_id = $_GET['of_d'];
echo $candidate_id = get_field('offer_candidate_id',$offer_id);
$emp_id = get_field('offer_employer_id',$offer_id);
$candidate_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidate_id");
$candidate_details = unserialize($candidate_data[0]->candidate_data);
if(!empty($_GET['rec_id'])){
 $recruiter_id = $_GET['rec_id'];   
}else{
 $recruiter_id = get_current_user_id();   
}
$rec_data = get_userdata($recruiter_id);
$rec_email = $rec_data->data->user_email;
$rec_name = get_user_meta($recruiter_id,'first_name',true).' '.get_user_meta($recruiter_id,'last_name',true);

$emp_type = get_field('offer_empoyment_type',$offer_id);

$job_type = get_field('offer_job_type',$offer_id);
$ir35_status = get_field('offer_ir35_status',$offer_id);
$basic_salry = get_field('offer_basic_salary',$offer_id);
$offer_bonus = get_field('offer_bonus',$offer_id);
$notice = get_field('offer_notice_period',$offer_id);
$equity = get_field('offer_equity',$offer_id);
$healthcare = get_field('offer_healthcare',$offer_id);
$other_benifits = get_field('offer_other_benifits',$offer_id);
$travel_required = get_field('offer_travel_required',$offer_id);
$notes = get_field('offer_notes',$offer_id);
$synopsis = get_field('offer_synopsis',$offer_id);
?>
<!-- <!doctype html> -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>! Heyjobba !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" sizes="32x32" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-recuirter/css/main.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-recuirter/css/custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">
</head>

<body class="bg-white-grey">
    <section class="dashboard-section">
        <div class="container">
    <div class="view-candidate">
        <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>View Job Offer</h4>
                </div>
            
            </div>

        <div class="offer-recieved-wrap my-form">
            <form>
                <div class="row">
                    <div class="offer-wrap form-heading col-md-6">
                        <h5>Candidate Details</h5>
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="Russell Phyers" value="<?php echo $candidate_details['name']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email address</label>
                                    <input type="text" class="form-control" placeholder="info@dummy.com" value="<?php echo $candidate_details['email']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Home Address</label>
                                    <input type="text" class="form-control" placeholder="London" value="<?php echo $candidate_details['lives']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offer-wrap form-heading col-md-6">
                        <h5>Recruiter Details</h5>
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="Russell Phyers" value="<?php echo $rec_name; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" placeholder="123-456-7890" value="<?php echo get_field('recruiter_phone','user_'.$recruiter_id); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email address</label>
                                    <input type="text" class="form-control" placeholder="info@dummy.com" value="<?php echo $rec_email; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Postal Address</label>
                                    <input type="text" class="form-control" placeholder="5211" value="<?php echo get_field('postal_address','user_'.$recruiter_id); ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offer-wrap form-heading col-md-12">
                        <h5>Key Offer Details</h5>
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Job Title</label>
                                    <input type="text" class="form-control" placeholder="Data Scientist" value="<?php echo get_field('offer_job_title',$offer_id); ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Employment Type</label>
                                    <select class="form-control" readonly>
                                        <option value="full_time" <?php if($emp_type == 'full_time'){ echo "selected"; }?>>Full Time</option>
                                        <option value="part_time" <?php if($emp_type == 'full_time'){ echo "selected"; }?>>Part Time</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" placeholder="Select Date" value="<?php echo get_field('offer_start_date',$offer_id); ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>End Date (if applicable)</label>
                                    <input type="date" class="form-control" placeholder="Select Date" value="<?php echo get_field('offer_start_date',$offer_id); ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Onsite/Remote</label>
                                    <select class="form-control" name="job_type" readonly>
                                            <option value="">Choose any option</option>
                                            <option value="onsite" <?php if($job_type == 'onsite'){ echo 'selected'; }?>>Onsite</option>
                                            <option value="remote" <?php if($job_type == 'remote'){ echo 'selected'; }?>>Remote</option>
                                            <option value="hybrid" <?php if($job_type == 'hybrid'){ echo 'selected'; }?>>Hybrid</option>
                                            <option value="candidate_decides" <?php if($job_type == 'candidate_decides'){ echo 'selected'; }?>>Candidate Decides</option>
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>IR35 Status (if applicable)</label>
                                    <select class="form-control" name="ir_status" readonly>
                                            <option value="">Please choose any option</option>
                                            <option <?php if ($ir35_status == 'in') {
                                                        echo 'selected';
                                                    } ?>>In</option>
                                            <option <?php if ($ir35_status == 'Out') {
                                                        echo 'selected';
                                                    } ?>>Out</option>
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Basic Salary</label>
                                    <input type="text" class="form-control" placeholder="$570" value="<?php echo $basic_salry; ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Bonus</label>
                                    <input type="text" class="form-control" placeholder="$100" value="<?php echo $offer_bonus; ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Notice Period</label>
                                    <select class="form-control" readonly>
                                        <option value="yes" <?php if($notice == 'yes'){ echo 'selected'; }?>>Yes</option>
                                        <option value="no" <?php if($notice == 'no'){ echo 'selected'; }?>>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Equity</label>
                                    <select class="form-control" name="equity" readonly>
                                            <option value="">Please choose any option</option>
                                            <option value="yes" <?php if ($equity == 'yes') {echo 'selected';} ?>>Yes</option>
                                            <option value="no" <?php if ($equity == 'no') {echo 'selected';
                                             } ?>>No</option>
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Healthcare</label>
                                    <select class="form-control" name="health_type" readonly>
                                            <option value="">Please choose any option</option>
                                            <option value="yes" <?php if ($healthcare == 'yes') {echo 'selected';} ?>>Yes</option>
                                            <option value="no" <?php if ($healthcare == 'no') {echo 'selected'; } ?>>No</option>
                                            <option value="just_healthcare" <?php if ($healthcare == 'just_healthcare') {echo 'selected'; } ?>>Just Healthcare</option>
                                            <option value="just_dental" <?php if ($healthcare == 'just_dental') {echo 'selected'; } ?>>Just Dental</option>
                                            <option value="dental_healthcare" <?php if ($healthcare == 'dental_healthcare') {echo 'selected'; } ?>>Dental and Healthcare</option>
                                        </select>
                                </div>
<!--
                                <div class="form-group col-md-4">
                                    <label>Dental</label>
                                    <select class="form-control">
                                        <option selected>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
-->
                                <div class="form-group col-md-4">
                                    <label>Any other benefits</label>
                                    <input type="text" class="form-control" placeholder="Lorem Ipsum" value="<?php echo $other_benifits; ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Travel Required</label>
                                    <select class="form-control" name="travel_require" readonly>
                                            <option value="">Please choose any option</option>
                                            <option value="frequent" <?php if ($travel_required == 'frequent') {echo 'selected';} ?>>Yes-Frequent</option>
                                            <option value="not_often" <?php if ($travel_required == 'not_often') {echo 'selected';} ?>>Yes-Not Often</option>
                                            <option value="no" <?php if ($travel_required == 'no') {echo 'selected';} ?>>No</option>
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Additional Notes</label>
                                    <input type="text" class="form-control" placeholder="Lorem Ipsum" value="<?php echo $notes; ?>" readonly>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offer-wrap form-heading col-md-12">
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>A brief synopsis of the role</label>
                                    <textarea class="form-control" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum." readonly><?php echo $synopsis; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="my-btn my-btn-3 submit-offer" onclick="accept_offer(<?php echo $candidate_id; ?>,<?php echo $offer_id; ?>)">Accept Offer</button>
               <button type="button" class="my-btn my-btn-3 submit-offer" data-bs-toggle="modal" data-bs-target="#Rejectoffer"></button>
            </form>
        </div>
    </div>
        </div>
</section>
    
<?php
/***************Reject Offer********************/    
?>
  
    <div class="modal fade my-modal" id="Rejectoffer" tabindex="-1" aria-labelledby="RejectofferLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Reject Offer</h4>
                        <form id="reject_offer">
                        <div class="form-group col-md-12">
<!--                          <label>Additional candidate notes</label>-->
                             <textarea class="form-control" placeholder="Submit your reason" name="offer_rejection_reason"></textarea>
                         </div>
                        <div class="form-btn-wrap">
                            <input type="submit" class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="reject_offer" value="Submit">
                            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
                            <input type="hidden" name="offer_id" value="<?php echo $_GET['of_d']; ?>">
                            <input type="hidden" name="candidate_id" value="<?php echo $candidate_id; ?>">
                            <input type="hidden" name="action" value="reject_offer">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <!-- jQuery first, then Bootstrap JS. -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <script src="<?php echo get_template_directory_uri();?>/dashboard-recuirter/js/bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script src="<?php echo get_template_directory_uri();?>/dashboard-recuirter/js/custom.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/dashboard-recuirter/js/recruiter-custom-data.js"></script>
    <?php// wp_footer(); ?>
</body>

</html>