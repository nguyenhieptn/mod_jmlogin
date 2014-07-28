
	<div id="jmregister" class="jmdefault jmregister jm_login ">
		<div class="jminner">
			<div class="jmuser_images"><span><i class="fa fa-pencil"></i></span></div>
			<form method="POST" id="login-form" class="form-horizontal" id="jm-form-register" action="<?php print JURI::root(true)?>/modules/mod_jmlogin/ajax_register.php" >
				
				<div class="userdata">
					<input type="text" id="register_name" class="inputbox" name="name" placeholder="Name"/>
					<input type="text" id="register_username" class="inputbox" name="username" placeholder="User Name"/>
					<input type="password" id="register_pass" class="inputbox" name="password" placeholder="Password"/>
					<input type="text" id="register_confirm_pass" class="inputbox" name="password2" placeholder="Confirm Password"/>
					<input type="text" id="register_email_address" class="inputbox" name="emailaddress" placeholder="Email Adress"/>
					<input type="text" id="register_confirm_email_address" class="inputbox" name="confirmeamiladdress" placeholder="Confirm Email Address"/>
                                       
                                                <?if($show_recaptcha):?>
                                                                <?php echo recaptcha_get_html($publickey); ?>
                                                <?endif;?>
                                                <label class="jm-wrap">Filds width(*) are required</label> 
                                        
					<div class="jmsubmit"><input type="submit" name="register" id="jm-register-btn" class="btn-jm-submit" value="Register"/></div>
					
				</div>
			
			</form>
		</div>
	</div>
