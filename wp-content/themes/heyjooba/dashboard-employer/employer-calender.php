<?php 
/*
Template Name:Dashboard Calender
*/
include(TEMPLATEPATH.'/header-dashboard.php'); 

$interviewData = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `status` LIKE 'interview-booked'");
$x=0;
foreach($interviewData as $intrdata){
    
    /*** get interview date ***/
    $cid = $intrdata->ID;
    $interviewdte = $wpdb->get_results("SELECT * FROM `interview_timing` WHERE `candidate_row_id`='".$cid."'");
    $cd = unserialize($interviewdte[0]->candidate_data);
    
    $cname = $cd['name'];
    
    $start = date('Y-m-d', strtotime($interviewdte[0]->interview_time));
    $st = $interviewdte[0]->stage;
    if($st == 'stage1'){
        $color = '#48A868';
        $stt = 'Stage 1';
    }elseif($st == 'stage2'){
        $color = '#48A868';
        $stt = 'Stage 2';
    }elseif($st == 'stage3'){
        $color = '#48A868';
        $stt = 'Stage 3';
    }elseif($st == 'stage4'){
        $color = '#48A868';
        $stt = 'Stage 4';
    }
    
    $cl = 'customEventsClass_'.$x;
    
    $forCalendar[] = array('title'=>get_the_title($intrdata->job_id),'start'=> $start, color=>$color,'stage'=>$stt,'cname'=>$cname, "className"=>$cl);
    
    $x++;
}

?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
            <div class="calender-sec-wrap bg-white-shadow cmn-mg-btm">
                <div id="event-calendar-employer"></div>
            </div>
        </div>
    </section>
<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>
<script>
jQuery(document).ready(function(){
    
    var events = <?php echo json_encode($forCalendar); ?>;
    jQuery('#event-calendar-employer').fullCalendar({
      columnHeader: true,
      defaultView: 'month',
      aspectRatio: 1.35,
      header: {
        left: 'title',
        center: '',
        right: 'today prev,next'
      },
      buttonText: {
        prev: 'prev',
        next: 'next',
        prevYear: 'prev year',
        nextYear: 'next year',
        year: 'year',
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      allDayText: 'all-day',
      events: events,
      eventClick: function(info) {
          jQuery('.'+info.className[0]).html('<div class="fc-content"><span class="fc-title">'+info.title+'</span></div><div class="detail-popup"><ul><li>'+info.stage+'</li><li>'+info.cname+'</li><li>'+info.title+'</li></ul></div>');
      }
    });
 
});
</script>
