<?php 
defined('_JEXEC') or die('Restricted access');
?>
	<div id="jmlogin" class="jmlayout5 jmlogin jm_login">
		<div class="jm-inner">
			<div class="jm-title"><?php echo $jm_login_title!=''?$jm_login_title:JText::_('MOD_JM_LOGIN_TITLE')?></div>
			<form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="jm-login-form" class="jm-layout5-form jm-form-horizontal" >
				<div class="jm-error" id="jm-login-error"></div>
                <div class="jm-userdata">
					<div class="jmusername input">
						<span><i class="fa fa-user"></i></span>
                        <input type="text" id="jm-input-username" class="inputbox" name="username" placeholder="<?php echo JText::_('JM_USERNAME'); ?>"/>
					</div>
					<div class="jmpassword input">
                        <span><i class="fa fa-lock"></i></span>
                        <input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="<?php echo JText::_('JM_PASSWORD'); ?>"/>
                    </div>
					
					<div class="jm-submit input">
                        <input type="submit" name="login" id="jm-login-btn"  class="jm-btn-submit" value="<?php echo $jm_login_button_text!=''?$jm_login_button_text:JText::_('JLOGIN')?>"/>
                        <input type="hidden" name="option" value="com_users" />
    					<input type="hidden" name="task" value="user.login" /> 
    					<input type="hidden" name="return" id="jm-return"	value="<?php echo $return; ?>" />
    					<?php echo JHtml::_('form.token');?>    
                    </div>
		             <?php if($jmlogin_enable_fb):?>
			            <div class="jm-social jm-width">
                            <p><?php echo $jm_login_connect_with!=''?$jm_login_connect_with:JText::_('JM_CONNECT_WITH'); ?></p>
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
