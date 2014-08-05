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
// include the helper file
require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php' );
require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR .'assets'.DIRECTORY_SEPARATOR.'captcha'.DIRECTORY_SEPARATOR.'captcha.php' );

//params
$label_login = $params->get('tag_login_modal');
$show_recaptcha = $params->get('show_captcha',0);
$show_formlabel = $params->get('show_formlabel',0);
$show_close_btn = $params->get('show_close_btn',true);
$modal_scroll = $params->get('modal_scroll',true);
$modal_width = $params->get('modal_width',400);
$modal_height = $params->get('modal_height','auto');
$label_register = $params->get('tag_register_modal');
$label_regain_password = $params->get('tag_regain_password_modal');
$field_name = $params->get('field_name');
$field_username = $params->get('field_username');
$field_password = $params->get('field_password');
$field_verifypassword = $params->get('field_verifypassword');
$field_email = $params->get('field_email');
$field_verifyemail = $params->get('field_verifyemail');
$btn_sign_in = $params->get('btn_sign_in');
$btn_register = $params->get('btn_register');
$btn_regain_password = $params->get('btn_regain_password');
$load_jquery = $params->get('loadJquery');
$align_option = $params->get('align_option');
$login_redirect = $params->get('login');
$logout_redirect = $params->get('logout');
$theme = $params->get('theme','Default');
$publickey = $params->get('recaptcha_public', '6LfSV9MSAAAAAFj0hZMcuGtMD7drzb7zhvrmQqnf');
$private_key = $params->get('recaptcha_private', '6LfSV9MSAAAAAPBf64L7fmC_uii-EKza_98qKpG3');
$name_display = $params->get('name');
$register_tab = $params->get('enabled_registration_tab');
$error_invalid = $params->get('error_invalid_username_or_password', 'Invalid username or password');
$msg_username = $params->get('error_existing_username_register', 'Error: This existing username.');
$msg_email = $params->get('error_existing_email_register', 'Error: This existing email.');
$captcha = $params->get('error_wrong_capcha_register', 'Error: Wrong capcha');
$success = $params->get('mess_successfully_register_register', 'Successfully register, check mail (spam) activation account.');
$nexist = $params->get('mess_account_not_exists_regainpass', 'Note: Account not exists');
$check = $params->get('mess_check_mail_regainpass', 'Note: Please check mail to retrieve your password.');
//
if(JRequest::getVar("jmtask")){
	modJmloginHelper::jmajax();
}
//
require_once JPATH_SITE . '/modules/mod_jmlogin/assets/recapcha/recaptchalib.php';
$login = new modJmloginHelper();
$login = $login->getLogin($params);
// url return after form post
$user =  JFactory::getUser();
$type= (!$user->get('guest')) ? 'logout' : 'login';
if($login_redirect<>""){
    $login_redirect = modJmloginHelper::getLoginUrlReturn($params);
}else{
    $login_redirect = modJmloginHelper::getURLReturn( $params, $type );
}
if($logout_redirect<>""){
    $logout_redirect = modJmloginHelper::getLogoutUrlReturn($params);
}else{
    $logout_redirect = modJmloginHelper::getURLReturn( $params, $type );
}
$return_login_decode = base64_decode($login_redirect);
$return_logout_decode = base64_decode($logout_redirect);
//$register_return = modJmloginHelper::getURLReturn( $params, $type );

$doc = JFactory::getDocument();
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$custom_css = JPATH_SITE . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'_'.'default'.'.css';

//
if (file_exists($custom_css)) {
    $doc->addStylesheet(JURI::base(true) . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'.css');
    $doc->addStylesheet(JURI::base(true) . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'_'. $theme . '.css');
} else {
    $doc->addStylesheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/mod_jmlogin.css');
    $doc->addStylesheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/mod_jmlogin_'.$theme.'.css');
}
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/font-awesome.min.css');
// Captcha

$captcha_format = $params->get('captcha_format', 'png');
$captcha_width = $params->get('captcha_width', 100);
$captcha_height = $params->get('captcha_height', 40);
$captcha_font_min = $params->get('captcha_font_min', 11);
$captcha_font_max = $params->get('captcha_font_max', 14);
$captcha = JXCaptcha::getInstance('image', array(
            'filePath'	=> JPATH_SITE.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'mod_jmlogin'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'captcha'.DIRECTORY_SEPARATOR.'images',
            'format'	=> $captcha_format,
            'width'	=> $captcha_width,
            'height'	=> $captcha_height,
            'minFont'	=> $captcha_font_min,
            'maxFont'	=> $captcha_font_max
        )
    );
if (!$captcha->test() || !$captcha->initialize()) {
    // either the test failed or the object could not initialize, raise an error and return
    JError::raiseWarning(500, $captcha->getError());
}
$captcha->clean();
$return_captcha = $captcha->create();

require JModuleHelper::getLayoutPath('mod_jmlogin', 'default');
?>
<script type="text/javascript">
 var modal_height='<?php echo $modal_height;?>'
</script>