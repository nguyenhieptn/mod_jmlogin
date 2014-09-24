jQuery.noConflict();
if(typeof(JM)=='undefined') var JM = jQuery;
if(typeof(btTimeOut)=='undefined') var btTimeOut;
if(typeof(requireRemove)=='undefined') var requireRemove = true;
JM(document).ready(function(){
	/*Login*/
	JM('.jm_login form#jm-login-form').submit(function(){  
        if(JM("#jm-input-username").val()=="") {
    	   	JM("#jm-login-error").html(jmmsg.JM_USERNAME).show(); 
    		return false;
    	}
    	if(JM("#jm-input-password").val()==""){
    		JM("#jm-login-error").html(jmmsg.JM_REQUIRED_PASSWORD).show(); 
    		return false;
    	}
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
    		    JM("#jm-loading-login").show();	   
                JM("#jm-loading-login").css('height',JM('#jmlogin').outerHeight()+'px');
                JM(".jm-modal-dropdown").css({ opacity: 0.5 });
    	   },
    	   url: jmOpt.JM_AJAX,
    	   data: datasubmit,
    	   success: function (html, textstatus, xhrReq){  
    		   if(html == "1" || html == 1){
    			   window.location.href=jmOpt.JM_RETURN;
    		   }else{
    			   if(html.indexOf('</head>')==-1){		   
                       JM("#jm-login-error").html(jmmsg.JM_LOGIN_AUTHENTICATE).show(); 
                       JM("#jm-loading-login").hide();
                       JM(".jm-modal-dropdown").css({ opacity: 1 });
    				}
    				else
    				{
    					if(html.indexOf('jm-panel-loged-modules')==-1){ 
    					   JM("#jm-login-error").html('Another plugin has redirected the page on login, Please check your plugins system').show();
                           JM("#jm-loading-login").hide();
                           JM(".jm-modal-dropdown").css({ opacity: 1 });
    					}
    					else
    					{  
    						window.location.href=jmOpt.JM_RETURN;
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
	JM('.jm_login form#jm-form-register').submit(function(){ 
        if(JM("#jm-input-name").val()==""){
    		JM("#jm-registration-error").html(jmmsg.JM_NAME).show();
    		JM("#jm-input-name").focus();
    		return false;
    	}
    	if(JM("#jm-input-user-name").val()==""){
    		JM("#jm-registration-error").html(jmmsg.JM_USERNAME).show();
    		JM("#jm-input-user-name").focus();
    		return false;
    	}
    	if(JM("#jm-input-pass").val()==""){
    		JM("#jm-registration-error").html(jmmsg.JM_PASSWORD).show();
    		JM("#jm-input-pass").focus();
    		return false;
    	}
    	if(JM("#jm-input-confirm-pass").val()==""){
    		JM("#jm-registration-error").html(jmmsg.JM_CONFIRM_PASSWORD).show();
    		JM("#jm-input-confirm-pass").focus();
    		return false;
    	}
    	if(JM("#jm-input-pass").val()!=JM("#jm-input-confirm-pass").val()){
    		JM("#jm-registration-error").html(jmmsg.JM_PASSWORD_NOT_MATCH).show();
    		JM("#jm-input-confirm-pass").focus().select();
    		//JM("#jm-registration-error").show();
    		return false;
    	}
    	if(JM("#jm-input-email").val()==""){
    		JM("#jm-registration-error").html(jmmsg.JM_EMAIL).show();
    		JM("#jm-input-email").focus();
    		return false;
    	}
    	var emailRegExp = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/;
    	if(!emailRegExp.test(JM("#jm-input-email").val())){		
    		JM("#jm-registration-error").html(jmmsg.JM_EMAIL_INVALID).show();
    		JM("#jm-input-email").focus().select();
            //JM("#jm-registration-error").show();
    		return false;
    	}
    	if(JM("#jm-input-confirm-email").val()==""){
    		JM("#jm-registration-error").html(jmmsg.JM_CONFIRM_EMAIL).show();
    		JM("#jm-input-confirm-email").focus().select();
    		return false;
    	}
    	if(JM("#jm-input-email").val()!=JM("#jm-input-confirm-email").val()){
    		JM("#jm-registration-error").html(jmmsg.JM_EMAIL_NOT_MATCH).show();;
    		JM("#jm-input-confirm-email").focus().select();
    		return false;
    	}
		if(JM('#jm-captcha').length && JM('#jm-captcha').val()==''){
			JM("#jm-registration-error").html(jmmsg.JM_CAPTCHA).show();
			JM('#jm-captcha').focus();
			return false;
		}	
           
        var token = JM('.jm-submit input:last').attr("name");
    	var value_token = encodeURIComponent(JM('.jm-submit input:last').val()); 
    	var datasubmit= "jmtask=register&name="+encodeURIComponent(JM("#jm-input-name").val())
    			+"&username="+encodeURIComponent(JM("#jm-input-user-name").val())
    			+"&passwd1=" + encodeURIComponent(JM("#jm-input-pass").val())
    			+"&passwd2=" + encodeURIComponent(JM("#jm-input-confirm-pass").val())
    			+"&email1=" + encodeURIComponent(JM("#jm-input-email").val())
    			+"&email2=" + encodeURIComponent(JM("#jm-input-confirm-email").val())					
    			+ "&"+token+"="+value_token;	
    	    if(jmOpt.CAPTCHA !=0){
    		  datasubmit  += "&captcha=yes&jm_captcha="+ encodeURIComponent(JM("#jm-captcha").val());
            }
    	JM.ajax({
    		   type: "POST",
    		   beforeSend:function(){
                   JM("#jm-loading-register").show();  
                   JM("#jm-loading-register").css('height',JM('#jmregister').outerHeight()+'px');
                   JM(".jm-modal-dropdown").css({ opacity: 0.5 });	   
    		   },
    		   url: jmOpt.JM_AJAX,
    		   data: datasubmit,
    		   success: function(html){		 
    			  JM("#jm-loading-register").hide();	
    			  if(html.indexOf('error_capt')!= -1){  
    				  JM("#jm-registration-error").html(html.replace('error_capt',''));  
    				  JM("#jm-registration-error").show();
                      JM(".jm-modal-dropdown").css({ opacity: 1 });	  
    				  if(jmOpt.CAPTCHA !=0){
    					JM.ajax({
    						type: "post",
    						url: jmOpt.JM_AJAX,
    						data: 'jmtask=reload_captcha',
    						success: function(html){
    							JM('#jm-captchas img').attr('src', html);
                                JM('#jm-captcha').val('');
                                JM('#jm-captcha').focus();
    						}
    					});
                      }
    			   }else{				   
    				   JM("#jm-form-register").children("div").hide();
    				   JM("#jm-success").html('<i class="fa fa-info-circle"></i> '+html);	
    				   JM("#jm-success").show();
                       JM(".jm-modal-dropdown").css({ opacity: 1 });	 	
    				   setTimeout(function() {window.location.reload();},6000);
    			   }
    		   },
    		   error: function (XMLHttpRequest, textStatus, errorThrown) {
    				alert(textStatus + ': Ajax request failed');
    		   }
    		});
    		return false;
    });
//reload captcha click event
	JM('span#jm-captcha-reload').click(function(){
		JM.ajax({
				type: "post",
				url: jmOpt.JM_AJAX,
				data: 'jmtask=reload_captcha',
				success: function(html){
					JM('#jm-captchas img').attr('src', html);
				}
			});
	});
    
// Login event
	var elements = '#jm-panel-login';
	if (jmOpt.MOUSE_EVENT =='click'){ 
		JM(elements).click(function (event) {  
				showLoginForm();
				event.preventDefault();
		});	
	}else{
		JM(elements).hover(function () {  
            if(JM(this).hasClass('jm-login-link-modal')){
                JM(this).trigger('click');
            }
            showLoginForm();
		},function(){});
	}
// Registration/Loged modules event
	elements = '#jm-panel-registration';
	if (jmOpt.MOUSE_EVENT =='click'){ 
		JM(elements).click(function (event) {
			showRegistrationForm();
			event.preventDefault();
		});	
        JM("#jm-panel-loged-modules").click(function(event){
			showLogedModules();
			event.preventDefault();
		});
	}else{
		JM(elements).hover(function () {
		    if(JM(this).hasClass('jm-login-link-modal')){
                JM(this).trigger('click');
            }
            showRegistrationForm();
		},function(){});
        JM("#jm-panel-loged-modules").hover(function () {
		    showLogedModules();
		},function(){});
	}
    // close dropdown
    JM(document).click(function(event){
		if(requireRemove && event.which == 1) btTimeOut = setTimeout('JM("#tab-content-dropdown > div").slideUp(); JM("#jm-loged-wraper > div").slideUp(); JM("#btn-action span").removeClass("active");',10);
		requireRemove =true;
	});
    JM(".jm_login").click(function(){requireRemove =false;});	
	JM("#btn-action span").click(function(){requireRemove =false;});
    JM("#jm-panel-loged-modules").click(function(){requireRemove =false;});
    
    
});
//show login form
function showLoginForm(){
	JM('#btn-action span').removeClass("active");
	var el = '#jm-panel-login';
		JM("#tab-content-dropdown > div").each(function(){  
			if(this.id=="jmlogin")
			{
				if(JM(this).is(":hidden")){
					JM(el).addClass("active");
					JM(this).slideDown();
					}
				else{
					JM(this).slideUp();
					JM(el).removeClass("active");
				}						
					
			}
			else{
				if(JM(this).is(":visible")){						
					JM(this).slideUp();
					JM('#jm-panel-registration').removeClass("active");
				}
			}
		})
}

// SHOW REGISTRATION FORM
function showRegistrationForm(){
	JM('#btn-action span').removeClass("active");
	var el = '#jm-panel-registration';
	JM("#tab-content-dropdown > div").each(function(){  
		if(this.id=="jmregister")
		{
			if(JM(this).is(":hidden")){
				JM(el).addClass("active");
				JM(this).slideDown();
				}
			else{
				JM(this).slideUp();								
				JM(el).removeClass("active");
				}
		}
		else{
			if(JM(this).is(":visible")){						
				JM(this).slideUp();
				JM('#jm-panel-login').removeClass("active");
			}
		}
		
	})
 
}
// SHOW LOGGED MODULES
function showLogedModules(){  
	var el = '#jm-panel-loged-modules';
	JM("#jm-loged-wraper > div").each(function(){
		if(this.id=="jm-dropdown-loged")
		{
			if(JM(this).is(":hidden")){
				JM(el).addClass("active");
				JM(this).slideDown();
				}
			else{
				JM(this).slideUp();	
				JM('#btn-action span').removeClass("active");
			}				
		}
		else{
			if(JM(this).is(":visible")){						
				JM(this).slideUp();
				JM('#btn-action span').removeClass("active");	
			}
		}
		
	})
}
// social opup
function newPopup(pageURL){
	var left = (screen.width/2)-300;
	var top = (screen.height/2)-200;
	var popupWindow = window.open(pageURL,'connectingPopup','height=400,width=600,left='+left+',top='+top+',resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');
}
