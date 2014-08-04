	<div id="jmlogin" class="jmdefault jmlogin jm_login">
		<div class="jminner">
			<div class="jmuser_images"><span><i class="fa fa-user"></i></span></div>
                        <form method="POST" action="<?php print JURI::root(true)?>/modules/mod_jmlogin/ajax_login.php" id="login-form" class="form-horizontal" >
				<div class="pretext">
					<p>Pretext</p>
				</div>
                            <div class="alert-login" style="display:none;margin-bottom: 12px;"></div>
				<div class="userdata">
					<div class="jmemail">
						<span><i class="fa fa-envelope"></i></span><input type="text" id="login_user_email" class="inputbox" name="username" placeholder="<?php echo $field_username; ?>"/>
					</div>
					<div class="jmpassword"><span><i class="fa fa-lock"></i></span><input type="password" id="login_pass" class="inputbox" name="password" placeholder="<?php echo $field_password; ?>"/></div>
					 <?php if ($remember_me): ?>
                                        <div class="jm_remember">
						<p>Remember me <input id="modlgn-remember" type="checkbox" name="remember"  value="yes"/></p>
					</div>
                                        <?php endif; ?>
					<div class="jmsubmit"><input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Sign me in"/></div>
					
					<div class="jm-login-footer">
						<div class="jm-login-footer-left jmwidth">
							<a class="jm_new_account" href="#" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal">New Account Singup?</a>
				            <a class="jm_forgot_password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal">Forgot your password?</a>
							 <a class="jm_forgot_password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal">Forgot your username?</a>
						 </div>
			            <div class="jmsocial jmwidth">Or connect width
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
	       		 	</div>
					
				</div>
				<div class="posttext">
					<p>Posttext</p>
				</div>
			</form>
		</div>
	</div>
