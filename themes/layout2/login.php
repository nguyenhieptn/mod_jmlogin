<?php 
defined('_JEXEC') or die('Restricted access');
?>

<div id="jmlogin" class="jmlayout2 jmlogin jm_login">
	<div class="jm-inner">
		<div class="jm-title">Login</div>
		<form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="login-form" class="jm-form-horizontal" >
			
			<div class="userdata">
				<div class="jm-username input">
					<span><i class="fa fa-user"></i></span><input type="text" id="jm-input-username" class="inputbox" name="userename" placeholder="username"/>
				</div>
				<div class="jm-password input"><span><i class="fa fa-lock"></i></span><input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="password"/></div>
			    <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                <div class="jm-remember">
					<p>Remember me <input id="jm-checkbox-remember" type="checkbox" name="remember"  value="yes"/></p>
				</div>
                <?php endif; ?>
				<div class="jm-submit">
                    <input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Enter"/>
                    <input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.login" /> 
					<input type="hidden" name="return" id="jm-return"	value="<?php echo $login_redirect; ?>" />
					<?php echo JHtml::_('form.token');?>    
                </div>
				<hr/>
				<div class="jm-social jm-width"><p>Or connect width</p>
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i><span>facebook</span></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i><span>twitter</span></a></li>
					</ul>
				</div>
				
			</div>
			
		</form>
	</div>
</div>
