
jQuery(document).ready(function(){
    

jQuery("#contract-form").submit(function(e){
    e.preventDefault();
    var formr = jQuery('#contract-form')[0];
    var formData = new FormData(formr);
    var url=jQuery('#theme_url').val();
    jQuery.ajax({
        type:"POST",
        url:url+'/ajax/generate-contract-pdf.php',
        data:formData,
        dataType:'json',
        processData: false,
        contentType: false,
        success:function(res){  
          if(res.status == 1){
              toastr.success(res.message);
              location.reload();
          }else{
            toastr.error(res.message);  
          }
        }
    });
});
    
/********For rejection(multiple)*********/
    
jQuery('#reject_cand').click(function(){
   jQuery('#reject_candidate'). click(); 
});
 
/*****For shortlist page(options)*****/
    
jQuery('#request_more_info').click(function(){
   jQuery('#request_interview'). toggle(); 
   jQuery('#share_cv'). toggle(); 
   jQuery('#rj_cn'). toggle(); 
   jQuery('#req_info'). toggle(); 
   jQuery('#make_offer'). toggle();
   jQuery('#share_shortlist'). toggle();
});
    
/**********Choose timings for interview*****************/

var dateToday = new Date();    
$("#picker1").datetimepicker({
    minDate: dateToday,
});
    
$("#picker2").datetimepicker({
    minDate: dateToday,
});

$("#picker3").datetimepicker({
    minDate: dateToday,
});
    
/*************************Edit Settings(Employee)*****************************/

jQuery('#employee_chn_setting').validate({
    rules:{
        name:{
            required:true, 
        },
        surname:{
            required:true, 
        },
        job_title:{
            required:true, 
        },
        linkedin_profile:{
            required:true,
        },                            
        email:{
            required:true,
            email:true,
        },
        business_name:{
            required:true,
        },
         location:{
            required:true,
        }
    },submitHandler:function(data){
        var formr = jQuery('#employee_chn_setting')[0];
        var formData = new FormData(formr);
        var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({
            type:"POST",
            url:ajax_url,
            data:formData,
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(res){  
              if(res.status == 1){
                  toastr.success(res.message);
                  location.reload();
              }else{
                toastr.error(res.message);  
              }
            }
        });
    }
});

/*********************Change password(employee)**************************/

    jQuery('#emp_set_password').validate({
    rules:{
        password:{
            required:true,
            minlength:8,
        },
        c_password:{
          required:true,
          equalTo:'#password',
        }
    },submitHandler: function(form){
        var pass_data = jQuery('#emp_set_password').serialize();
        var ajax_url= jQuery('#admin-ajax').val();
            jQuery.ajax({ 
            type: "POST",
            url: ajax_url,
            data:pass_data,
            dataType:'json',
            success: function(res){
                if(res.status == 1){
                toastr.success(res.message);
                var url = jQuery('#redirection').attr('data-url');
                    setTimeout(function(){
                    window.location.href = url;    
                },1000);
                }else{
                toastr.error("Something went wrong");  
                }
                }
            });
        } 
    });

/***************Employer profile***************************/
    
jQuery("#business_profile").submit(function(e){
    e.preventDefault();
        
        var formr = jQuery('#business_profile')[0];
        var formData = new FormData(formr);
        var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({
            type:"POST",
            url:ajax_url,
            data:formData,
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(res){  
              if(res.status == 1){
                  toastr.success(res.message);
                  location.reload();
              }else{
               toastr.error(res.message);  
              }
            }
        });
    });
    
/**********************Reject Candidate***************************/

jQuery('#reject_candidate').submit(function(e){
    e.preventDefault(); 
    var candidates = [];
    var rec_ids = 0;
    
    if(jQuery("#scand").length){
        var rds = $("#scand").val();
        candidates.push(rds);
        var rec_ids = $('#scand').attr('data-rc-id');
    }else{
        if(jQuery('.candidates').length > 1){
        jQuery('.candidates').each(function(){
            if($(this).is(':checked')){
                var rds = $(this).val();
                candidates.push(rds);
            }
        });
        var rec_ids = $('.candidates').attr('data-rc-id');
    }else{
        toastr.error("Please choose candidate first!");
    }
    }
  var candidate_ids = candidates.toString();

    var form = jQuery('#reject_candidate').serializeArray();
    form.push({ name: "row_id", value:candidate_ids});
    form.push({ name: "recruiter_id", value:rec_ids});
    var ajax_url = jQuery('#admin-ajax').val();
        $.ajax({
            type:"POST",
            data:form,
            url:ajax_url,
            dataType:'json',
            success:function(res){
              if(res.status == 1){
                toastr.success(res.message);
              location.reload();
              }else{
                toastr.error(res.message);  
              }  
            }
        });
});

/*****************Share Candidate*********************/

jQuery('#share_candidate').submit(function(e){
    e.preventDefault(); 
    var candidates = [];
    var rec_ids = 0;
    
    if(jQuery("#shcand").length){
        var rds = $("#shcand").val();
        candidates.push(rds);
        var rec_ids = $('#shcand').attr('data-rc-id');
    }else{
//        console.log(jQuery('.candidates').length);
        if(jQuery('.candidates').length > 1){
            jQuery('.candidates').each(function(){
                if($(this).is(':checked')){
                    var rds = $(this).val();
                    candidates.push(rds);
                }
            });
        }else{
            toastr.error("Please select candidate first!!");
        }
        var rec_ids = $('.candidates').attr('data-rc-id');
    }
var candidate_ids = candidates.toString();
var form = jQuery('#share_candidate').serializeArray();
form.push({ name: "row_id", value:candidate_ids});
form.push({ name: "recruiter_id", value:rec_ids});
var ajax_url = jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        data:form,
        url:ajax_url,
        dataType:'json',
        success:function(res){
          if(res.status == 1){
            toastr.success(res.message);
//              window.location.href = res.url;
          }else{
            toastr.error(res.message);  
          }  
        }
    });
});
    
