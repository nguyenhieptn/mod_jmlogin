	<div id="jmlogin" class="jmdefault jmlogin jm_login">
		<div class="jm-inner">
			<div class="jm-user_images"><span><i class="fa fa-user"></i></span></div>
                <form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="login-form" class="jm-form-horizontal" >
                <div class="jm-alert-login" style="display:none;margin-bottom: 12px;"></div>
				<div class="jm-userdata">
					<div class="jm-username">
						<span><i class="fa fa-envelope"></i></span><input type="text" id="jm-input-username" class="jm-inputbox" name="username" placeholder="<?php echo JText::_('JM_USERNAME'); ?>"/>
					</div>
					<div class="jm-password"><span><i class="fa fa-lock"></i></span><input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="<?php echo JText::_('JM_PASSWORD'); ?>"/></div>
					 <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div class="jm-remember">
						<p><?php echo JText::_('JM_REMEMBER_ME'); ?> <input id="jm-checkbox-remember" type="checkbox" name="remember"  value="yes"/></p>
					</div>
                    <?php endif; ?>
					<div class="jm-submit">
                        <input type="submit" name="login" id="jm-login-btn"  class="jm-btn-submit" value="<?php echo JText::_('JLOGIN')?>"/>
                        <input type="hidden" name="option" value="com_users" />
    					<input type="hidden" name="task" value="user.login" /> 
    					<input type="hidden" name="return" id="jm-return"	value="<?php echo $login_redirect; ?>" />
    					<?php echo JHtml::_('form.token');?>    
                    </div>
					
					<div class="jm-login-footer">
						<div class="jm-login-footer-left jmwidth">
							<a class="jm-new-account" href="#" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('JM_NEW_ACCOUNT_SINGUP'); ?></a>
				            <a class="jm-forgot-password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('JM_FORGOT_YOUR_PASSWORD'); ?></a>
							 <a class="jm-forgot-password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('JM_FORGOT_YOUR_USERNAME'); ?></a>
						 </div>
			            <div class="jm-social jm-width"><?php echo JText::_('JM_CONNECT_WITH'); ?>
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
	       		 	</div>
				</div>
			</form>
		</div>
	</div>
