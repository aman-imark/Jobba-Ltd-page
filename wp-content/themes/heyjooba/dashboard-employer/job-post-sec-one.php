<?php
/*
Template Name:Job Post Sec One
*/
include(TEMPLATEPATH . '/header-dashboard.php');

$id = get_current_user_id();
$soft_skills_choose = get_field('soft_skills', 'options');
$soft_skill_count = count($soft_skills_choose);

if (!empty($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    $job_title = get_the_title($job_id);
    $when_want_rcv = get_field('when_you_want_to_recieve_candidates', $job_id);
    $job_location = get_field('jobs_job_location', $job_id);
    $how_many_people = get_field('how_many_people_do_you_need', $job_id);
    $emp_type = get_field('employement_type', $job_id);
    $job_closing_date = get_field('job_closing_date', $job_id);
    $earliest_start_date = get_field('earliest_start_date', $job_id);
    $latest_start_date = get_field('latest_start_date', $job_id);
    $job_type = get_field('job_type', $job_id);
    $seniority = get_field('seniority', $job_id);
    $security_clearance = get_field('security_clearance', $job_id);
    $salary_required = get_field('salary_required', $job_id);
    $equity = get_field('equity', $job_id);
    $holidays = get_field('holidays', $job_id);
    $bonus_available = get_field('bonus_available', $job_id);
    $healthcare = get_field('healthcare', $job_id);
    $other_benifits = get_field('other_benifits', $job_id);
    $offer_sponsorship = get_field('offer_sponsorship', $job_id);
    $ir35_status = get_field('ir35_status', $job_id);
    $university_of_interest = get_field('university_of_interest', $job_id);
    $travel_required = get_field('travel_required', $job_id);

    /***************Experience and skills Technical skills**********************/

    $job_skil_req = get_field('skills', $job_id);
    $job_tech_skills = get_field('job_soft_skill', $job_id);

    $experience_req = get_field('experience_added', $job_id);

    /***************Form Part 2*******************/

    $what_will_you_do = get_field('what_will_you_do', $job_id);
    $responsibilities = get_field('responsibilities', $job_id);
    $stand_out = get_field('what_will_make_someone_stand_out', $job_id);
    $what_we_want_to_avoid = get_field('what_we_want_to_avoid', $job_id);
    $why_should = get_field('why_should_someone_come_and_work_with_you', $job_id);
    $tell_us_more = get_field('tell_us_more_about_you', $job_id);

    $fee_level = get_field('fee_level', $job_id);
} else {
    $job_id = 0;
}

?>
<style>
    /* Hide all steps by default: */
    .tab {
        display: none;
    }
</style>
<section class="dashboard-section">
    <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH . '/dashboard-employer/employer-rating-section.php');  ?>
        <div class="offer-recieved-wrap my-form">
            <form id="post_job" method="post">
                <div class="tab">
                    <div class="row">
                        <div class="offer-wrap form-heading col-md-12">
                            <h5>Key Offer Details</h5>
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Job Title</label>
                                        <input type="text" class="form-control" placeholder="Data Scientist" name="job_title" value="<?php echo $job_title; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Job Location</label>
                                        <input type="text" class="form-control" placeholder="Australia" name="job_location" value="<?php echo $job_location ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>How Many People Do You Need</label>
                                        <input type="text" class="form-control" placeholder="5" name="people" value="<?php echo $how_many_people; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Employment Type</label>
                                        <select class="form-control" name="employement_type">
                                            <option value="">Please choose one option</option>
                                            <option value="Full Time" <?php if ($emp_type == 'Full Time') {echo 'selected';} ?>>Full Time</option>
                                            <option value="Part Time" <?php if ($emp_type == 'Part Time') { echo 'selected';} ?>>Part Time</option>
                                            <option value="Contract" <?php if ($emp_type == 'Contract') { echo 'selected';} ?>>Contract</option>
                                            <option value="Temprory" <?php if ($emp_type == 'Temprory') {echo 'selected';} ?>>Temprory</option>
                                            <option value="Volunteer" <?php if ($emp_type == 'Volunteer') {echo 'selected';} ?>>Volunteer</option>
                                            <option value="Internship" <?php if ($emp_type == 'Internship') {echo 'selected';} ?>>Internship</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>When do you want to recieve the candidates?</label>
                                        <select class="form-control" name="when_recieve" id="when_recieve">
                                            <option value="">Choose any option</option>
                                            <option value="on_close_date" <?php if ($when_want_rcv == 'on_close_date') {echo 'selected';} ?>>On Close date</option>
                                            <option value="recieve_as_submitted" <?php if ($when_want_rcv == 'recieve_as_submitted') {echo 'selected';} ?>>Recieve as submitted</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4" id="job_closing_date">
                                        <label>Job Closing Date</label>
                                        <input type="date" class="form-control" name="job_closing_date" value="<?php echo $job_closing_date; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Earliest Start Date</label>
                                        <input type="date" class="form-control" name="job_earliest_date" value="<?php echo $earliest_start_date; ?>">
                                    </div>
                                    <!--
