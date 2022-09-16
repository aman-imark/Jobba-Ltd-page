// For Developer Use
jQuery(document).ready(function(){
    
jQuery('.wpcf7-form').addClass('Login-live');
    
    /******************Login******************/
    
    jQuery("#login").submit(function(e){
    e.preventDefault();

    var ajaxurl = jQuery("#admin-ajax").val();
    var formdata = jQuery("#login").serialize();

    jQuery.ajax({
        type:'POST',
        url:ajaxurl,
        data:formdata,
        dataType:'json',
        success:function(res){
            if(res.status ==1){
                toastr.success(res.message);
                window.location.href = res.url;
            }else{  
                toastr.error(res.message);
            }
            },
        });
    });

    /******************Signup Employer******************/
    
jQuery('#signup').validate({
    rules:{
    first_name:{
    required:true,
    },
    surname:{
    required:true,
    },
    job_title:{
    required:true,
    },
    email:{
    required:true,
    email:true,
    },
    business_name:{
    required:true,
    },
    office_location:{
    required:true,
    },
    password:{
    required:true,
    minlength:8,
    },
    c_password:{
    required:true,
    equalTo:'#password',
    },

    },submitHandler: function(data){

    var data = jQuery("#signup").serialize();
    var ajax_url = jQuery('#admin-ajax').val();

    jQuery.ajax({
        type:"POST",
        data:data,
        url:ajax_url,
        dataType:'json',
        success:function(res){
        if(res.status ==1){
        toastr.success(res.message);
        }else{
        toastr.error(res.message);
        }     
        }
        });
    }
});

    /*******************Signup Recruiter***********************************/
    
jQuery('#recruiter_signup').validate({
    rules:{
    name:{
        required:true,
    },
    surname:{
        required:true,
    },
    empolyment_status:{
        required:true,
    },
    email:{
        required:true,
        email:true,
    },
    linkedin_profile:{
        required:true,
    },
    city:{
        required:true,
    },
    password:{
        required:true,
        minlength:8,
    },
    c_password:{
        required:true,
        equalTo:'#password',
    },

    },submitHandler: function(data){

    var data = jQuery("#recruiter_signup").serialize();
    var ajax_url = jQuery('#admin-ajax').val();

    jQuery.ajax({
        type:"POST",
        data:data,
        url:ajax_url,
        dataType:'json',
        success:function(res){
            if(res.status ==1){
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }     
        }
        });
    }
});



/*************************Forgot password(Login)*******************************/  

jQuery('#forgot_password').validate({
    rules:{
        email:{
            required:true,
            email:true,
        }
    },submitHandler: function(form){
        var forgot_data = jQuery('#forgot_password').serialize();
        var ajax_url= jQuery('#admin-ajax').val();
            jQuery.ajax({ 
            type: "POST",
            url: ajax_url,
            data:forgot_data,
            dataType:'json',
            success: function(res){
                if(res.status == 1){
                toastr.success(res.message);
                }else{
                toastr.error(res.message);  
                }
                }
            });
        } 
    });
});

function check_role(){
toastr.error("Role is missing! Redirecting...");
var url = jQuery('#redirection').attr('data-url');
setTimeout(function(){
window.location.href = url;    
},1000);
}





