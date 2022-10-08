jQuery(document).ready(function(){
    

jQuery('#sub_cand').click(function(){
    jQuery('#submit_my_form'). click();
});
    
//jQuery('#ats_profile').click(function(){
//   jQuery('#view_ats_profile').toggle();
//   jQuery('#ats_employer').toggle();
//});
    
var uploadField = document.getElementsByClassName("files");
jQuery('.files').change(function(){
    if(this.files[0].size > 5242880){
       toastr.error("Please upload upto 5MB");
       this.value = "";
        jQuery('.file-upload-filename').text("");
    };
});


/*************************Edit Settings(Recruiter)*****************************/
    
jQuery('#recruiter_settings').validate({
    rules:{
        name:{
            required:true, 
        },
        surname:{
            required:true, 
        },
        emp_status:{
            required:true, 
        },
        linkedin_profile:{
            required:true,
        },                            
        city:{
            required:true,     
        },
        email:{
            required:true,
            email:true,
        }
    },submitHandler:function(data){
        var formr = jQuery('#recruiter_settings')[0];
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
    
/***************************Change password(Recruiter)*************************************/
    
    jQuery('#change_rec_password').validate({
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
        var pass_data = jQuery('#change_rec_password').serialize();
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
 
/**********************Submit Candidate****************************/
    
jQuery('#submit_candidate').validate({
    rules:{
        name:{
            required:true, 
        },
        lives:{
            required:true, 
        },
        emp_status:{
            required:true, 
        },
        availablity:{
            required:true,
        },                            
        current_salary:{
            required:true,     
        },
        current_position:{
            required:true,
        },
        current_employer:{
            required:true,
        },
        salary_expectation:{
            required:true,
        },
        working_perference:{
            required:true,
        },
        qualification:{
            required:true,
        },
        university:{
            required:true,
        },
        additional_qualification:{
            required:true,
        },
        email:{
            required:true,
        },
        skill_name:{
            required:true,
        },
        skill_count:{
            required:true,
        },
        cv:{
          required:true,  
        }
    },submitHandler:function(data){
        
//        var themeURL = jQuery("#theme_url").val();
//        var formr = jQuery('#submit_candidate')[0];
//        var formData = new FormData(formr);
//        
//        jQuery.ajax({
//            type:"POST",
//            url:themeURL+'/ajax/user-to-docusign.php',
//            data:formData,
//            dataType:'json',
//            processData: false,
//            contentType: false,
//            success:function(res){  
//              if(res.status == 1){
//                  toastr.success(res.message);
//                  location.reload();
//              }else{
//                toastr.error(res.message);  
//              }
//            }
//        });
        
        var formr = jQuery('#submit_candidate')[0];
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
    
  $('#send_rec_chat').click(function(e) {
    e.preventDefault();
      var chat_data= jQuery('#recruiter_chat').serialize();
      var url= jQuery('#theme_url').val();
        jQuery.ajax({
           type:"POST",
           data:chat_data,
           url:url+'/ajax/chat-recruiter.php',
           success:function(response){
                jQuery('#append_chat').empty();
                jQuery('#append_chat').append(response);
               $('#rec_chat_input').val("");
              }
        });
  });
    
    jQuery("#create_job_alt").click(function(e){
        e.preventDefault();
        var url= jQuery('#admin-ajax').val();
        var id = jQuery(this).attr('data-userid');
        jQuery.ajax({
           type:"POST",
           url:url,
           data:{id:id,action:'create_job_alert'},
           dataType:'json',
           success:function(response){
               if(response.status == 1){
                   toastr.success(response.message);
                   location.reload();
               }else{
                   toastr.error(response.message);
               }
           }
        });
    });
    
    jQuery("#stop_job_alt").click(function(e){
        e.preventDefault();
        var url= jQuery('#admin-ajax').val();
        var id = jQuery(this).attr('data-rowid');
        jQuery.ajax({
           type:"POST",
           url:url,
           data:{id:id,action:'stop_job_alert'},
           dataType:'json',
           success:function(response){
               if(response.status == 1){
                   toastr.success(response.message);
                   location.reload();
               }else{
                   toastr.error(response.message);
               }
           }
        });
    });

});


/************Create Chat room*******************/

function create_room_recruiter(sender_id,reciever_id){
    var url= jQuery('#theme_url').val();
    jQuery("#recv_id").val(reciever_id);
    jQuery.ajax({
       type:"POST",
       data:{sender_id:sender_id,reciever_id:reciever_id},
       url:url+'/ajax/chat-recruiter.php',
       success:function(response){
            jQuery('#append_chat').empty();
            jQuery('#append_chat').append(response);
           $('#rec_chat_input').val("");
          }
    });
}

/****************Save Candidate Application************************/

function save_application(){
 var formdata = jQuery('#submit_candidate')[0];
 var formd = new FormData(formdata);
 formd.append("action","save_candidate_application");
 var ajax_url = jQuery('#admin-ajax').val();
    $.ajax({
        type: "POST",
        url: ajax_url,
        data:formd,
        dataType:'json',
        processData: false,
        contentType: false,
        success:function(res){
            if(res.status == 1){
                toastr.success(res.message);
            }else{
               toastr.error(res.message); 
            }
        }
    });
}

/**************Reset Profile****************************/

function cancel_rec_set(){
  $('#recruiter_settings').trigger('reset');  
}


//
//function full_calender(){
//    var events = [
//    {'Date': new Date(2016, 6, 7), 'Title': 'Doctor appointment at 3:25pm.'},
//    {'Date': new Date(2016, 6, 18), 'Title': 'New Garfield movie comes out!', 'Link': 'https://garfield.com'},
//    {'Date': new Date(2016, 6, 27), 'Title': '25 year anniversary', 'Link': 'https://www.google.com.au/#q=anniversary+gifts'},
//];
//var settings = {
//    Color: '',
//    LinkColor: '',
//    NavShow: true,
//    NavVertical: false,
//    NavLocation: '',
//    DateTimeShow: true,
//    DateTimeFormat: 'mmm, yyyy',
//    DatetimeLocation: '',
//    EventClick: '',
//    EventTargetWholeDay: false,
//    DisabledDays: [],
//};
//    
//var element = document.getElementById('full_calender');
//full_calender(element, events, settings);
//}
/**********Image Preview************/

var loadFile = function(event) {
    var output = document.getElementById('imagePreview');
    output.src = URL.createObjectURL(event.target.files[0]);
    var img = output.src;
    $('#imagePreview').css('background-image', 'url(' + img + ')');
};


/********Save for later****************/

function save_later(job_id,rec_id){
   var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({ 
            type: "POST",
            url: ajax_url,
            data:{job_id:job_id,rec_id:rec_id,action:'save_later'},
            dataType:'json',
            success: function(res){
                if(res.status == 1){
                toastr.success(res.message);
                  window.location.href = res.url;
                }else{
                toastr.error(res.message);
             }
          }
      });
}

/**********Live job(Commit to vacancy)****************/

function live_job(job_id,rec_id){
   var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({ 
            type: "POST",
            url: ajax_url,
            data:{job_id:job_id,rec_id:rec_id,action:'live_job'},
            dataType:'json',
            success: function(res){
                if(res.status == 1){
                toastr.success(res.message);
                   location.reload();
                }else{
                toastr.error(res.message);
             }
          }
      });
}

/**********************Move to active*****************************/

function move_to_active(row_id){
   var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({ 
            type: "POST",
            url: ajax_url,
            data:{row_id:row_id,action:'move_to_active'},
            dataType:'json',
            success: function(res){
                if(res.status == 1){
                toastr.success(res.message);
                    location.reload();
                }else{
                toastr.error(res.message);
             }
          }
      });
}

/*******Remove job from saved jobs***************/

function remove_saved_job(row_id){
   var ajax_url= jQuery('#admin-ajax').val();
        jQuery.ajax({ 
            type: "POST",
            url: ajax_url,
            data:{row_id:row_id,action:'remove_saved_job'},
            dataType:'json',
            success: function(res){
                if(res.status == 1){
                toastr.success(res.message);
                    location.reload();
                }else{
                toastr.error(res.message);
             }
          }
      });
}

/*************Recruiter Business Profile***********************/

jQuery("#recruiter_profile").submit(function(e){
    e.preventDefault();

        var formr = jQuery('#recruiter_profile')[0];
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

/*************Update candidate profile******************/
    
jQuery('#update_candidate_profile').submit(function(e){
       e.preventDefault(); 
var form = jQuery('#update_candidate_profile')[0];
var formData = new FormData(form);
var ajax_url = jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        data:formData,
        url:ajax_url,
        dataType:'json',
        processData: false,
        contentType: false,
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

/*************Job Search**********************/

jQuery('#job_search').submit(function(e){
    e.preventDefault();
var formdata = jQuery('#job_search').serialize();
var theme_url = jQuery('#theme_url').val();
    $.ajax({
    type:"POST",
    data:formdata,
    url:theme_url+'/ajax/job-search-criteria.php',
    success:function(res){
      window.location.reload();
    }
});
});

/************Reject Offer(By Candidate)********************/

jQuery('#reject_offer').submit(function(e){
       e.preventDefault();
var formdata = jQuery('#reject_offer').serialize();
var ajax_url =  jQuery('#admin-ajax').val();
    $.ajax({
    type:"POST",
    url:ajax_url,
    data:formdata,
    dataType:'json',
    success:function(res){
      if(res.status == 1){
        toastr.success(res.message);
//          location.reload();
      }else{
        toastr.error(res.message);  
      }
    }
});
});

/***************Clear Filter***********************/

function clear_filter(){
  var theme_url = jQuery('#theme_url').val();
    $.ajax({
    type:"POST",
    url:theme_url+'/ajax/clear-filter.php',
    success:function(res){
      window.location.reload();
    }
});  
}

/***************Save search criteria**********************/


function save_search_criteria(search_value,rec_id){
  var ajax_url = jQuery('#admin-ajax').val();
    $.ajax({
    type:"POST",
    url:ajax_url,
    data:{search_value:search_value,rec_id:rec_id,action:'save_search_criteria'},
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

/*******************Sort Jobs************************************/

function sort_jobs(){
var order_value = jQuery('#order').val();
var searched_ids = jQuery('#searched_ids').val();
var ajax_url = jQuery('#admin-ajax').val();
    $.ajax({
    type:"POST",
    url:ajax_url,
    data:{order_value:order_value,searched_ids:searched_ids,action:'sort_jobs'},
    dataType:'json',
    success:function(res){
        jQuery('#show_jobs').empty();
        jQuery('#show_jobs').append(res.html);       
    }
});  
}

/******************Ats Candidates********************/

function recruiter_track_candidate(job_id,rec_id){
 var ajax_url= jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        url:ajax_url,
        data:{job_id:job_id,rec_id:rec_id,action:'recruiter_atstrack_candidates'},
        dataType:'json',
        success:function(res){
            jQuery('#ats_append').empty();
            jQuery('#ats_append').append(res.ats_html);
            jQuery('#append_job_name').empty();
            jQuery('#append_job_name').append(res.ats_job_name);
    }  
});
}

/*************Send offer to candidate*************/

function share_offer_with_candidate(candidate_id,offer_id,recruiter_id){
  var ajax_url =  jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        url:ajax_url,
        data:{candidate_id:candidate_id,offer_id:offer_id,rec_id:recruiter_id, action:'send_offer_to_candidate'},
        dataType:'json',
        success:function(res){
            if(res.status == 1){
                toastr.success(res.message);
            }else{
              toastr.success(res.message);  
            }
    }  
        
    });
}

/********Accept offer************/

function accept_offer(candidate_id,offer_id){
    var ajax_url =  jQuery('#admin-ajax').val();
    $.ajax({
        type:"POST",
        url:ajax_url,
        data:{candidate_id:candidate_id,offer_id:offer_id,action:'accept_offer'},
        dataType:'json',
        success:function(res){
            if(res.status == 1){
                toastr.success(res.message);
            }else{
              toastr.success(res.message);  
            }
    }  
        
    });  
}

/*****************Recruiter profile(add_expertise)******************************/

function expertise(count){
    var inc = count;
var select_opt_val = jQuery('#add_expertise :selected').val();
    
var html = '<div class="tag" id="tag_'+inc+'"><input type="text" name="expertise[]" value="'+ select_opt_val +'" class="form-control" readonly><a href="javascript:void(0);" class="btn-close" onclick="remove_expertise('+inc+');"></a></div>';

jQuery('#ad_cont').append(html);
    
inc++; 
    
jQuery('#add_expertise').attr('onchange','expertise('+inc+')')
}

function remove_expertise(id){
    jQuery('#tag_'+id).remove();
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

/*************Add Expertise area to recruiter profile*************/

$('#add_skil').keypress(function (e) {
 var key = e.which;
 if(key == 13){
    var count = Math.floor((Math.random() * 100) + 1);
    var skl_value = jQuery('#add_skil').val();
    var add_skl = '<div class="add-skills-content chooses11 append_'+count+' " id="ad_cont"><div class="col-5"><h5><input type="text" name="skill[]" value="'+skl_value+'" class="form-control"></h5></div><div class="col-5"></div><div class="col-2"><button class="btn btn-red btn-pluss" type="button" onclick="remove_skl('+count+');">-</button></div></div>';
      
    jQuery('.add_skil').append(add_skl);
    
  }
});

/**************Add soft skills to candidate**********************/

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

