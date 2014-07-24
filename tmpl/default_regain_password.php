<div id="regain_password" class="regain_password jm-tab-content">
	<div class="alert-repassword" style="padding: 5px;margin-bottom: 12px;color: #990033;"></div>
	<form action="<?php print JURI::root(true); ?>/modules/mod_jmlogin/ajax_regain_password.php" method="POST" class="form-horizontal" id="form-repassword">
		<div class="jm-control-group">
			<div class="jm-control-group" id="email_select">
				<div class="controls-label">
					<div class="jm-label-wrap clearfix">
						<label for="inputEmail"><?php echo $field_email; ?></label>
					</div>
				</div>
				<div class="controls-content">
					<div class="jm-input-wrap clearfix">
						<input type="text" id="re_inputEmail" name="email" placeholder="<?php echo $field_email; ?>"/>
					</div>
				</div>
			</div>
			<div>
				<input type="hidden" name="nexist" value="<?php echo ($nexist);?>" />
			</div>
			<div class="jm-control-group">
				<div class="controls-content">
					<?php echo JHTML::_('form.token');?>
					<button class="btn-jm-submit" type="submit" id="repassword-btn" name="repassword" value="REPASSWORD"><?php echo $btn_regain_password; ?></button>
				</div>
			</div>
		</div>
	</form>
</div>