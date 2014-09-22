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
jimport ( 'joomla.application.component.view' );
jimport ( 'joomla.application.component.helper' );
jimport ( 'joomla.plugin.plugin' );
// include the helper file
if (!defined('DS'))
  define('DS', '/');

require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php' );
modJmloginHelper::loadScriptJtext(); 
$session = JFactory::getSession();
// load language 
$language = JFactory::getLanguage();
$language_tag = $language->getTag(); 
JFactory::getLanguage()->load('mod_jmlogin',JPATH_SITE,$language_tag,true);
JFactory::getLanguage()->load('lib_joomla',JPATH_SITE,$language_tag,true);
JFactory::getLanguage()->load('com_users',JPATH_SITE,$language_tag,true);

//params
 
$use_captcha = $params->get('use_captcha',0);
$show_close_btn = $params->get('show_close_btn',true);
$modal_width = $params->get('modal_width',400);
$modal_height = $params->get('modal_height','auto');
$load_jquery = $params->get('loadJquery');
$login_redirect = $params->get('login');
$logout_redirect = $params->get('logout');
$theme = $params->get('theme','default');
$name_display = $params->get('name');
$login_tab = $params->get('enabled_login_tab'); 
$register_tab = $params->get('enabled_registration_tab');
$mount_event= $params->get('mouse_event','click') ;

$jmlogin_enable_fb=$params->get('jmlogin_enable_fb');
$jmlogin_appfb_id=$params->get('jmlogin_appfb_id');
$jmlogin_appfb_secret=$params->get('jmlogin_appfb_secret');
$jmlogin_enable_gg=$params->get('jmlogin_enable_gg');
$jmlogin_appgg_id=$params->get('jmlogin_appgg_id');
$jmlogin_appgg_secret=$params->get('jmlogin_appgg_secret');

$jmlogin_social_show_avatar=$params->get('jmlogin_social_show_avatar');
if(JRequest::getVar("jmtask")){
	modJmloginHelper::jmajax();
}
//loged load module or position
$loggedload = modJmloginHelper::getModules ( $params );
//setting display type
if ($params->get ( "display_type" ) == 1) {
	$display_type = 'jm-dropdown';
} else {
	$display_type = 'jm-modal';
}
// get config ini data
$theme_data= modJmloginHelper::loadlThemeData($params);
 
// url return after form post
$user =  JFactory::getUser();
$type= (!$user->get('guest')) ? 'logout' : 'login';
$return = modJmloginHelper::getURLReturn( $params, $type );
$return_decode = base64_decode($return);
$return_decode = str_replace('&amp;','&',JRoute::_($return_decode));

$doc = JFactory::getDocument();
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$custom_css = JPATH_SITE . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'_'.'default'.'.css';

//add css
if (file_exists($custom_css)) {
    $doc->addStylesheet(JURI::base(true) . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'.css');
    $doc->addStylesheet(JURI::base(true) . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'_'. $theme . '.css');
} else {
    $doc->addStylesheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/mod_jmlogin.css');
    $doc->addStylesheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/mod_jmlogin_'.$theme.'.css');
}
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/font-awesome.min.css');
if($use_captcha!=0){
    $captcha = modJmloginHelper::getCaptcha();
}
//sociasl
$callback_url = JURI::getInstance()->toString();
$fb_popup=modJmloginHelper::getfb_popup($jmlogin_appfb_id,$callback_url);
$gg_popup=modJmloginHelper::getgg_popup($jmlogin_appgg_id,urlencode(substr(JURI::base(false),0,-1)));
if(isset($_REQUEST["code"])){
    $code = $_REQUEST["code"];
    if($jmlogin_enable_fb && $_REQUEST["state"]=='fb'){
			modJmloginHelper::deniedRequest();
	   		$callback_url =  modJmloginHelper::getOpenerUrl($callback_url);
		   	$token_url = modJmloginHelper::getTokenUrl($jmlogin_appfb_id, $callback_url, $jmlogin_appfb_secret, $code);			
			$response = modJmloginHelper::curlResponse($token_url);
		    $paramsFB = null;
		    parse_str($response, $paramsFB);
		    $graph_url = "https://graph.facebook.com/me?access_token=".$paramsFB['access_token'];
			$user = modJmloginHelper::curlResponse($graph_url);
			$user = modJmloginHelper::prepareData(json_decode($user),'facebook');
			$user = modJmloginHelper::assignProfile($user);  
            modJmloginHelper::generalUser($user);          
			$user['access_token'] = $paramsFB['access_token'];
			modJmloginHelper::checkUser($user);
    }else if($jmlogin_enable_gg && $_REQUEST["state"]=='gg'){
			modJmloginHelper::deniedRequest();	 
	   	  	$token = modJmloginHelper::getTokenGG($code, $jmlogin_appgg_id, $jmlogin_appgg_secret, substr(JURI::base(false),0,-1), 'authorization_code');
	   	    $user = modJmloginHelper::getUserGG($token->access_token);
			$user = modJmloginHelper::prepareData($user,'google');
			$user = modJmloginHelper::assignProfile($user,$params->get ( 'gg-profiles' ));
            modJmloginHelper::generalUser($user); 
			$user['access_token'] = $token->access_token;
		 	modJmloginHelper::checkUser($user); 
		 
    }
}
 
require JModuleHelper::getLayoutPath('mod_jmlogin', 'default');
 
 