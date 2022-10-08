<?php
/*
Template Name:Make a offer
*/
include(TEMPLATEPATH . '/header-dashboard.php');
$rec_id = $_GET['rec_id'];
$cand_row_id = $_GET['r_id'];
$job_id = $_GET['j_id'];
$emp_id = get_current_user_id();

/*************Recruiter details*************/

$recruiter_name = get_user_meta($rec_id, 'first_name', true);
$recruiter_lastname = get_user_meta($rec_id, 'last_name', true);
$rec_data = get_userdata($rec_id);
$rec_email = $rec_data->data->user_email;
$recruiter_phone = get_field('recruiter_phone', 'user_' . $rec_id);
$recruiter_postal = get_field('postal_address', 'user_' . $rec_id);

/***************Candidate details*****************/

$candidate = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$cand_row_id");
$candidate_data = unserialize($candidate[0]->candidate_data);
$candidate_name = $candidate_data['name'];
$candidate_email = $candidate_data['email'];

/***********Job Details**************/

$job_title = get_the_title($job_id);
$emp_type = get_field('employement_type', $job_id);
$start_date = get_field('earliest_start_date', $job_id);
$end_date = get_field('job_closing_date', $job_id);
$job_type = get_field('job_type', $job_id);
$ir35_status = get_field('ir35_status', $job_id);
$equity = get_field('equity', $job_id);
$healthcare = get_field('healthcare', $job_id);
$other_benifits = get_field('other_benifits', $job_id);
$travel_required = get_field('travel_required', $job_id);
$salary = get_field('salary_required', $job_id);
$bonus = get_field('bonus_available', $job_id);
?>

