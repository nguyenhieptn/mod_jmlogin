jQuery(document).ready(function($){
	/*Login*/

	$('form#jm-login-form').submit(function(){
                $('#jmlogin-loading').show();
		var $data = {};
		$(this).find('input').each(function(index){
			$data[$(this).attr('name')] = $(this).val();
		})
		$.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_login.php',$data,function(data){
                    $('#jmlogin-loading').hide();
                    if(data.status == 'failed'){
                        $('.alert-login').text(data.error).show(0);
                        setTimeout(function(){$("#jmmodal").JmModal('updateScroll');},1000);
                    }else{
                        $("#jmmodal").JmModal('hide');
                        if(data.redirect!=''){
                                window.location = data.redirect;
                        }else{
                                window.location.reload();
                        }
                    }
		});
		return false;
	})
        
	/*Register*/
	$('form#jm-form-register').submit(function(){
                $('#jmlogin-loading').show();
		var $data = {};
		$(this).find('input').each(function(index){
			$data[$(this).attr('name')] = $(this).val();
		})
		$.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_register.php',$data,function(data){
                    $('#jmlogin-loading').hide();
				if(data.status == 'failed'){
					$('.alert_register').text(data.error).show(0);
					Recaptcha.reload();
					setTimeout(function(){$("#jmmodal").JmModal('updateScroll');},1000); 
				}else{
                                        var html='<div class="alert_register" >'+data.message+'</div>';
                                        $('#jmregister').html(html);
                                       setTimeout(function(){$("#jmmodal").JmModal('hide');},5000); 
					
				}
		});
		return false;
	})
        /****** Check Username Register ******/
        $('#register_username').change(function(){
            var user=$(this).val();
            checkUsername(user);
            
        });
        
        /****** Check Email Register ******/
        $('#register_email').change(function(){
            var email=$(this).val();
            checkEmail(email)
        })
        
        /**** Check Name *****/
        $('#register_name').change(function(){
            checkName();
        });
        /**** Check Pass *****/
        $('#register_pass').change(function(){
            checkPass();
        });
        
        /**** Check Verify password *****/
        $('#register_pass_verify').change(function(){
            checkVerifyPass();
        });
        
        /**** Check Verify email *****/
        $('#register_email_verify').change(function(){
            checkVerifyEmail();
        });
        
        
	/*Repassword*/
	$('form#jm-form-repassword').submit(function(){
		var $data = {};
		$(this).find('input').each(function(index){
			$data[$(this).attr('name')] = $(this).val();
		})
		$.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_repassword.php',$data,function(data){
				if(data.status == 'failed'){
					$('.alert-repassword').text(data.error).show(0);
					setTimeout(function(){$("#jmmodal").JmModal('updateScroll');},1000);
				}else{
					$("#jmmodal").JmModal('hide');
				}
		});
		return false;
	})
        
        $('#re_inputEmail').change(function(){
            var obj=jQuery(this);
            repassword(obj,'email');
        })
        $('#re_uname').change(function(){
            var obj=jQuery(this);
            repassword(obj,'username');
        })
	$('input[name="selecttype"]').change(function(){
		$('.typeselect').hide();
		$('#'+$(this).val()+"_select").show();
	})
});


function checkUsername(user){
    //alert(user)
    var $data={};
    $data['type']='username';
    $data['info']=user;
    jQuery.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_validate.php',$data,function(data){
        if(data.status=='failed') {
            var html='<div class="alert_register register_username">'+data.error+'</div>';
            jQuery('.register_username').remove();
            jQuery('#register_username').before(html);
            jQuery('#register_username').focus();
            return false;
        }else{
            jQuery('.register_username').remove();
        }
    })
}

function checkEmail(email){
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if(!emailReg.test(email)){
        var html='<div class="alert_register register_email">You must enter Email accurate</div>';
        jQuery('.register_email').remove();
        jQuery('#register_email').before(html);
        jQuery('#register_email').focus();
        return false;
    }else{
        jQuery('.register_email').remove();
        var $data={};
            $data['type']='email';
            $data['info']=email;
             jQuery.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_validate.php',$data,function(data){
            if(data.status=='failed') {
                var html='<div class="alert_register register_email">'+data.error+'</div>';
                jQuery('.register_name').remove();
                jQuery('#register_email').before(html);
                jQuery('#register_email').focus();
                return false;
            }else{
               jQuery('.register_name').remove();
            }
        })
    }
}

function checkName(){
    var name=jQuery('#register_name').val().length;
    if(name < 5 ){
        var html='<div class="alert_register register_name">Name must be at least 5 characters long</div>';
        jQuery('.register_name').remove();
        jQuery('#register_name').before(html);
        jQuery('#register_name').focus();
        return false;
    }else{
        jQuery('.register_name').remove();
    }
}

function checkPass(){
    var pass=jQuery('#register_pass').val().length;
    if(pass < 5 ){
        var html='<div class="alert_register register_pass">Password must be at least 5 characters long</div>';
        jQuery('.register_pass').remove();
        jQuery('#register_pass').before(html);
        jQuery('#register_pass').focus();
        return false;
    }else{
        jQuery('.register_pass').remove();
    }
};

function checkVerifyPass(){
    var pass=jQuery('#register_pass').val();
    var verifypass=jQuery('#register_pass_verify').val();
    if(verifypass !==pass){
        var html='<div class="alert_register register_pass_verify">Passwords do not match</div>';
        jQuery('.register_pass_verify').remove();
        jQuery('#register_pass_verify').before(html);
        jQuery('#register_pass_verify').focus();
        return false;
    }else{
        jQuery('.register_pass_verify').remove();
    }
}

function checkVerifyEmail(){
    var email=jQuery('#register_email').val();
    var verifyemail=jQuery('#register_email_verify').val();
    if(verifyemail != email){
        var html='<div class="alert_register register_email_verify">Email do not match</div>';
        jQuery('.register_email_verify').remove();
        jQuery('#register_email_verify').before(html);
        jQuery('#register_email_verify').focus();
        return false;
    }else{
        jQuery('.register_email_verify').remove();
    }
}

function repassword(obj,type){
    var info=jQuery(obj).val();
    var $data={};
    $data['type']=type;
    $data['repassword']=true;
    $data['user']=info;
     jQuery.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_validate.php',$data,function(data){
         if(data.status=='failed') {
                jQuery('.alert-repassword').text(data.error).show(0);
                return false;
            }else{
               jQuery('.alert-repassword').text('').hide(0);
            }
     });
}