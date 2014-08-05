jQuery.noConflict();
if(typeof(JM)=='undefined') var JM = jQuery;
 
JM(document).ready(function(){
	/*Login*/
	JM('.jm_login form#login-form').submit(function(){
     /*        $('#jmlogin-loading').show();
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
		});*/
        var token = JM('.jm-submit input:last').attr("name");
    	var value_token = encodeURIComponent(JM('.jm-submit input:last').val()); 
        var datasubmit= "jmtask=login&username="+encodeURIComponent(JM("#jm-input-username").val())
    	+"&passwd=" + encodeURIComponent(JM("#jm-input-password").val())
    	+ "&"+token+"="+value_token
    	+"&return="+ encodeURIComponent(JM("#jm-return").val());
    	
    	if(JM("#jm-checkbox-remember").is(":checked")){
    		datasubmit += '&remember=yes';
    	}
    	
    	JM.ajax({
    	   type: "POST",
    	   beforeSend:function(){
    		   JM('#jmlogin-loading').show();  
    	   },
    	   url: jmOpt.JM_AJAX,
    	   data: datasubmit,
    	   success: function (html, textstatus, xhrReq){
    		  if(html == "1" || html == 1){
    			   window.location.href=jmOpt.JM_LOGIN_RETURN;
    		   }else{
    			   if(html.indexOf('</head>')==-1){		   
    				   showLoginError(Joomla.JText._('E_LOGIN_AUTHENTICATE'));
    				}
    				else
    				{
    					if(html.indexOf('btl-panel-profile')==-1){ 
    						showLoginError('Another plugin has redirected the page on login, Please check your plugins system');
    					}
    					else
    					{
    						window.location.href=jmOpt.JM_LOGIN_RETURN;
    					}
    				}
    		   }
    	   },
    	   error: function (XMLHttpRequest, textStatus, errorThrown) {
    			alert(textStatus + ': Ajax request failed!');
    	   }
    	});
		return false;
	});
       
	/*Register*/
	JM('.jm_login form#form-register').submit(function(){   
                //$('#jmlogin-loading').show();
	/*	var $data = {};
		JM(this).find('input').each(function(index){
			$data[JM(this).attr('name')] = JM(this).val();
		})
		JM.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_register.php',$data,function(data){
                    //$('#jmlogin-loading').hide();
				if(data.status == 'failed'){
					JM('.alert_register').text(data.error).show(0);
					Recaptcha.reload();
					setTimeout(function(){JM("#jmmodal").JmModal('updateScroll');},1000); 
				}else{
                                        var html='<div class="alert_register" >'+data.message+'</div>';
                                        JM('#jmregister').html(html);
                                       setTimeout(function(){JM("#jmmodal").JmModal('hide');},5000); 
					
				}
		});
		return false;
	})*/
        var token = JM('.jm-submit input:last').attr("name");
    	var value_token = encodeURIComponent(JM('.jm-submit input:last').val()); 
    	var datasubmit= "jmtask=register&name="+encodeURIComponent(JM("#jm-input-name").val())
    			+"&username="+encodeURIComponent(JM("#jm-input-user-name").val())
    			+"&passwd1=" + encodeURIComponent(JM("#jm-input-pass").val())
    			+"&passwd2=" + encodeURIComponent(JM("#jm-input-confirm-pass").val())
    			+"&email1=" + encodeURIComponent(JM("#jm-input-email").val())
    			+"&email2=" + encodeURIComponent(JM("#jm-input-confirm-email").val())					
    			+ "&"+token+"="+value_token;
                //console.log(datasubmit);		
    /*	if(jmOpt.RECAPTCHA =="recaptcha"){
    		datasubmit  += "&recaptcha=yes&recaptcha_response_field="+ encodeURIComponent(JM("#recaptcha_response_field").val())
    					+"&recaptcha_challenge_field="+encodeURIComponent(JM("#recaptcha_challenge_field").val());
    	}else if(jmOpt.RECAPTCHA =="2"){
    		datasubmit  += "&recaptcha=yes&btl_captcha="+ encodeURIComponent(JM("#btl-captcha").val());
    	}*/
    	JM.ajax({
    		   type: "POST",
    		   beforeSend:function(){
    			   //$('#jmlogin-loading').show();			   
    		   },
    		   url: jmOpt.JM_AJAX,
    		   data: datasubmit,
    		   success: function(html){		   
    			   //if html contain "Registration failed" is register fail
    			  //$('#jmlogin-loading').hide();	
    			  if(html.indexOf('$error$')!= -1){
    				  //JM("#btl-registration-error").html(html.replace('$error$',''));  
    				  //JM("#btl-registration-error").show();
    				 /* if(jmOpt.RECAPTCHA =="recaptcha"){
    					  Recaptcha.reload();
    				  }else if(jmOpt.RECAPTCHA =="2"){
    					JM.ajax({
    						type: "post",
    						url: jmOpt.JM_AJAX,
    						data: 'jmtask=reload_captcha',
    						success: function(html){
    							JM('#recaptcha img').attr('src', html);
    						}
    					});
    				  }*/
    				  
    			   }else{				   
    				   JM("#form-register").children("div").hide();
    				   JM("#jm-success").html(html);	
    				   JM("#jm-success").show();	
    				   setTimeout(function() {window.location.reload();},6000);
    			   }
    		   },
    		   error: function (XMLHttpRequest, textStatus, errorThrown) {
    				alert(textStatus + ': Ajax request failed');
    		   }
    		});
    		return false;
    });
    })