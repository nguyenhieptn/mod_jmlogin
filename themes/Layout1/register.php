<?php 
defined('_JEXEC') or die('Restricted access');
?>
<div id="jmregister" class="jmlayout1 jmregister jm_login">
		<div class="jminner">
			<div class="jmuser_images"><span><i class="fa fa-pencil"></i></span></div>
			<div class="jmtitle">Register</div>
			<form method="POST" id="login-form">
				
				<div class="userdata">
					<input type="text" id="register_name" class="inputbox" name="name" placeholder="Name"/>
					<input type="text" id="register_username" class="inputbox" name="username" placeholder="User Name"/>
					<input type="password" id="registerpass" class="inputbox" name="password" placeholder="Password"/>
					<input type="text" id="register_confirm_pass" class="inputbox" name="username" placeholder="Confirm Password"/>
					<input type="text" id="register_email_address" class="inputbox" name="emailaddress" placeholder="Email Adress"/>
					<input type="text" id="register_confirm_email_address" class="inputbox" name="confirmeamiladdress" placeholder="Confirm Email Address"/>
				
					<div class="jmsubmit"><input type="submit" name="register" id="jm-register-btn" class="btn-jm-submit" value="Register"/></div>
					
				
				</div>
			
			</form>
		</div>
</div>