<div class="form-group col-md-4">
<label>Latest Start Date</label>
<input type="date" class="form-control" name="latest_start_date" value="<?php //echo $latest_start_date; 
?>">
</div>
-->
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Work Location</label>
                                        <select class="form-control" name="job_type">
                                            <option value="">Choose any option</option>
                                            <option value="Onsite" <?php if ($job_type == 'Onsite') {echo 'selected';} ?>>Onsite</option>
                                            <option value="Remote" <?php if ($job_type == 'Remote') {echo 'selected';} ?>>Remote</option>
                                            <option value="Hybrid" <?php if ($job_type == 'Hybrid') {echo 'selected';} ?>>Hybrid</option>
                                            <option value="Candidate decides" <?php if ($job_type == 'Candidate decides') {echo 'selected';} ?>>Candidate Decides</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Seniority</label>
                                        <select class="form-control" name="seniority">
                                            <option value="">Please select one option</option>
                                            <option value="Intern" <?php if ($seniority == 'Intern') {echo 'selected';} ?>>Intern</option>
                                            <option value="Junior" <?php if ($seniority == 'Junior') {echo 'selected';} ?>>Junior</option>
                                            <option value="Mid" <?php if ($seniority == 'Mid') {echo 'selected';} ?>>Mid</option>
                                            <option value="Senior" <?php if ($seniority == 'Senior') {echo 'selected';} ?>>Senior</option>
                                            <option value="Director" <?php if ($seniority == 'Director') {echo 'selected';} ?>>Director</option>
                                            <option value="Associate" <?php if ($seniority == 'Associate') {echo 'selected';} ?>>Associate</option>
                                            <option value="C-Level" <?php if ($seniority == 'C-Level') { echo 'selected';} ?>>C-Level</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Security Clearance Required</label>
                                        <select class="form-control" name="security_clearance">
                                            <option value="">Choose any option</option>
                                            <option value="None" <?php if ($security_clearance == 'None') {echo 'selected';} ?>>None</option>
                                            <option value="Accrediation Check(AC)" <?php if ($security_clearance == 'Accrediation Check(AC)') {echo 'selected';} ?>>Accrediation Check(AC)</option>
                                            <option value="Counter Terrorist Check(CTC)" <?php if ($security_clearance == 'Counter Terrorist Check(CTC)') {echo 'selected';} ?>>Counter Terrorist Check(CTC)</option>
                                            <option value="Security Check(SC)" <?php if ($security_clearance == 'Security Check(SC)') {echo 'selected';} ?>>Security Check(SC)</option>
                                            <option value="Developed Vetting(DV)" <?php if ($security_clearance == 'Developed Vetting(DV)') {echo 'selected';} ?>>Developed Vetting(DV)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Salary Bracket- eg 50,000-60,000</label>
                                        <div class="amount">
                                            <span>$</span>
                                            <input type="number" class="form-control" placeholder="570" name="salary" value="<?php echo $salary_required; ?>">
                                        </div>  
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Equity</label>
                                        <select class="form-control" name="equity">
                                            <option value="">Please choose any option</option>
                                            <option value="yes" <?php if ($equity == 'yes') {echo 'selected';} ?>>Yes</option>
                                            <option value="no" <?php if ($equity == 'no') {echo 'selected';} ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Holidays</label>
                                        <input type="text" class="form-control" placeholder="8" name="holidays" value="<?php echo $holidays; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Bonus Available</label>
                                        <select class="form-control" name="bonus_type">
                                            <option value="">Please choose any option</option>
                                            <option value="yes" <?php if ($bonus_available == 'yes') {echo 'selected';} ?>>Yes</option>
                                            <option value="no" <?php if ($bonus_available == 'no') {echo 'selected';} ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Private Health Care/Dental</label>
                                        <select class="form-control" name="health_type">
                                            <option value="">Please choose any option</option>
                                            <option value="yes" <?php if ($healthcare == 'yes') {echo 'selected';} ?>>Yes</option>
                                            <option value="no" <?php if ($healthcare == 'no') {echo 'selected';} ?>>No</option>
                                            <option value="Just Healthcare" <?php if ($healthcare == 'Just Healthcare') {echo 'selected';} ?>>Just Healthcare</option>
                                            <option value="Just Dental" <?php if ($healthcare == 'Just Dental') {echo 'selected';} ?>>Just Dental</option>
                                            <option value="Dental and Healthcare" <?php if ($healthcare == 'Dental and Healthcare') {echo 'selected';} ?>>Dental and Healthcare</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Any other benefits</label>
                                        <input type="text" class="form-control" placeholder="Lorem Ipsum" name="benifits" value="<?php echo $other_benifits; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Offer Sponsorship</label>
                                        <select class="form-control" name="offer_sponsorship">
                                            <option value="">Please choose any option</option>
                                            <option <?php if ($offer_sponsorship == 'yes') {echo 'selected';} ?>>Yes</option>
                                            <option <?php if ($offer_sponsorship == 'No') {echo 'selected';} ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>IR35 Status</label>
                                        <select class="form-control" name="ir_status">
                                            <option value="">Please choose any option</option>
                                            <option value="In" <?php if ($ir35_status == 'In') {echo 'selected';} ?>>In</option>
                                            <option value="Out" <?php if ($ir35_status == 'Out') {echo 'selected';} ?>>Out</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Is a degree mandatory?</label>
                                        <select class="form-control" name="university_interest">
                                            <option value="">Please choose any option</option>
                                            <option value="yes" <?php if ($university_of_interest == 'yes') echo 'selected'; ?>>Yes</option>
                                            <option value="no" <?php if ($university_of_interest == 'no') echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-4">
                                        <label>Travel Required</label>
                                        <select class="form-control" name="travel_require">
                                            <option value="">Please choose any option</option>
                                            <option value="Yes-Frequent" <?php if ($travel_required == 'Yes-Frequent') {echo 'selected';} ?>>Yes-Frequent</option>
                                            <option value="Yes-Not Often" <?php if ($travel_required == 'Yes-Not Often') {echo 'selected';} ?>>Yes-Not Often</option>
                                            <option value="No" <?php if ($travel_required == 'No') {echo 'selected';} ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Submit-wrap form-heading col-lg-12 col-xl-6">
                            <h5>
                                <span>List technology skill level required </span>
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </h5>
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row add-skills">
                                    <?php
                                    if (!empty($job_skil_req)) {
                                        foreach ($job_skil_req as $job_tech_skl) { ?>
                                    <div class="col-md-6">
                                        <div class="tech_skil_input form-group">
                                            <input type="text" name="skill[]" value="<?php echo $job_tech_skl['job_skill_name']; ?>" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6 tech_skl_level">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice" <?php if ($job_tech_skl['job_skill_rating'] == 'novoice') {
                                            echo 'selected';
                                        } ?>>Novoice</option>
                                                <option value="beginner" <?php if ($job_tech_skl['job_skill_rating'] == 'beginner') {
                                            echo 'selected';
                                        } ?>>Beginner</option>
                                                <option value="competent" <?php if ($job_tech_skl['job_skill_rating'] == 'competent') {
                                            echo 'selected';
                                        } ?>>Competent</option>
                                                <option value="proficient" <?php if ($job_tech_skl['job_skill_rating'] == 'proficient') {
                                            echo 'selected';
                                        } ?>>Proficient</option>
                                                <option value="expert" <?php if ($job_tech_skl['job_skill_rating'] == 'expert') {
                                            echo 'selected';
                                        } ?>>Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php    }
                                    } else {
                                    ?>
                                    <div class="col-md-6">
                                        <div class="tech_skil_input form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6 tech_skl_level">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="add_skil">
                                    </div>
                                    <button class="btn btn-red" type="button" onclick="add_more_technical_skills();">Click to add more skills</button>
                                </div>
                            </div>
                        </div>
                        <div class="Submit-wrap form-heading col-lg-12 col-xl-6">
                            <h5>
                                <span>Add Soft Skills</span>
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </h5>
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <?php
                                    if (!empty($job_tech_skills)) {
                                        foreach ($job_tech_skills as $job_soft_skl) {
                                            $soft_skl_name = $job_soft_skl['job_soft_skill_name'];
                                            $soft_skl_level = $job_soft_skl['job_soft_skill_level'];
                                    ?>
                                    <div class="col-md-6 soft_skils" id="soft_skills_name">
                                        <div class="form-group">
                                            <select class="form-control skill_count" placeholder="Add Skills" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                            foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>" <?php if ($soft_skl_name == $soft_skill_chose['soft_skills_name']) {
                                                echo 'selected';
                                            } ?>>
                                                    <?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="soft_skills_level">
                                        <div class="form-group"><select class="form-control" name="soft_skills_level[]">
                                            <option value="">Choose any option</option>
                                            <option value="excellent" <?php if ($soft_skl_level == 'excellent') {
                                                    echo 'selected';
                                                } ?>>Excellent</option>
                                            <option value="good" <?php if ($soft_skl_level == 'good') {
                                                    echo 'selected';
                                                } ?>>Good</option>
                                            <option value="medium" <?php if ($soft_skl_level == 'medium') {
                                                    echo 'selected';
                                                } ?>>Medium</option>
                                            <option value="poor" <?php if ($soft_skl_level == 'poor') {
                                                    echo 'selected';
                                                } ?>>Poor</option>
                                            <option value="very_bad" <?php if ($soft_skl_level == 'very_bad') {
                                                    echo 'selected';
                                                } ?>>Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php  }
                                    } else { ?>
                                    <div class="col-md-6 soft_skils" id="soft_skills_name">
                                        <div class="form-group">
                                            <select class="form-control skill_count" placeholder="Add Skills" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils" id="soft_skills_level">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="add_soft_skil">
                                    </div>
                                </div>
                                <button class="btn btn-red" type="button" onclick="add_soft_skills_level(<?php echo $soft_skill_count; ?>);">Click to add more skills</button>
                            </div>
                        </div>
                        <div class="Submit-wrap form-heading col-md-12">
                            <h5>
                                <span>How many years experience does the candidate have </span>
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </h5>
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="add_exp">
                                        <?php
                                        $e = rand(); ?>
                                        <div class="row xyz add-skills-content append_<?php echo $e; ?> year_exp edit-skill" id="ad_cont">
                                            <?php
                                            if (!empty($experience_req)) {
                                               
                                                foreach ($experience_req as $experience_required) { 
                                            ?>
                                            <div class="col-md-6 exp_input experience_input">
                                                <div class="form-group">
                                                    <input type="text" name="experience[]" value="<?php echo $experience_required['exp_field_name']; ?>" class="form-control exp_rating" placeholder=" Add Experience">
                                                </div>
                                            </div>
                                            <div class="col-md-6 experience_rating">
                                                <div class="form-group">
                                                    <select name="exp_count[]" class="form-control">
                                                        <option value="" <?php if ($experience_required['years_of_experience'] == "") {
                                                    echo 'selected';
                                                } ?> >Please choose any option</option>
                                                        <option value="0" <?php if ($experience_required['years_of_experience'] == 0) {
                                                    echo 'selected';
                                                } ?>>0</option>
                                                        <option value="1" <?php if ($experience_required['years_of_experience'] == 1) {
                                                    echo 'selected';
                                                } ?>>1</option>
                                                        <option value="2" <?php if ($experience_required['years_of_experience'] == 2) {
                                                    echo 'selected';
                                                } ?>>2</option>
                                                        <option value="3" <?php if ($experience_required['years_of_experience'] == 3) {
                                                    echo 'selected';
                                                } ?>>3</option>
                                                        <option value="4" <?php if ($experience_required['years_of_experience'] == 4) {
                                                    echo 'selected';
                                                } ?>>4</option>
                                                        <option value="5" <?php if ($experience_required['years_of_experience'] == 5) {
                                                    echo 'selected';
                                                } ?>>5</option>
                                                        <option value="6" <?php if ($experience_required['years_of_experience'] == 6) {
                                                    echo 'selected';
                                                } ?>>6</option>
                                                        <option value="7" <?php if ($experience_required['years_of_experience'] == 7) {
                                                    echo 'selected';
                                                } ?>>7</option>
                                                        <option value="8" <?php if ($experience_required['years_of_experience'] == 8) {
                                                    echo 'selected';
                                                } ?>>8</option>
                                                        <option value="9" <?php if ($experience_required['years_of_experience'] == 9) {
                                                    echo 'selected';
                                                } ?>>9</option>
                                                        <option value="10" <?php if ($experience_required['years_of_experience'] == 10) {
                                                    echo 'selected';
                                                } ?>>10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php  }
                                            } else { 
                                            ?>
                                            <div class="col-md-6 experience_input">
                                                <div class="form-group">
                                                    <input type="text" name="experience[]" value="" class="form-control exp_rating" placeholder="Add Experience">
                                                </div>
                                            </div>
                                            <div class="col-md-6 experience_rating">
                                                <div class="form-group">
                                                    <select name="exp_count[]" class="form-control">
                                                        <option value="">Choose any option</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="experience[]" value="" class="form-control exp_rating" placeholder="Add Experience">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="exp_count[]" class="form-control">
                                                        <option value="">Choose any option</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="experience[]" value="" class="form-control exp_rating" placeholder="Add Experience">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="exp_count[]" class="form-control">
                                                        <option value="">Choose any option</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="experience[]" value="" class="form-control exp_rating" placeholder="Add Experience">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="exp_count[]" class="form-control">
                                                        <option value="">Choose any option</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="experience[]" value="" class="form-control exp_rating" placeholder="Add Experience">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="exp_count[]" class="form-control">
                                                        <option value="">Choose any option</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="experience[]" value="" class="form-control exp_rating" placeholder="Add Experience">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="exp_count[]" class="form-control">
                                                        <option value="">Choose any option</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                                <?php
                                                   }
                                                ?>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                     <button class="btn btn-red" type="button" onclick="add_experience_level();">Click to add more experience</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group cmn-mg-btm text-center col-md-12">
                            <div class="form-btn-wrap">
                                <a href="javascript:void(0); " class="my-btn my-btn-3" id="draft" onclick="post_a_job('draft');">Draft</a>
                            </div>
                        </div>
                        <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                    </div>

                <div class="tab">
                    <div class="row">
                        <div class="offer-wrap form-heading col-md-6">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>What they will do…</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_wil_you_do"><?php echo $what_will_you_do; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offer-wrap form-heading col-md-6">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>Responsibilities</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="responsibilities"><?php echo $responsibilities; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="offer-wrap form-heading col-md-6">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>What will make someone stand out…</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_will_make_stand"><?php echo $stand_out; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offer-wrap form-heading col-md-6">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>What we want to avoid…</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_avoid"><?php echo $what_we_want_to_avoid; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offer-wrap form-heading col-md-6">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>Why should someone come and work with you...</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="why_work"><?php echo $why_should; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offer-wrap form-heading col-md-12">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>Tell us more about working for you. It’s really important to paint a
                                            picture of office life in order to find the right personality fit.
                                        </label>
                                        <textarea class="form-control" placeholder="Paint a picture of how it all works.&#10;Is there beer and wine in the kitchen fridge or just milk and last nights left overs?&#10;Is it more hoodies and jeans , chino’s and shirts or suit and tie?&#10;Is there a flashy coffee machine or just a kettle?&#10;Tell us about how sociable the office is." name="more_about_you"><?php echo $tell_us_more; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group cmn-mg-btm text-center col-md-12">
                            <div class="form-btn-wrap">
                                <a href="javascript:void(0); " class="my-btn my-btn-3" id="draft" onclick="post_a_job('draft');">Draft</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="range-form-wrap cmn-padding bg-white-shadow">
                                <div class="row">
                                    <div class="form-heading col-md-12">
                                        <h5>1. Pick your fee level. </h5>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="range-bar-wrapper">
                                            <div class="range-bar-wrap">
                                                <div class="bar"></div>
                                                <ul>
                                                    <li>
                                                        <span>
                                                            0%
                                                        </span>
                                                    </li>
                                                    <li></li>
                                                    <li>
                                                        <span>
                                                            10%
                                                        </span>
                                                    </li>
                                                    <li></li>
                                                    <li>
                                                        <span>
                                                            20%
                                                        </span>
                                                    </li>
                                                    <li></li>
                                                    <li>
                                                        <span>
                                                            30%
                                                        </span>
                                                    </li>
                                                    <li></li>
                                                    <li>
                                                        <span>
                                                            40%
                                                        </span>
                                                    </li>
                                                    <li></li>
                                                    <li>
                                                        <span>
                                                            50%
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="form-heading d-flex">
                                                    <h5>You have chosen fee level</h5>
                                                    <input type="text" class="percent" value="" name="fee_level_percentage" id="fee_level_percentage">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="form-btn-wrap-next">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="my-btn my-btn-3">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="my-btn my-btn-3">Next</button>
                        <a href="javascript:void(0);" id="submit-btn" class="my-btn my-btn-3" onclick="post_a_job('publish');" style="display:none;">Submit</a>
                        <!--                          <button type="submit" style="display:none;" >Submit</button>-->
                        <input type="hidden" name="action" value="post_jobbbbb">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include(TEMPLATEPATH . '/footer-dashboard.php');  ?>



<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="<?php //echo get_template_directory_uri();
             ?>/dashboard-employer/js/custom.js"></script>
<script>
    $(function() {
        $('.range-bar-wrap').each(function() {
            var $projectBar = $(this).find('.bar');
            var $projectPercent = $(this).find('.percent');
            var $projectRange = $(this).find('.ui-slider-range');
            $projectBar.slider({
                range: "min",
                animate: true,
                value: 12.5,
                min: 0,
                max: 50,
                step: 0.5,
                slide: function(event, ui) {
                    $projectPercent.val(ui.value + "%");
//                     jQuery('#fee_level_percentage').val(ui.value);
                },
                change: function(event, ui) {
                    var $projectRange = $(this).find('.ui-slider-range');
                    var percent = ui.value;
                   
                    $projectRange.css({
                        'background': '#239290'
                    });
                }
            });
        })
    })
</script>