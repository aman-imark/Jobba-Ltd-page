<?php
global $post;
?>  
<div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4><?php echo get_the_title($post->ID); ?></h4>
                </div>
                
                <div class="rating-wrap">
                    <?php if(is_page(26)){ ?>
                    <a href="<?php echo get_the_permalink(48);?>" class="my-btn my-btn-3" >Post a Job</a>
                    <?php } ?>
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