/***********Submit interview timimgs************************/   
    
jQuery("#choose_interview_timings").submit(function(e){
    e.preventDefault();
       var formr = jQuery('#choose_interview_timings').serialize();
        var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({
            type:"POST",
            url:ajax_url,
            data:formr,
            dataType:'json',
            success:function(res){ 
                if(res.status == 1){
                    toastr.success(res.message);
                    location.reload();
                }else{
                  toastr.error(res.message);  
                }
            }
        });
    });
    
/*******************Edit Interview Timings************************/
    
jQuery("#edit_interview_timings").submit(function(e){
    e.preventDefault();
       var formr = jQuery('#edit_interview_timings').serialize();
        var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({
        type:"POST",
        url:ajax_url,
        data:formr,
        dataType:'json',
        success:function(res){ 
            if(res.status == 1){
                toastr.success(res.message);
                window.location.href = res.url;
            }else{
                toastr.error(res.message);  
            }
        }
    });
});
    

/**********************Share Shortlist*******************************/

jQuery('#share_shortlist_form').submit(function(e){
   e.preventDefault();
    var candidates = [];
    var rec_ids = 0;
    if(jQuery('.candidates').length > 1){
       jQuery('.candidates').each(function(){
            if($(this).is(':checked')){
                var rds = $(this).val();
                candidates.push(rds);
            }
        });
        var rec_ids = $('.candidates').attr('data-rc-id');
        var candidate_ids = candidates.toString();
        var form = jQuery('#share_shortlist_form').serializeArray();
        form.push({ name: "row_id", value:candidate_ids});
        form.push({ name: "recruiter_id", value:rec_ids});
        var ajax_url = jQuery('#admin-ajax').val();
            $.ajax({
                type:"POST",
                data:form,
                url:ajax_url,
                dataType:'json',
                success:function(res){
                  if(res.status == 1){
                    toastr.success(res.meassge);
                  }else{
                    toastr.error(res.meassge);  
                  }  
               }
            });
    }else{
        toastr.error("Please choose candidate first!");
    }
        
})
    
    
/***************Chat**********************/

  $('#send_emp_chat').click( function(e){
       e.preventDefault();
      var chat_data= jQuery('#chat_employer').serialize();
      var url=jQuery('#theme_url').val();
        jQuery.ajax({
           type:"POST",
           data:chat_data,
           url:url+'/ajax/chat-employer.php',
           success:function(response){
                jQuery('#append_chat').empty();
                jQuery('#append_chat').append(response);
               $('#emp_msg').val("");
           }
        });

  });
    
