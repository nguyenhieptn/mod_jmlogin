<?php
$doc =JFactory::getDocument();
$doc-> addStylesheet('modules/mod_jmlogin/themes/Layout2/asset/css/jm_login_layout2.css') 
?>


<div id="jmlogin" class="jmlayout2 jm_login">
	<div class="jminner">
		<div class="jmtitle">Login</div>
		<form method="POST" action="<?php print JURI::root(true)?>/modules/mod_jmlogin/ajax_login.php" id="login-form" class="form-horizontal" >
			
			<div class="userdata">
				<div class="jmusername input">
					<span><i class="fa fa-user"></i></span><input type="text" id="login_user_name" class="inputbox" name="userename" placeholder="username"/>
				</div>
				<div class="jmpassword input"><span><i class="fa fa-lock"></i></span><input type="password" id="login_pass" class="inputbox" name="password" placeholder="password"/></div>
				
				<div class="jmsubmit"><input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Enter"/></div>
				<hr>
				<div class="jmsocial jmwidth"><p>Or connect width</p>
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i><span>facebook</span></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i><span>twitter</span></a></li>
					</ul>
				</div>
				
			</div>
			
		</form>
	</div>
</div>
