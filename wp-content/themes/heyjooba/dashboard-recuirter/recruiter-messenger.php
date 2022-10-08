<?php 
/*
Template Name:Recruiter Messenger
*/
include(TEMPLATEPATH.'/header-recruiter.php'); 
$id = get_current_user_id();

/**********Employers who recieve candidate for job*****************/
$all_employers = $wpdb->get_results("SELECT emp_id FROM `save_candidate` WHERE `rec_id` = $id");

foreach($all_employers as $employers_dis){
    $employers_display[] = $employers_dis->emp_id;
}
$employers_display = array_unique($employers_display);

?> 
<section class="dashboard-section">
        <div class="dashboard-main-content">
   <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
            <div class="messenger-wrap bg-white-shadow cmn-padding">
                <div class="form-heading">
                    <h5>Messages</h5>
                </div>
                    <div class="messenger-sidebar">
                        <form class="msg-search">
                            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                        </form>
                        <button class="msg-toggle-btn"></button>
                        <div class="msg-list-wrap">
                            <div class="msg-list">
                                <?php
                                foreach($employers_display as $employers){ 
                                    $profile_img = get_field('profile_image','user_'.$employers);
                                    if(empty($profile_img)){
                                        $profile_img = get_template_directory_uri().'/images/dummy.jpg';   
                                    }
                                    $last_chat= $wpdb->get_results("SELECT * FROM chat WHERE sender_id= $id AND reciever_id = $employers ORDER BY ID DESC");
                                    $last_chat_msg = $last_chat[0]->chat_content;
                                    $last_msg_time = $last_chat[0]->chat_time;
                                ?>
                                <article onclick="create_room_recruiter(<?php echo $id;?>,<?php echo $employers; ?>)" id="create">
                                    <figure>
                                        <img src="<?php echo $profile_img; ?>" alt="messenger-img">
                                    </figure>
                                    <div class="messenger-details">
                                        <p>
                                            <b><?php echo get_user_meta($employers,'first_name',true); ?></b>
                                            <small><?php echo date('H:i',$last_msg_time); ?></small>
                                        </p>
                                        <p>
                                            <i><?php echo $last_chat_msg; ?></i>
                                        </p>
                                    </div>
                                    <a href="javascript:void(0);"></a>
                                </article>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="messenger-area">
                        <div class="messenger-area-wrap">
                            <div class="messenger-area-details">
                                <figure>
                                    <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/chat-4.png" alt="messenger-img">
                                </figure>
                                <div class="messenger-details">
                                    <p>
                                        <b>Annette Black</b>
                                    </p>
                                    <p>
                                        <i>Annette Black</i>
                                    </p>
                                </div>
                            </div>
                            <div class="messenger-msg-wrap" id="append_chat">
<!--
                                <div class="msg-wrap right-msg">
                                    <div class="msg-content">
                                        <div class="main-msg">
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting the
                                                industry. Lorem Ipsum has been the industry's standard dummy text sed
                                                ever
                                                since the 1500s, when an unknown printer took a gallery .
                                            </p>
                                        </div>
                                        <p>
                                            Today 10:10 am
                                        </p>
                                    </div>
                                    <figure>
                                        <img src="<?php //echo get_template_directory_uri();?>/dashboard-employer/images/chat-9.png" alt="messenger-img">
                                    </figure>
                                </div>
-->
                            </div>
                            <div class="msg-type-area">
                                <form id="recruiter_chat">
                                    <input type="text" placeholder="I decided to send you an invitation." name="chat_content" id="rec_chat_input">
                                    <input type="hidden" name="sender_id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="reciever_id" value="" id="recv_id">
                                    <button type="submit" class="chat-send" id="send_rec_chat">
                                        <i class="fa fa-telegram" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>

<?php if(isset($_GET['emp_id']) && $_GET['emp_id'] != ''){?>
<script>
jQuery(document).ready(function(){
   jQuery("#create").click();
});
</script>

<?php }?>
