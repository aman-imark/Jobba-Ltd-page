<?php
$id = get_current_user_id();
$user_data = get_userdata($id);
$user_role = $user_data->roles[0];
if($user_role == 'recruiter'){
include(TEMPLATEPATH.'/header-recruiter.php');
$expertise_area = get_field('expertise_area','user_'.$id)
?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>Profile</h4>
                </div>
                <div class="rating-wrap">
                    <div class="rating-wrap-inner">
                        <h6>Your Client Rating</h6>
                        <div class="rating-list">
                            <ul>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="blank-star"><i class="fa fa-star" aria-hidden="true"></i></li>
                            </ul>
                            <h6>4.0 / 5</h6>
                            <h6>Add to favorites</h6>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="submit-candidate-wrap my-form">
                <form>
                    <div class="row">
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="flex-heading mb-4">
                                </div>
                                <div class="submit-content">
                                    <div class="row">
                                        <div class="form-group d-flex col-md-4">
                                            <label>Name : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_user_meta($id,'first_name',true); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Lives : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('recruiter_lives','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Recruitment Experience : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('recruitment_experience','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Linkendin Profile : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('linkedin_profile','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Qualification: </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('recruiter_qualificiation','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Area of Expertise : </label>
                                            <?php
                                            foreach($expertise_area as $expert_area){ ?>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $expert_area['rec_expertise_area']; ?>">
                                            <?php }
                                            ?>
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>About : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('about_recruiter','user_'.$id); ?>">
                                        </div>
                                       <div class="form-group col-md-4">
                                        <label>Profile Image:</label>
                                    <div class="avatar-upload">
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('<?php echo get_field('profile_image','user_'.$id); ?>'); ">
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                           
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section> 
<?php
include(TEMPLATEPATH.'/footer-recruiter.php');
}else if($user_role == 'employee'){
    include(TEMPLATEPATH.'/header-dashboard.php');
?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>Profile</h4>
                </div>
                <div class="rating-wrap">
                    <div class="rating-wrap-inner">
                        <h6>Your Client Rating</h6>
                        <div class="rating-list">
                            <ul>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="color-yellow"><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li class="blank-star"><i class="fa fa-star" aria-hidden="true"></i></li>
                            </ul>
                            <h6>4.0 / 5</h6>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="submit-candidate-wrap my-form">
                <form>
                    <div class="row">
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="flex-heading mb-4">
                                </div>
                                <div class="submit-content">
                                    <div class="row">
                                        <div class="form-group d-flex col-md-4">
                                            <label>Business Name : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('business_name','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Company Registration No. : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('company_registration_no','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Industries : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('industries','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Business Website Address : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('business_website_address','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>HQ:Address: </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('company_address','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Second Line : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('address_second_line','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Town/City : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('towncity','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Annual Turnover : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('annual_turnover','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Country : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('country','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Global Presence: </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('global_presence','user_'.$id); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>Postal Code: </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo get_field('postal_code','user_'.$id); ?>">
                                        </div>
                                       <div class="form-group col-md-4">
                                        <label>Company Logo:</label>
                                    <div class="avatar-upload">
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('<?php echo get_field('company_logo','user_'.$id); ?>'); ">
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                           
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>   
    
<?php 
include(TEMPLATEPATH.'/footer-dashboard.php');
}
?>