<?php 
defined('_JEXEC') or die('Restricted access');
?>
<div id="jmlogin" class="jmlayout3 jmlogin jm_login">
	<div class="jm-inner">
		<form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="login-form" class="jm-form-horizontal" >
			<div class="userdata">
				<div class="jm-username input jmbg">
					<input type="text" id="jm-input-username" class="inputbox" name="userename" placeholder="Username"/>
				</div>
				
				<div class="jm-password input jmbg">
					<input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="Password"/>
				</div>
				<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div class="jm-remember">
    					<p>Remember me <input id="jm-checkbox-remember" type="checkbox" name="remember"  value="yes"/></p>
    				</div>
                <?php endif; ?>
				<div class="jm-submit jmbg">
					<input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Log in"/>
                    <input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.login" /> 
					<input type="hidden" name="return" id="jm-return"	value="<?php echo $login_redirect; ?>" />
					<?php echo JHtml::_('form.token');?>    
				</div>
				
				<div class="jm-social ">
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</form>
	</div>
</div>
