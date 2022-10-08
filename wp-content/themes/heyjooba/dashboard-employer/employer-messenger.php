<?php 
/*
Template Name:Employer Messenger
*/
include(TEMPLATEPATH.'/header-dashboard.php');
$id = get_current_user_id();
global $wpdb;

/**********Recruiter who submit candidate for employers job*****************/
$all_recruiters = $wpdb->get_results("SELECT rec_id FROM `save_candidate` WHERE `emp_id` = $id");

foreach($all_recruiters as $recruiters_dis){
    $recruiter_display[] = $recruiters_dis->rec_id;
}
$recruiter_display = array_unique($recruiter_display);
?> 
<section class="dashboard-section">
        <div class="dashboard-main-content">
    <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
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
                            foreach($recruiter_display as $rec_dis){
                            $profile_image = get_field('profile_image','user_'.$rec_dis);
                            if(empty($profile_image)){
                             $profile_image = get_template_directory_uri().'/images/dummy.jpg';   
                            }
                            $last_chat= $wpdb->get_results("SELECT * FROM chat WHERE sender_id= $id AND reciever_id = $rec_dis ORDER BY ID DESC");
                            $last_chat_msg = $last_chat[0]->chat_content;
                            $last_msg_time = $last_chat[0]->chat_time;
                            ?>
                            <article onclick="create_room(<?php echo $id; ?>,<?php echo $rec_dis; ?>)" id="create_r">
                                <figure>
                                    <img src="<?php echo $profile_image; ?>" alt="messenger-img">
                                </figure>
                                <div class="messenger-details">
                                    <p>
                                        <b><?php echo get_user_meta($rec_dis,'first_name',true); ?></b>
                                        <small><?php echo date('H:i A',$last_msg_time); ?></small>
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

                        </div>
                        <div class="msg-type-area">
                            <form id="chat_employer">
                                <input type="text" placeholder="I decided to send you an invitation." name="emp_message" id="emp_msg">
                                <input type="hidden" name="sender_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="reciever_id" id="rec_id" value="">
                                <button type="submit" class="chat-send" id="send_emp_chat">
                                    <i class="fa fa-telegram" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>

<?php if(isset($_GET['rec_id']) && $_GET['rec_id'] != ''){?>
<script>
jQuery(document).ready(function(){
   jQuery("#create_r").click();
});
</script>

<?php }?>