<?php
//ini_set('display_startup_errors', 1);
//ini_set('display_errors', 1);
//error_reporting(-1);
include('../../../../wp-config.php');

global $wpdb;
$current_date = date('d M');
$sender_id= $_POST['sender_id'];
$reciever_id= $_POST['reciever_id'];
$time = strtotime(date('d-m-Y H:i:s'));
$content = nl2br($_POST['emp_message']);
$response = array();

if($content == ''){
    $content = '';
}

$chat_room_data= $wpdb->get_results("SELECT * FROM chat_room WHERE sender_id=$sender_id and reciever_id=$reciever_id");

$last_room_id=$chat_room_data[0]->ID;

if(empty($chat_room_data)){
    
    $wpdb->insert("chat_room",array(
            "sender_id"=>$sender_id,
            "reciever_id"=>$reciever_id,    
    ));
    
   $last_room_id = $wpdb->insert_id;


}else{

    if($content != ''){
           $wpdb->insert("chat",array(
                "sender_id"=>$sender_id,
                "reciever_id"=>$reciever_id,
                "chat_room_id"=>$last_room_id,
                "chat_content"=>$content,
                "chat_time"=>$time,     
            )); 
    }

}
$chat_data= $wpdb->get_results("SELECT * FROM chat WHERE chat_room_id=$last_room_id");

foreach($chat_data as $chat_employer){
    $sender = $chat_employer->sender_id;
    $reciever = $chat_employer->reciever_id;
    $message_content = $chat_employer->chat_content;
    $timestamp = $chat_employer->chat_time;

    $chat_dis_date = date('d M',$timestamp);
    if($current_date == $chat_dis_date){
        $show_time = "Today";
    }else{
        $show_time = $chat_dis_date;
    }
    $chat_dis_time = date('H:i A',$timestamp);
    
     if($sender == $sender_id){
            $profile_img = get_field('profile_image','user_'.$sender);
        if(empty($profile_img)){
            $profile_img = get_template_directory_uri.'/images/dummy.jpg';
        } ?>
  
     <div class="msg-wrap right-msg">
      <div class="msg-content">
         <div class="main-msg">
            <p>
                <?php echo $message_content; ?>
            </p>
        </div>
        <p>
            <?php echo $show_time; ?> <?php echo $chat_dis_time; ?>
        </p>
    </div>
        <figure>
            <img src="<?php echo $profile_img; ?>" alt="messenger-img">
        </figure>
    </div>
<?php      
    }else{ 
       $profile_img = get_field('profile_image','user_'.$sender);
        if(empty($profile_img)){
            $profile_img = get_template_directory_uri.'/images/dummy.jpg';
        }   
?>
       <div class="msg-wrap left-msg">
        <figure>
            <img src="<?php echo $profile_img; ?>" alt="messenger-img">
        </figure>   
      <div class="msg-content">
         <div class="main-msg">
            <p>
                <?php echo $message_content; ?>
            </p>
        </div>
        <p>
            <?php echo $show_time; ?> <?php echo $chat_dis_time; ?>
        </p>
    </div>
        
    </div>  

<?php 
     }
}