/******add class to ats(employer)**************/
    
//$(".no-match-dots").on('click', function(){
//    jQuery('.applicant-content').addClass("show-options"); 
//});
});


/******** Generate offer pdf ***********/

function create_doc(candidate_id, offerid){
    var url=jQuery('#theme_url').val();
    jQuery.ajax({
       type:"POST",
       url:url+'/ajax/generate-contract-pdf.php',
       data:{candidate_id:candidate_id,offerid:offerid},
       success:function(response){
//            jQuery('#append_chat').empty();
//            jQuery('#append_chat').append(response);
//            $('#emp_msg').val("");
       }
    });
}

/**********Create Chat room****************/

function create_room(sender_id,reciever_id){
   var url=jQuery('#theme_url').val();
    jQuery('#rec_id').val(reciever_id);
    jQuery.ajax({
       type:"POST",
       data:{sender_id:sender_id,reciever_id:reciever_id},
       url:url+'/ajax/chat-employer.php',
       success:function(response){
            jQuery('#append_chat').empty();
            jQuery('#append_chat').append(response);
           $('#emp_msg').val("");
       }
    });
}

/****************View shortlist candidate list*********************/

function candidate_list(job_id,emp_id){
jQuery('.row_highlighted_'+job_id).addClass('highlight');
 var ajax_url= jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        url:ajax_url,
        data:{job_id:job_id,emp_id:emp_id,action:'shortlist_candidates'},
        dataType:'json',
        success:function(res){
            jQuery('#show_cand').empty();
            jQuery('#show_cand').append(res.html);
    }  
});
}

/*******************Candidate Ats***************************/

function track_candidate(job_id,emp_id){
jQuery('.row_high_'+job_id).addClass('highlight');
 var ajax_url= jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        url:ajax_url,
        data:{job_id:job_id,emp_id:emp_id,action:'atstrack_candidates'},
        dataType:'json',
        success:function(res){
            jQuery('#show_cand').empty();
            jQuery('#show_cand').append(res.html);
            jQuery('#ats_append').empty();
            jQuery('#ats_append').append(res.ats_html);
            jQuery('#append_job_name').empty();
            jQuery('#append_job_name').append(res.ats_job_name);
    }  
});
}

/************Post a job ******************/

function post_a_job(event){
    var formdata = jQuery('#post_job').serializeArray();
    formdata.push({ name: "post_status", value:event});
    var ajax_url= jQuery('#admin-ajax').val();

    jQuery.ajax({
        type:"POST",
        url:ajax_url,
        data:formdata,
        dataType:'json',
        success:function(res){  
          if(res.status == 1){
              toastr.success(res.message);
              window.location.href = res.url;
          }else{
           toastr.error(res.message);
//            window.location.href = res.url;
          }
        }
    });
}

/****************Make offer*******************/

jQuery('.submit-offer').click(function(e){
   e.preventDefault();
    var offer_status = jQuery(this).attr('data-status');
    var formdata = jQuery('#make_offer').serializeArray();
    formdata.push({ name: "status", value:offer_status});
    var ajax_url= jQuery('#admin-ajax').val();
    jQuery.ajax({
            type:"POST",
            url:ajax_url,
            data:formdata,
            dataType:'json',
            success:function(res){  
              if(res.status == 1){
                  toastr.success(res.message);
    //              location.reload();
              }else{
               toastr.error(res.message);  
              }
            }
    });
});



/****************Hold job*******************/

function hold_job(emp_id,job_id){
var ajax_url= jQuery('#admin-ajax').val();
jQuery.ajax({
        type:"POST",
        url:ajax_url,
        data:{emp_id:emp_id,job_id:job_id,action:'hold_job'},
        dataType:'json',
        success:function(res){  
          if(res.status == 1){
              toastr.success(res.message);
              location.reload();
          }else{
           toastr.error(res.message);  
          }
        }
});
}

