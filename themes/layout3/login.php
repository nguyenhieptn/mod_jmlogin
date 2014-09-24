<?php 
defined('_JEXEC') or die('Restricted access');
?>
<div id="jmlogin" class="jmlayout3 jmlogin jm_login">
	<div class="jm-inner">
		<form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="jm-login-form" class="jm-layout3-form jm-form-horizontal" >
			<div class="jm-error" id="jm-login-error"></div>
            <div class="jm-userdata">
				<div class="jm-username input jmbg">
					<input type="text" id="jm-input-username" class="inputbox" name="userename" placeholder="Username"/>
				</div>
				
				<div class="jm-password input jmbg">
					<input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="Password"/>
				</div>
				<div class="jm-submit jmbg">
					<input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Log in"/>
                    <input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.login" /> 
					<input type="hidden" name="return" id="jm-return"	value="<?php echo $login_redirect; ?>" />
					<?php echo JHtml::_('form.token');?>    
				</div>
				
				<?php if($jmlogin_enable_fb):?>
			            <div class="jm-social jm-width"><?php echo $jm_login_connect_with!=''?$jm_login_connect_with:JText::_('JM_CONNECT_WITH'); ?>
							<ul>
								<?php if($jmlogin_enable_fb):?><li><a href="JavaScript:newPopup('<?php echo $fb_popup;?>');"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<?php if($jmlogin_enable_gg):?><li><a href="JavaScript:newPopup('<?php echo $gg_popup;?>');"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
							</ul>
						</div>
                        <?php endif;?>
			</div>
		</form>
	</div>
</div>
