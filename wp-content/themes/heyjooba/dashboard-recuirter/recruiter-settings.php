<?php 
/*
Template Name:Recruiter Settings
*/
include(TEMPLATEPATH.'/header-recruiter.php');

$id = get_current_user_id();

$profile_image = get_field('profile_image','user_'.$id);

$name = get_user_meta($id,'first_name',true);

$surname = get_user_meta($id,'last_name',true);

$email = get_user_meta($id,'email',true);

$emp_status = get_field('employment_status','user_'.$id);

$linkedin_profile = get_field('linkedin_profile','user_'.$id);

$city = get_field('city','user_'.$id);
?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
         <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="seting-form my-form">
                    <div class="form-heading">
                        <h5>Profile</h5>
                        <p>This information will be displayed publicity so be careful what you share.</p>
                    </div>
                    <input type="hidden" id="redirection" data-url="<?php echo site_url(); ?>">
                    <form id="recruiter_settings" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="profile_image" onchange="loadFile(event);">
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('<?php if(!empty($profile_image)){echo $profile_image;  }else{ echo get_template_directory_uri(); ?>/images/dummy.jpg <?php }?>');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Robert" name="name" value="<?php echo $name; ?>"required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Surname</label>
                                <input type="text" class="form-control" placeholder="Pattinson" name="surname" value="<?php echo $surname; ?>"required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="robert@info.com" name="email" 
                                value="<?php echo $email; ?>"required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employement Status</label>
                                <input type="text" class="form-control" placeholder="UX Designer" name="emp_status" value="<?php echo $emp_status; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Linkedin Profile</label>
                                <input type="text" class="form-control" placeholder="robert@info.com" name="linkedin_profile" value="<?php echo $linkedin_profile; ?>"required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="city" value="<?php echo $city; ?>"required>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-btn-wrap">
                                    <input type="submit" class="my-btn my-btn-3 w-auto" value="Save">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="action" value="recruiter_settings">
                                    <button type="button" class="my-btn my-btn-3" onclick="cancel_rec_set();">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="mt-5 pt-5 second-form" id="change_rec_password">
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
                                    <input type="hidden" name="action" value="change_rec_password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>