/**************Delete Job***********************/

function delete_job(emp_id,job_id){
var ajax_url= jQuery('#admin-ajax').val();
jQuery.ajax({
        type:"POST",
        url:ajax_url,
        data:{emp_id:emp_id,job_id:job_id,action:'delete_job'},
        dataType:'json',
        success:function(res){  
          if(res.status == 1){
              toastr.success(res.message);
              location.reload();
          }else{
           toastr.error(res.message);  
          }
        }
});
}



function empset_frm_cancel(){
  $('#employee_chn_setting').trigger('reset');    
}
var loadFile = function(event) {
    var output = document.getElementById('imagePreview');
    output.src = URL.createObjectURL(event.target.files[0]);
    var img = output.src;
    $('#imagePreview').css('background-image', 'url(' + img + ')');
     console.log("kkkkk");
};

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
    if(jQuery(".tab").length){
          var x = document.getElementsByClassName("tab");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
            jQuery('#nextBtn').hide();
            jQuery('#submit-btn').show();
              console.log("jjjjj");
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
               console.log("Next");
          }
    }
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  
// if (currentTab >= x.length) {
//    // ... the form gets submitted:
//    jQuery('#nextBtn').hide();
//    jQuery('#submit-btn').show();
//  }
    
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  z = x[currentTab].getElementsByTagName("select");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
     
    var inputType = jQuery(y[i]).attr('type');
    var inputname = jQuery(y[i]).attr('name');
//      alert(inputname);
//     console.log(inputname);  
    if(inputType != 'file'){
        // If a field is empty...
        if (y[i].value == "") {
          jQuery(y[i]).removeClass('invalid');
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
    }
      /******For removing invalid from technical skills*******/
      
      if(inputname == 'skill[]' && y[i].value == ""){
        jQuery(y[i]).removeClass('invalid');
          // add an "invalid" class to the field:
          
          valid = true; 
      }
      
      /******For removing invalid from experience*******/
      
//      if(inputname == 'experience[]' && y[i].value == ""){
//          console.log(y[i]);
//        jQuery(y[i]).removeClass('invalid');
//          // add an "invalid" class to the field:
//          
//          valid = true; 
//      }
////      
  }
    
  // check for all option tags
//  for (i = 0; i < z.length; i++) {
//    var conceptName = $(z[i]).find(":selected").val();
//
//    // If a field is empty...
//    if (conceptName == "") {
//      jQuery(z[i]).removeClass('invalid');
//      // add an "invalid" class to the field:
//      z[i].className += " invalid";
//      // and set the current valid status to false
//      valid = false;
//    }
//  }
  // If the valid status is true, mark the step as finished and valid:
  if (!valid) {
//    toastr.error("Please fill required fields");
//      setTimeout(function(){
//          jQuery('.bg-white-grey').animate({
//             scrollTop: (jQuery('.invalid').offset().top - 300)
//          }, 2000);
//      },1000);
  }
  return valid; // return the valid status
}

/**********Add experience******************/

function add_experience_level(){
    var count = Math.floor((Math.random() * 100) + 1);
    var expclass_count = jQuery('.exp_rating').length;
    var exp_input = jQuery('.experience_input').html();
    var exp_rating = jQuery('.experience_rating').html();
    
    var add_exp = '<div class="add_exp row"><div class="col-md-6">'+exp_input+'</div><div class="col-md-6">'+exp_rating+'</div><button class="btn btn-red btn-pluss" type="button" onclick="remove_exp('+count+');">-</button></div>';
      
    if(expclass_count < 20){
//       jQuery('.year_exp').append(add_exp); 
       jQuery(".xyz").append(add_exp);
    }else{
        toastr.error("Maximum limit Reached!");
    }
    
}


function remove_exp(count){
 jQuery('.append_'+count).remove();
}

/***********Add Skills as per client***************/

