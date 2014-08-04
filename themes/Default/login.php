	<div id="jmlogin" class="jmdefault jmlogin jm_login">
		<div class="jm-inner">
			<div class="jm-user_images"><span><i class="fa fa-user"></i></span></div>
                <form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="login-form" class="jm-form-horizontal" >
				<div class="jm-pretext">
					<p>Pretext</p>
				</div>
                            <div class="jm-alert-login" style="display:none;margin-bottom: 12px;"></div>
				<div class="jm-userdata">
					<div class="jm-username">
						<span><i class="fa fa-envelope"></i></span><input type="text" id="jm-input-username" class="jm-inputbox" name="username" placeholder="<?php echo $field_username; ?>"/>
					</div>
					<div class="jm-password"><span><i class="fa fa-lock"></i></span><input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="<?php echo $field_password; ?>"/></div>
					 <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div class="jm-remember">
						<p>Remember me <input id="jm-checkbox-remember" type="checkbox" name="remember"  value="yes"/></p>
					</div>
                    <?php endif; ?>
					<div class="jm-submit">
                        <input type="submit" name="login" id="jm-login-btn"  class="jm-btn-submit" value="Sign me in"/>
                        <input type="hidden" name="option" value="com_users" />
    					<input type="hidden" name="task" value="user.login" /> 
    					<input type="hidden" name="return" id="jm_return"	value="<?php echo $return; ?>" />
    					<?php echo JHtml::_('form.token');?>    
                    </div>
					
					<div class="jm-login-footer">
						<div class="jm-login-footer-left jmwidth">
							<a class="jm-new-account" href="#" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal">New Account Singup?</a>
				            <a class="jm-forgot-password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal">Forgot your password?</a>
							 <a class="jm-forgot-password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal">Forgot your username?</a>
						 </div>
			            <div class="jm-social jm-width">Or connect width
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
	       		 	</div>
					
				</div>
				<div class="jm-posttext">
					<p>Posttext</p>
				</div>
			</form>
		</div>
	</div>
