<div id="jmregister" class="jmlayout2 jmregister jm_login">
	<div class="jm-inner">
		<div class="jm-title"><?php echo JText::_('MOD_JM_LOGIN_REGISTRER_TITLE');?></div>
		<form method="POST" id="jm-form-register" class="jm-layout2-form form-horizontal" action="<?php echo JRoute::_('index.php', true); ?>" >
			<div id="jm-loading-register" style="width: <?php echo $modal_width.'px;';?>;">
                     <div id="floatingBarsG1"><div class="blockG" id="rotateG_01"></div><div class="blockG" id="rotateG_02"></div><div class="blockG" id="rotateG_03"></div><div class="blockG" id="rotateG_04"></div><div class="blockG" id="rotateG_05"></div><div class="blockG" id="rotateG_06"></div><div class="blockG" id="rotateG_07"></div><div class="blockG" id="rotateG_08"></div></div>
                </div>
                <div id="jm-success"></div>
                <div id="jm-registration-error" class="jm-error"></div>
			<div class="userdata">
				<div class="jm-name input">
					<span><i class="fa fa-user"></i></span>
                    <input type="text" id="jm-input-name" class="inputbox" name="name" placeholder="<?php echo JText::_('JM_REGISTER_NAME'); ?>"/>
				</div>
				<div class="jm-username input">
					<span><i class="fa fa-user"></i></span>
                    <input type="text" id="jm-input-user-name" class="inputbox" name="username" placeholder="<?php echo JText::_('JM_USERNAME'); ?>"/>
				</div>
				<div class="jm-password input"><span><i class="fa fa-lock"></i></span>
                <input type="password" id="jm-input-pass" class="inputbox" name="password" placeholder="<?php echo JText::_('JM_PASSWORD'); ?>"/> 
				</div>
				<div class="jm-confirmpassword input"><span><i class="fa fa-lock"></i></span>
                <input type="password" id="jm-input-confirm-pass" class="inputbox" name="password2" placeholder="<?php echo JText::_('JM_CONFIRM_PASSWORD'); ?>"/></div>
				<div class="jm-emailaddress input"><span><i class="fa fa-envelope"></i></span>
                <input type="text" id="jm-input-email" class="inputbox" name="email" placeholder="<?php echo JText::_('JM_REGISTER_EMAIL_ADDRESS'); ?>"/></div>
				
				<div class="jm-emailaddress input"><span><i class="fa fa-envelope"></i></span><input type="text" id="jm-input-confirm-email" class="inputbox" name="confirmeamil" placeholder="<?php echo JText::_('JM_REGISTER_CONFIRM_EMAIL_ADDRESS'); ?>"/></div>
			    <?php if($use_captcha!=0){   ?>
					<div class="jm-field">
						<div  id="jm-captchas"><?php echo $captcha;?></div>
					</div>
					<div id="jm-registration-captcha-error" class="btl-error-detail"></div>
					<div class="clear"></div>
					<?php }?>    
                    <label class="jm-wrap">Filds width(*) are required</label>  
				<div class="jm-submit">
                        <input type="submit" name="register" id="jm-register-btn" class="btn-jm-submit" value="Register"/>
                        <input type="hidden" name="task" value="register" />
    					<?php echo JHtml::_('form.token');?>
                    </div>
				
			     
			</div>
		
		</form>
	</div>
</div>