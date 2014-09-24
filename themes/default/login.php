	<div id="jmlogin" class="jmdefault jmlogin jm_login">
		<div class="jm-inner">
			<div class="jm-user-images"><span><i class="fa fa-user"></i></span></div>
                <form method="POST" action="<?php echo JRoute::_('index.php', true)?>" id="jm-login-form" class="jm-default-form jm-form-horizontal" >
                <div id="jm-loading-login" style="width: <?php echo $modal_width.'px;';?>;">
                    <div id="floatingBarsG"><div class="blockG" id="rotateG_01"></div><div class="blockG" id="rotateG_02"></div><div class="blockG" id="rotateG_03"></div><div class="blockG" id="rotateG_04"></div><div class="blockG" id="rotateG_05"></div><div class="blockG" id="rotateG_06"></div><div class="blockG" id="rotateG_07"></div><div class="blockG" id="rotateG_08"></div></div>
                </div>
                <div class="pretext">
                <p><?php echo $jm_login_pre_text!=''?$jm_login_pre_text:JText::_('JM_LOGIN_PRE_TEXT');?></p>
                </div> 
                <div class="jm-error" id="jm-login-error"></div>
				<div class="jm-userdata">
					<div class="jm-username">
						<span>
							<i class="fa fa-envelope"></i>
						</span>
						<input type="text" id="jm-input-username" class="inputbox" name="username" placeholder="<?php echo JText::_('JM_USERNAME'); ?>"/>
					</div>
					<div class="jm-password"><span><i class="fa fa-lock"></i></span><input type="password" id="jm-input-password" class="inputbox" name="password" placeholder="<?php echo JText::_('JM_PASSWORD'); ?>"/></div>
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
					
					<div class="jm-login-footer">
						<div class="jm-login-footer-left jm-width">
							<a class="jm-new-account" href="#" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('JM_NEW_ACCOUNT_SINGUP'); ?></a>
				            <a class="jm-forgot-password" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('JM_FORGOT_YOUR_PASSWORD'); ?></a>
							 <a class="jm-forgot-password" href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('JM_FORGOT_YOUR_USERNAME'); ?></a>
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
				</div>
                <div class="posttext">
                <p><?php echo $jm_login_post_text!=''?$jm_login_post_text:JText::_('JM_LOGIN_POST_TEXT') ;?></p>
                </div>
			</form>
		</div>
	</div>
