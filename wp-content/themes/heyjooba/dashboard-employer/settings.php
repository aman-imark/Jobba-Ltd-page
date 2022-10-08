<?php 
/*
Template Name:Settings
*/
include(TEMPLATEPATH.'/header-dashboard.php'); 
$id = get_current_user_id();

$profile = get_field('profile_image','user_'.$id);

$name = get_user_meta($id,'first_name',true);

$surname = get_user_meta($id,'last_name',true);

$email = get_user_meta($id,'email',true);

$job_title = get_field('job_title','user_'.$id);

$business_name = get_field('business_name','user_'.$id);

$location = get_field('office_location','user_'.$id);

?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
       <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
            <input type="hidden" id="redirection" data-url="<?php echo site_url(); ?>">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="seting-form my-form">
                    <div class="form-heading">
                        <h5>Profile</h5>
                        <p>This information will be displayed publicity so be careful what you share.</p>
                    </div>
                    <form id="employee_chn_setting" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" name="profile_image">
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('<?php if(!empty($profile)){ echo $profile; }else{ echo get_template_directory_uri(); ?>/images/dummy.jpg <?php }?>');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Robert" name="name" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Surname</label>
                                <input type="text" class="form-control" placeholder="Pattinson" name="surname" value="<?php echo $surname; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Job Title</label>
                                <input type="text" class="form-control" placeholder="UX Designer" name="job_title" value="<?php echo $job_title; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Work Email Address</label>
                                <input type="text" class="form-control" placeholder="robert@info.com" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Business Name</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="business_name" value="<?php echo $business_name; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Office Location</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="location" value="<?php echo $location; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-btn-wrap">
                                    <input type="submit" class="my-btn my-btn-3" value="Save">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="action" value="emp_setting">
                                    <button type="button" class="my-btn my-btn-3" onclick="empset_frm_cancel();">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="mt-5 pt-5 second-form" id=emp_set_password>
                        <div class="form-heading">
                            <h5>Change Password</h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>New Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="c_password">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-btn-wrap">
                                    <input type="submit" class="my-btn my-btn-3" value="Save Password">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="action" value="emp_chng_password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>