<section class="dashboard-section">
    <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH . '/dashboard-employer/employer-rating-section.php');  ?>
        <div class="offer-recieved-wrap my-form">
            <form id="make_offer">
                <div class="row">
                    <div class="offer-wrap form-heading col-12 col-xl-6">
                        <h5>Candidate Details</h5>
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="Russell Phyers" value="<?php echo $candidate_name; ?>" name="candidate_name" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email address</label>
                                    <input type="text" class="form-control" placeholder="info@dummy.com" value="<?php echo $candidate_email; ?>" name="candidate_email" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offer-wrap form-heading col-12 col-xl-6">
                        <h5>Recruiter Details</h5>
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="Russell Phyers" value="<?php echo $recruiter_name . ' ' . $recruiter_lastname; ?>" name="recruiter_full_name" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" placeholder="123-456-7890" value="<?php echo $recruiter_phone; ?>" name="recruiter_phone" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email address</label>
                                    <input type="text" class="form-control" placeholder="info@dummy.com" value="<?php echo $rec_email; ?>" name="recruiter_email" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Postal Address</label>
                                    <input type="text" class="form-control" placeholder="5211" value="<?php echo $recruiter_postal; ?>" name="recruiter_postal" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offer-wrap form-heading col-12">
                        <h5>Key Offer Details</h5>
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Job Title</label>
                                    <input type="text" class="form-control" placeholder="Data Scientist" value="<?php echo $job_title; ?>" name="job_title" readonly>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Employment Type</label>
                                    <select class="form-control" name="employment_type">
                                        <option value="full_time" <?php if ($emp_type == 'full_time') {
                                                                        echo 'selected';
                                                                    } ?>>Full-Time</option>
                                        <option value="part_time" <?php if ($emp_type == 'part_time') {
                                                                        echo 'selected';
                                                                    } ?>>Part-Time</option>
                                        <option value="contract" <?php if ($emp_type == 'contract') {
                                                                        echo 'selected';
                                                                    } ?>>Contract</option>
                                        <option value="volunteer" <?php if ($emp_type == 'volunteer') {
                                                                        echo 'selected';
                                                                    } ?>>Volunteer</option>
                                        <option value="temprory" <?php if ($emp_type == 'temprory') {
                                                                        echo 'selected';
                                                                    } ?>>Temprory</option>
                                        <option value="internship" <?php if ($emp_type == 'internship') {
                                                                        echo 'selected';
                                                                    } ?>>Internship</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" placeholder="Select Date" value="<?php echo $start_date; ?>" name="start_date">
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Location</label>
                                    <input type="text" class="form-control" placeholder="Mohali" value="" name="job_location">
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>End Date (if applicable)</label>
                                    <input type="date" class="form-control" placeholder="Select Date" value="<?php echo $end_date; ?>" name="end_date">
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Onsite/Remote</label>
                                    <select class="form-control" name="job_type">
                                        <option value="">Choose any option</option>
                                        <option value="onsite" <?php if ($job_type == 'onsite') {
                                                                    echo 'selected';
                                                                } ?>>Onsite</option>
                                        <option value="remote" <?php if ($job_type == 'remote') {
                                                                    echo 'selected';
                                                                } ?>>Remote</option>
                                        <option value="hybrid" <?php if ($job_type == 'hybrid') {
                                                                    echo 'selected';
                                                                } ?>>Hybrid</option>
                                        <option value="candidate_decides" <?php if ($job_type == 'candidate_decides') {
                                                                                echo 'selected';
                                                                            } ?>>Candidate Decides</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>IR35 Status (if applicable)</label>
                                    <select class="form-control" name="ir_status">
                                        <option value="">Please choose any option</option>
                                        <option <?php if ($ir35_status == 'in') {
                                                    echo 'selected';
                                                } ?>>In</option>
                                        <option <?php if ($ir35_status == 'Out') {
                                                    echo 'selected';
                                                } ?>>Out</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Basic Salary</label>
                                    <div class="amount">
                                        <span>$</span>
                                        <input type="number" class="form-control" placeholder="$570" name="basic_salary" value="<?php echo $salary; ?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Bonus</label>
                                    <input type="text" class="form-control" placeholder="$100" name="bonus" value="<?php echo $bonus; ?>">
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Notice Period</label>
                                    <select class="form-control" name="notice_period">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Equity</label>
                                    <select class="form-control" name="equity">
                                        <option value="">Please choose any option</option>
                                        <option value="yes" <?php if ($equity == 'yes') {
                                                                echo 'selected';
                                                            } ?>>Yes</option>
                                        <option value="no" <?php if ($equity == 'no') {
                                                                echo 'selected';
                                                            } ?>>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Healthcare</label>
                                    <select class="form-control" name="health_type">
                                        <option value="">Please choose any option</option>
                                        <option value="yes" <?php if ($healthcare == 'yes') {
                                                                echo 'selected';
                                                            } ?>>Yes</option>
                                        <option value="no" <?php if ($healthcare == 'no') {
                                                                echo 'selected';
                                                            } ?>>No</option>
                                        <option value="just_healthcare" <?php if ($healthcare == 'just_healthcare') {
                                                                            echo 'selected';
                                                                        } ?>>Just Healthcare</option>
                                        <option value="just_dental" <?php if ($healthcare == 'just_dental') {
                                                                        echo 'selected';
                                                                    } ?>>Just Dental</option>
                                        <option value="dental_healthcare" <?php if ($healthcare == 'dental_healthcare') {
                                                                                echo 'selected';
                                                                            } ?>>Dental and Healthcare</option>
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
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Any other benefits</label>
                                    <input type="text" class="form-control" placeholder="Lorem Ipsum" name="other_benifits" value="<?php echo $other_benifits; ?>">
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Travel Required</label>
                                    <select class="form-control" name="travel_require">
                                        <option value="">Please choose any option</option>
                                        <option value="frequent" <?php if ($travel_required == 'frequent') {
                                                                        echo 'selected';
                                                                    } ?>>Yes-Frequent</option>
                                        <option value="not_often" <?php if ($travel_required == 'not_often') {
                                                                        echo 'selected';
                                                                    } ?>>Yes-Not Often</option>
                                        <option value="no" <?php if ($travel_required == 'no') {
                                                                echo 'selected';
                                                            } ?>>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-xl-4">
                                    <label>Additional Notes</label>
                                    <input type="text" class="form-control" placeholder="Lorem Ipsum" name="additonal_notes">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offer-wrap form-heading col-md-12">
                        <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>A brief synopsis of the role</label>
                                    <textarea class="form-control" name="synopsis" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group cmn-mg-btm col-md-12">
                        <div class="form-btn-wrap">
                            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
                            <input type="hidden" name="rec_id" value="<?php echo $rec_id; ?>">
                            <input type="hidden" name="row_id" value="<?php echo $cand_row_id; ?>">
                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                            <input type="hidden" name="action" value="make_offer">
                            <button type="submit" class="my-btn my-btn-3 submit-offer" class="offer_post" data-status="draft">Save Draft Offer</button>
                            <button type="submit" class="my-btn my-btn-3 submit-offer" class="offer_post" data-status="publish">Send To Recruiter</button>
                            <button type="reset" class="my-btn my-btn-3" id="cancel_offer">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include(TEMPLATEPATH . '/footer-dashboard.php');  ?>