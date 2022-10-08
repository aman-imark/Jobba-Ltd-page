<?php 
/*
Template Name:Business profile
*/
include(TEMPLATEPATH.'/header-dashboard.php');
$id = get_current_user_id();
$name = get_user_meta($id,'first_name',true);
$email = get_user_meta($id,'email',true);
$job_title = get_field('job_title','user_'.$id);
$business_name = get_field('business_name','user_'.$id);
$com_reg_no = get_field('company_registration_no','user_'.$id);
$industries = get_field('industries','user_'.$id);
$business_web_add = get_field('business_website_address','user_'.$id);
$comp_address = get_field('company_address','user_'.$id);
$year_founded = get_field('years_founded','user_'.$id);
$employees = get_field('number_of_employees','user_'.$id);
$adress_sec_line = get_field('address_second_line','user_'.$id);
$city = get_field('towncity','user_'.$id);
$turnover = get_field('annual_turnover','user_'.$id);
$country = get_field('country','user_'.$id);
$global_presnce = get_field('global_presence','user_'.$id);
$postal_code = get_field('postal_code','user_'.$id);
$comp_logo = get_field('company_logo','user_'.$id);
$about = get_field('about_your_business','user_'.$id);
$compitiors = get_field('compititors','user_'.$id);
$base = get_field('based','user_'.$id);
$telephone = get_field('telephone','user_'.$id);
$add_col = get_field('add_collegue','user_'.$id);


?>
<style>
/* Hide all steps by default: */
.tab {
  display: none;
}
</style>
    <section class="dashboard-section">
        <div class="dashboard-main-content">
  <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="seting-form my-form">
                    <div class="form-heading">
                        
                        <p>Great! So here'll we're just going to ask you for the usual business information.It won't take long.</p>
                    </div>
                    <form id="business_profile" enctype="multipart/form-data" method="post">
                        <div class="tab">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Business Name</label>
                                <input type="text" class="form-control" placeholder="Robert" name="business_name" value="<?php echo $business_name; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Registration Number</label>
                                <input type="text" class="form-control" placeholder="Pattinson" name="company_registraion_number" value="<?php echo $com_reg_no; ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Industries</label>
                                <select class="form-control" name="industries">
                                    <option value="">Select type of industry</option>
                                    <option value="it">IT</option>
                                    <option value="testing">Testing</option>
                                    <option value="law_firm">Law Firm</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Business Website Address</label>
                                <input type="text" class="form-control" placeholder="robert@info.com" name="business_website_address" value="<?php echo $business_web_add?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>HQ:Address</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="address" value="<?php echo $comp_address?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Years Founded</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="year_founded" value="<?php echo $year_founded; ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Second Line:</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="address_second_line" value="<?php echo $adress_sec_line; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Number of employees:</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="no_of_employee" value="<?php echo $employees; ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Town/City</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="town_city" value="<?php echo $city; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Annual Turnover</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="annual_turnover" value="<?php echo $turnover; ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Country</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="country" value="<?php echo $country; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Global Presence:</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="global_presence" value="<?php echo $global_presnce; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Postal code:</label>
                                <input type="text" class="form-control" placeholder="Lorem ipsum" name="postal_code" value="<?php echo $postal_code; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Logo:</label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="company_logo" onchange="loadFile(event);">
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
<div id="imagePreview" style="background-image: url('<?php if(!empty($comp_logo)){ echo $comp_logo; }else{ echo get_template_directory_uri();?>/images/profile.png <?php } ?>'); " >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="tab">
                        <div class="row">
                        <div class = col-md-6>
                        
                            <div class="form-group">
                                <label>About your business:</label>
                                <textarea class="form-control" name="about_business" 
                                          value="<?php echo $about ?>"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Where do you stand in the market? Who are your compititors? </label>
                                <textarea class="form-control" name="compititors" 
                                          value="<?php echo $compitiors; ?>"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                       
                            <div class="form-group">
                                <label>What is your name</label>
                                <input type="text" class="form-control" placeholder="What is your name" name="name" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label>What is your job title</label>
                                <input type="text" class="form-control" placeholder="What is your job title" name="job_title" value="<?php echo $job_title; ?>">
                            </div>
                            <div class="form-group">
                                <label>Where are you based</label>
                                <input type="text" class="form-control" placeholder="Where are you based" name="base" value="<?php echo $base?>">
                            </div>
                            <div class="form-group">
                                <label>Your email address</label>
                                <input type="email" class="form-control" placeholder="Your email address" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label>Your work telephone</label>
                                <input type="text" class="form-control" placeholder="Your work telephone" name="telephone" value="<?php echo $telephone; ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            </div>
                            <div class="form-group">
                                <label>Do you want to add a colleague</label>
                                <input class="form-check-input" type="radio" name="add_collegue" value="yes" <?php if($add_col == 'yes'){ echo 'checked'; }?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                Yes
                                </label>
                                <input class="form-check-input" type="radio" name="add_collegue" value="no" <?php if($add_col == 'no'){ echo 'checked'; }?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                No
                                </label>
                                
                            </div>
                        
                        </div>
                        </div>
                        </div>
                        
                        <div style="overflow:auto;" class="form-group">
                        <div style="float:right;" class="form-btn-wrap">
                          <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="my-btn my-btn-3">Previous</button>
                          <button type="button" id="nextBtn" onclick="nextPrev(1)" class="my-btn my-btn-3">Next</button>
                          <button type="submit" id="submit-btn" class="my-btn my-btn-3" style="display:none;">Submit</button>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="action" value="update_business_profile">
                          
                        </div>
                      </div>
                    </form>
                    <div class="form-heading">
                        <p>Great! With Jobba,it's really important to tell us much about you or your business as possible.The mpre information a recruiter has when headhunting candidates for you, the better.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>