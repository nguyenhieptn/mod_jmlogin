<div id="jmregister" class="jmlayout2 jmregister jm_login">
	<div class="jm-inner">
		<div class="jm-title">Register</div>
		<form method="POST" id="form-register" class="form-horizontal" action="<?php echo JRoute::_('index.php', true); ?>" >
			<div id="jm-success"></div>
			<div class="userdata">
				<div class="jm-name input">
					<span><i class="fa fa-user"></i></span><input type="text" id="jm-input-name" class="inputbox" name="name" placeholder="name"/>
				</div>
				<div class="jm-username input">
					<span><i class="fa fa-user"></i></span><input type="text" id="jm-input-user-name" class="inputbox" name="userename" placeholder="username"/>
				</div>
				<div class="jm-password input"><span><i class="fa fa-lock"></i></span><input type="password" id="jm-input-pass" class="inputbox" name="password" placeholder="password"/></div>
				
				<div class="jm-confirmpassword input"><span><i class="fa fa-lock"></i></span><input type="password" id="jm-input-confirm-pass" class="inputbox" name="password" placeholder="confirm password"/></div>
				<div class="jm-emailaddress input"><span><i class="fa fa-envelope"></i></span><input type="password" id="jm-input-email" class="inputbox" name="password" placeholder="email address"/></div>
				
				<div class="jm-emailaddress input"><span><i class="fa fa-envelope"></i></span><input type="password" id="jm-input-confirm-email" class="inputbox" name="password" placeholder="confirm email address"/></div>
			    <?php if($show_recaptcha):?> 
                    <div class="captcha">
                        <div style="min-width: 13em; padding: 0 5px;">
                            <label id="captcha-lbl" for="captcha">
                                <img src="<?php echo JURI::base( true ); ?>/modules/mod_jmlogin/assets/captcha/images/<?php echo $return_captcha['file'];?>" alt="" id="captcha_img" />
                                <span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div style="padding-top: 8px;">
                            <input type="text" id="captcha" name="<?php echo $return_captcha['id']; ?>" class="required" size="10" />
                        </div>
                        <div style="padding: 11px 0 0 4px;"><?php //echo JText::_('AJAXREG_CAPTCHA'); ?></div>
                    </div>
                    <?php endif;?>
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