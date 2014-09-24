<?php
defined('_JEXEC') or die('Restricted access');
?>
	<div id="jmlogin" class="jmlayout4 jmlogin jm_login">
		<div class="jm-inner">
			<div class="jmbordertop"></div>
			<div class="jm-title"><?php echo $jm_login_title!=''?$jm_login_title:JText::_('JM_LOGIN_TITLE');?></div>
			<form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="jm-login-form" class="jm-layout4-form jm-form-horizontal" >
                <div class="jm-error" id="jm-login-error"></div>
				<div class="jm-userdata">
					<div class="jmusername input ">
					   <input type="text" id="jm-input-username" class="inputbox" name="username" placeholder="<?php echo JText::_('JM_USERNAME'); ?>"/>
					</div>
					<div class="jmpassword input ">
                        <input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="<?php echo JText::_('JM_PASSWORD'); ?>"/>
                    </div>
                    	<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div class="jm-remember">
						<p><?php echo JText::_('JM_REMEMBER_ME'); ?> <input id="jm-checkbox-remember" type="checkbox" name="remember"  value="yes"/></p>
					</div>
                    <?php endif; ?>
					<div class="jm-submit">
                        <input type="submit" name="login" id="jm-login-btn"  class="jm-btn-submit" value="<?php echo $jm_login_button_text!=''?$jm_login_button_text:JText::_('JLOGIN')?>"/>
                        <input type="hidden" name="option" value="com_users" />
    					<input type="hidden" name="task" value="user.login" /> 
    					<input type="hidden" name="return" id="jm-return"	value="<?php echo $return; ?>" />
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
					<div class="jmborderbottom"></div>
					
				</div>
				
			</form>
		</div>
	</div>
