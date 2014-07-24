$jm=jQuery.noConflict();
$jm(document).ready(function(){
	$jm('#login-form').submit(function(e){
		e.preventDefault();
		$jm('.alert-login').addClass('loading').text('Loading ...').slideDown();
		var $data = $jm('#login-form').serialize();
		$jm.getJSON(jm_base_url +  '/modules/mod_jmlogin/ajax_login.php?'+$data).done(function(data){
			if(data.status == 'ok'){
				window.location = jm_after_login_url;
			}else{
				$jm('.alert-login').removeClass('loading').text('<?php echo $error_invalid; ?>');
				return false;
			}
		})
		return false;
	})
	
	$jm('.alert_register').hide();
	$jm('#form-register').submit(function(e){
			e.preventDefault();
			var $data = $jm('#form-register').serialize();
			$jm('.alert_register').text('Loading ...').css({display:'block'});
			$jm.getJSON(jm_base_url +  '/modules/mod_jmlogin/ajax_register.php?'+$data).done(function(data){
				$jm("#jmmodal").JmModal('updateScroll');
				if(data.status=='ok'){
					$jm('#form-register').hide();
					$jm('.alert_register').text(data.message).css({display:'block',color:'green'});
				}else{
					$jm('.alert_register').text(data.error).css({display:'block'});
					$jm("#jmmodal").JmModal('updateScroll');
					setTimeout(function(){Recaptcha.reload();}, 200);
				}
			}).fail(function(){alert('fail')});
			return false;
	});
	
	$jm('#form-repassword').submit(function(e){
		e.preventDefault();
		var $data = $jm('#form-repassword').serialize();
		$jm.getJSON(jm_base_url +  '/modules/mod_jmlogin/ajax_regain_password.php?'+$data).done(function(data){
			if(data.status == 'ok'){
				alert(data.message);
			}else{
				alert(data.error);
			}
		});
		return false;
	})
		
	$jm('.jmlogin_dropdown_after').hover(function(){
		$jm('.jmlogin_logout_btn_wrap').show(); 
	}, function(){
		$jm('.jmlogin_logout_btn_wrap').hide();
	})
});