function add_more_technical_skills(){
    var count = Math.floor((Math.random() * 100) + 1);
    var skl_input = jQuery('.tech_skil_input').html();
    var skl_level = jQuery('.tech_skl_level').html();
    var class_count = jQuery('.job_skill').length;
    
    var add_skl = '<div class="add-skills-content append_'+count+' edit-skill" id="ad_cont"><div class="row"><div class="col-md-6"><div class="form-group">'+skl_input+'</div></div><div class="col-md-6">'+skl_level+'</div><button class="btn btn-red btn-pluss" type="button" onclick="remove_skl('+count+');">-</button></div></div>';
    
    if(class_count < 20){
        jQuery('.add_skil').append(add_skl);
        jQuery('#add_skil').val('');  
    }else{
        toastr.error("Maximum limit Reached");
    }
      
    
}

function remove_skl(count){
 jQuery('.append_'+count).remove();
}

/**********Reject Candidate from ats****************/

function ats_reject(row_id,rec_id){
    jQuery('#atsRejectCandidate').modal('show');
    jQuery("#scand").val(row_id);
    jQuery("#scand").attr('data-rc-id',rec_id);
    
}
/***********Book Next stage interview from ats*******************/

function ats_book_interview(row_id,rec_id){
    jQuery('#atsReq_interview').modal('show');
    jQuery('input[name="row_id"]').val(row_id);
    jQuery('input[name="recruiter_id"]').val(rec_id);
    
}

/***********Give Feedback*******************/

function give_feedback(row_id,rec_id){
    jQuery('#ats_give_feedback').modal('show');
    jQuery("#scand_feedback").val(row_id);
    jQuery("#scand_feedback").attr('data-rc-id',rec_id);
    
}


/********Add soft skills and level(as per client)**************/

function add_soft_skills_level(skill_count){

var select_count = jQuery('.skill_count').length;
if(select_count < skill_count){
    var count = Math.floor((Math.random() * 100) + 1);
    var soft_skills = jQuery('#soft_skills_name').html();
    var soft_skills_levels = jQuery('#soft_skills_level').html();

    var add_soft_skl = '<div class="add-skills-content append_'+count+' edit-skill" id="ad_cont"><div class="row"><div class="col-md-6">'+soft_skills+'</div><div class="col-md-6">'+soft_skills_levels+'</div><button class="btn btn-red btn-pluss" type="button" onclick="remove_soft_skills_level('+count+');">-</button></div></div>';

    jQuery('.add_soft_skil').append(add_soft_skl);
    }else{
        toastr.error("Maximum limit reached!");
    }  
}

function remove_soft_skills_level(count){
  jQuery('.append_'+count).remove();  
}

/*************Give Feedback***********************/

jQuery('#give_feedback').submit(function(e){
    e.preventDefault();
    var candidates = [];
    if(jQuery("#scand_feedback").length){
        var rds = $("#scand_feedback").val();
        candidates.push(rds);
        var rec_ids = $('#scand_feedback').attr('data-rc-id');
    }
  
    var candidate_ids = candidates.toString();
    
    var formdata = jQuery('#give_feedback').serializeArray();
    formdata.push({ name: "row_id", value:candidate_ids});
    formdata.push({ name: "recruiter_id", value:rec_ids});
    var ajax_url= jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        url:ajax_url,
        data:formdata,
        dataType:'json',
        success:function(res){
          if(res.status == 1){
              toastr.success(res.message);
              location.reload();
          }else{
           toastr.success(res.message);   
          }
        }
    });
})

/*************ats nofeedbacks*****************/
function ats_nofeeds(){
    toastr.error("Please give suitable feedback for last interview first!!");
}

/*****************Sent contract direct to candidate*********************/

function contract_to_candidate(cand_id,emp_id){
    var ajax_url = jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        url:ajax_url,
        data:{cand_id:cand_id,emp_id:emp_id,action:'direct_contract'},
        dataType:'json',
        success:function(res){
          if(res.status == 1){
              toastr.success(res.message);
              location.reload();
          }else{
            toastr.error(res.message);  
          }
        }
    });
    
}