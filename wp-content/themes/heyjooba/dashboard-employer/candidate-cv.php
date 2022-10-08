<?php
/*
Template Name:Candidate cv
*/
include(TEMPLATEPATH . '/header-dashboard.php');
?>

<section class="dashboard-section">
    <div class="dashboard-main-content">
        <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
            <div class="dashboard-heading">
                <h4>Your Candidates CV</h4>
            </div>
            <div class="rating-wrap">
                <div class="dropdown">
                    <button class="my-btn my-btn-3 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><button type="button" class="">Request Interview</button></li>
                        <li><button type="button" class="">Share CV</button></li>
                        <li><button type="button" class="">Save CV</button></li>
                        <li><button type="button" class="">Reject Candidate</button></li>
                        <li><button type="button" class="">Request More Info</button></li>
                    </ul>
                </div>
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
        <div class="cv-wrap bg-white-shadow">
            <figure>
                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/cv.png" alt="cv-img">
            </figure>
        </div>
        <div class="my-btn-wrap mt-5">
            <div class="form-btn-wrap mt-2 text-center">
                <button type="button" class="my-btn my-btn-3">Back</button>
                <button type="button" class="my-btn my-btn-3">Next</button>
            </div>
        </div>
    </div>
</section>
<?php include(TEMPLATEPATH . '/footer-dashboard.php');  ?>