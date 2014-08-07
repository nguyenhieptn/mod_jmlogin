<!--Layout:Modal,Order:1-->
<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Login
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */

// no direct access
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
$main = JFactory::getApplication();
$menu = $main->getMenu();
if ($load_jquery == 1) {
    $document->addScript(JURI::base(true) . '/modules/mod_jmlogin/assets/js/jquery-1.8.3.js');
}
$document->addStyleSheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/scrollbar.css');
$user = JFactory::getUser();
$name = !$user->guest;
$remember_me = $params->get('jmlogin-remember-me', 0);
?>
<script type="text/javascript">
var jm_login_base_url = '<?php print JURI::root(true);?>';
</script>
 
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jquery.tinyscrollbar.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jmmodal.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jmtab.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jmlogin.js';?>"></script>
 
<!-- START Jm Login MODULE -->
<div class="jmlogins <?php echo $moduleclass_sfx; ?>  <?php echo $theme ? ' ' . $theme : '' ?>" id="jmnewspro-<?php print $module->id; ?>">
    <?php if ($name) { ?>
        <div class="btn-jm-group" > 
			<div class='jmlogin_dropdown_after'>
				<div class='jmlogin_username_wrap icon-user'>
					<a class='jmlogin_username' href="javascript:void(0);"><?php echo ($name_display) ? $user->name : $user->username; ?></a>
				</div>
				<div class='jmlogin_logout_btn_wrap'>
					<a class='jmlogin_logout_btn' href="javascript:void(0);" onclick="jQuery('.form_logout').submit();">LOGOUT</a>
				</div>
			</div>
            <ul class="jmlogin_form_logout">
                <li>
                    <form class="form_logout" action="index.php" method="POST">
                        <input type="hidden" name="Submit" class="button" value="<?php echo JText::_('Logout'); ?>" />
                        <input type="hidden" name="option" value="com_users" />
    					<input type="hidden" name="task" value="user.logout" />
                        <input type="hidden" name="return" value="<?php echo $logout_redirect; ?>" />
                        <?php echo JHtml::_('form.token'); ?>
                    </form>
                </li>
            </ul>
        </div>
		<div class='clear'></div>
    <?php } else { ?>
        <div class="btn-jm-group" id="btn-action">
            <a class="jm-login-link-modal link-login" href="#jmmodal" data-tabid="#jmlogin" data-tab="jmtab" data-toggle="jmmodal"><i class="icon-user"></i>Login</a>
            <?php if ($register_tab): ?>
            <a class="jm-login-link-modal link-registet" href="#jmmodal" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal">Register</a>
            <?php endif; ?>
        </div>
    <?php } ?>
    <div id="jmmodal" class="jm-tabs-content jmmodal" data-modalwidth="<?php echo $modal_width;?>"  data-modalclose="<?php echo $show_close_btn;?>" >
        <div id="jm-login-wrap">
            <div id="tab-content"  class="jmmodal-body">
                <!-- Start login -->
                <?php include("modules/mod_jmlogin/themes/".$theme."/login.php"); ?>
                <!-- End login -->
                <!-- Start  register -->
                <?php
                //if ($register_tab) {
                    include("modules/mod_jmlogin/themes/".$theme."/register.php");
                //}
                ?>
            </div>
        </div>		
    </div>
	<div class="jmtab_active"></div>
</div>
<!-- END Jm Login MODULE -->
<script type="text/javascript">
var jmOpt = 
{
	JM_AJAX					:'<?php echo addslashes(JURI::getInstance()->toString()); ?>',
	JM_LOGIN_RETURN				:'<?php echo addslashes($return_login_decode); ?>',
    JM_LOGOUT_RETURN				:'<?php echo addslashes($return_logout_decode); ?>',
}
jQuery(document).ready(function($){
	$('.jmlogin_username').click(function(){
		$('.jmlogin_logout_btn_wrap').toggle();
	});
});
</script>