<?php 
/*
Template Name:Recruiter Profile
*/
include(TEMPLATEPATH.'/header-recruiter.php');

$id = get_current_user_id();

$name = get_user_meta($id,'first_name',true);
$profile_image = get_field('profile_image','user_'.$id);
$lives = get_field('recruiter_lives','user_'.$id);
$rec_exp = get_field('recruitment_experience','user_'.$id);
$re_qual = get_field('recruiter_qualificiation','user_'.$id);
$about = get_field('about_recruiter','user_'.$id);
$linkedin_prof = get_field('linkedin_profile','user_'.$id);
$expert_area = get_field('expertise_area','user_'.$id);
$phone = get_field('recruiter_phone','user_'.$id);
$postal_address = get_field('postal_address','user_'.$id);
$expertise_areas = get_field('expertise_area','user_'.$id);

?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>Create your Recruiter Profile</h4>
                </div>
            </div>
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="seting-form my-form">
                    <div class="form-heading">
                        <p>By creating the 'Area of expertise' section we will able to send you jobs that match your experience.<br>
                        Note: Businesses will be able to view your profile if you submit a candidate to one of their jobs.Your PROFILE is not searchable or viewable unless you submit a candidate to a business job post.
                        </p>
                    </div>
                    <form id="recruiter_profile" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-lg-6 order-last order-lg-first">
                            <div class="form-group">
                                <label>NAME</label>
                                <input type="text" class="form-control" placeholder="Robert" name="name" value="<?php echo $name; ?>"required>
                            </div>
                            <div class="form-group">
                                <label>LIVES</label>
                                <input type="text" class="form-control" placeholder="London" name="lives" value="<?php echo $lives; ?>"required>
                            </div>
                            <div class="form-group">
                                <label>RECRUITMENT EXPERIENCE</label>
                                <input type="text" class="form-control" placeholder="12 years" name="rec_experience" 
                                value="<?php echo $rec_exp; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>LINKEDIN PROFILE</label>
                                <input type="text" class="form-control" placeholder="linkedin.com" name="linkedin_profile" value="<?php echo $linkedin_prof; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>QUALIFICATION</label>
                                <input type="text" class="form-control" placeholder="BCA" name="qualification" value="<?php echo $re_qual; ?>"required>
                            </div>
                            <div class="form-group">
                                <label>PHONE NO.</label>
                                <input type="text" class="form-control" placeholder="BCA" name="phone" value="" required>
                            </div>
                                <div class="form-group">
                                <label>POSTAL ADDRESS</label>
                                <input type="text" class="form-control" placeholder="BCA" name="postal_address" value="<?php echo $postal_address; ?>" required>
                            </div>
                            </div>
                            <div class="col-lg-6 order-first order-lg-last">
                            <div class="form-group">
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
                        </div>
                        </div>
                        <div class="row">
                           <div class="submit-wrap form-heading col-lg-6">
                            <div class="row add-skills">
                                    <div class="form-group col-md-12">
                                        <label>Area of Expertise</label>
                                            <div class="add_skil">
                                            <input type="text" class="form-control" name="add" value="" id="add_skil" placeholder="Press enter to add your experience here...">
                                            </div>
                                            </div>
                                            <div class="form-group col-md-12" id="ad_cont">
                                            <?php
                                            if(!empty($expertise_areas)){
                                                $r = 1;
                                            foreach($expertise_areas as $expert_area){ ?>
                                            <div class="row add-skills">
                                              <input type="text" name="skill[]" value="<?php echo $expert_area['rec_expertise_area']; ?>" class="form-control">  
                                            </div>
                                            <?php   }
                                            } ?>
                                          
                                            </div>
                                        </div>
<!--
                                    <div class="form-group col-md-4">
                                        <div class="add-skills-content" id="ad_cont"></div>
                                        <?php
//                                        if(!empty($expert_area)){
//                                        $i = 1;
//                                            foreach($expert_area as $expert_ar){
                                        ?>
                                        <div class="tag" id="tag_<?php //echo $i; ?>"><input type="text" name="expertise[]" value="<?php //echo $expert_ar['rec_expertise_area']; ?>" class="form-control" readonly>
                                        <a href="javascript:void(0);" class="btn-close" onclick="remove_expertise(<?php //echo $i ; ?>);"></a>
                                        </div>
                                        <?php
//                                        $i++;
//                                            }
//                                        }
                                        ?>
                                   </div>
-->
                                </div>
                            </div> 
                            <div class="offer-wrap form-heading col-lg-6">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>About Me</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="about_me"><?php echo $about; ?></textarea>
                                    </div>
                                </div>
                         </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-btn-wrap">
                                    <input type="submit" class="my-btn my-btn-3" value="Save">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="action" value="recruiter_profile">
                                    <input type="reset" class="my-btn my-btn-3" value="Cancel">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>