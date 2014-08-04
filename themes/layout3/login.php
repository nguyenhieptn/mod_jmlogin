<?php 
defined('_JEXEC') or die('Restricted access');
?>
<div id="jmdefault" class="jm_login">
	<div class="jminner">
		<form method="POST" id="login-form">
			<div class="userdata">
				<div class="jmusername input jmbg">
					<input type="text" id="login_user_name" class="inputbox" name="userename" placeholder="Username"/>
				</div>
				
				<div class="jmpassword input jmbg">
					<input type="password" id="login_pass" class="inputbox" name="password" placeholder="Password"/>
				</div>
				
				<div class="jmsubmit jmbg">
					<input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Log in"/>
				</div>
				
				<div class="jmsocial ">
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</form>
	</div>
</div>
