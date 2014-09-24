<?php 
defined('_JEXEC') or die('Restricted access');
?>
	<div id="jmlogin" class="jmlayout1 jmlogin jm_login">
		<div class="jminner">
			<div id="inner">
				<div class="jmuser_images"><span><i class="fa fa-user"></i></span></div>
				<div class="jmtitle"><?php echo JText::_('MOD_JM_LOGIN_TITLE');?></div>
				<form method="POST" id="login-form">
					<div class="pretext">
						<p><?php echo JText::_('MOD_JM_LOGIN_PRETEXT');?></p>
					</div>
					<div class="userdata">
						<input type="text" id="jm-input-username" class="inputbox" name="username" placeholder="User Name"/>
						<input type="password" id="jm-input-pass" class="inputbox" name="password" placeholder="Password"/>
					<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div class="jm-remember">
						<p><?php echo JText::_('MOD_JM_LOGIN_REMEMBER');?><input id="jm-checkbox-remember" type="checkbox" name="remember"  value="yes"/></p>
					</div>
                    <?php endif; ?>
						<div class="jmsubmit"><input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Login"/></div>
						<div class="jm-login-footer">
						<div class="jm-login-footer-left jmwidth">
							<a class="jm_new_account" href="#" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('MOD_JM_LOGIN_NEW_ACCOUNT_SINGUP');?></a>
				            <a class="jm_forgot_password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('MOD_JM_LOGIN_FORGOT_YOUR_PASSWORD');?></a>
							<a class="jm_forgot_password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('MOD_JM_LOGIN_FORGOT_YOUR_USERNAME');?></a>
						 </div>
			            <div class="jmsocial jmwidth"><?php echo JText::_('MOD_JM_LOGIN_CONNECT_WIDTH');?>
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>

					<div class="posttext">
						<p><?php echo JText::_('MOD_JM_LOGIN_PRETEXT');?></p>
					</div>
				</form>
			</div>
		</div>
	</div>
 </div>
 