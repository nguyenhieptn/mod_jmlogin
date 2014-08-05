	<div id="jmlogin" class="jmdefault jm-login jm_login">
		<div class="jminner">
			<div class="jmuser_images"><span><i class="fa fa-user"></i></span></div>
                <form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="login-form" class="jm-form-horizontal" >
				<div class="jm-pretext">
					<p><?php echo JText::_('MOD_JM_LOGIN_PRETEXT');?></p>
				</div>
                            <div class="jm-alert-login" style="display:none;margin-bottom: 12px;"></div>
				<div class="jm-userdata">
					<div class="jm-username">
						<span><i class="fa fa-envelope"></i></span>
						<input type="text" id="jm-input-username" class="jm-inputbox" name="username" placeholder="<?php echo $field_username; ?>"/>
					</div>
					<div class="jm-password">
						<span><i class="fa fa-lock"></i></span>
						<input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="<?php echo $field_password; ?>"/>
					</div>
					<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div class="jm-remember">
						<p><?php echo JText::_('MOD_JM_LOGIN_REMEMBER');?><input id="jm-checkbox-remember" type="checkbox" name="remember"  value="yes"/></p>
					</div>
                    <?php endif; ?>
					<div class="jm-submit">
                        <input type="submit" name="login" id="jm-login-btn"  class="jm-btn-submit" value="<?php echo JText::_('MOD_JM_LOGIN_LOGIN');?>"/>
                        <input type="hidden" name="option" value="com_users" />
    					<input type="hidden" name="task" value="user.login" /> 
    					<input type="hidden" name="return" id="jm_return"	value="<?php echo $return; ?>" />
    					<?php echo JHtml::_('form.token');?>    
                    </div>
					
					<div class="jm-login-footer">
						<div class="jm-login-footer-left jmwidth">
							<a class="jm-new-account" href="#" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('MOD_JM_LOGIN_NEW_ACCOUNT_SINGUP');?></a>
				            <a class="jm-forgot-password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('MOD_JM_LOGIN_FORGOT_YOUR_PASSWORD');?></a>
							 <a class="jm-forgot-password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('MOD_JM_LOGIN_FORGOT_YOUR_USERNAME');?></a>
						 </div>
			            <div class="jm-social jm-width"><?php echo JText::_('MOD_JM_LOGIN_CONNECT_WIDTH');?>
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
	       		 	</div>
					
				</div>
				<div class="jm-posttext">
					<p><?php echo JText::_('MOD_JM_LOGIN_PRETEXT');?></p>
				</div>
			</form>
		</div>
	</div>
