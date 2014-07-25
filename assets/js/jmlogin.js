jQuery(document).ready(function($){
	/*Login*/

	$('.jm_login form#login-form').submit(function(){
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
	$('.jm_login form#form-register').submit(function(){
                //$('#jmlogin-loading').show();
		var $data = {};
		$(this).find('input').each(function(index){
			$data[$(this).attr('name')] = $(this).val();
		})
		$.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_register.php',$data,function(data){
                    //$('#jmlogin-loading').hide();
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
    })