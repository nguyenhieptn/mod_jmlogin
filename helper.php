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

/**
 * Example Module Helper
 *
 * @package		  Joomla!
 * @subpackage	Jm Login
 * @since 		  1.0.0
 * @class       ModJmloginHelper
 */
class modJmloginHelper {

    function getLogin($params) {
        $activation = JRequest::getVar('activation');
        if ($activation) {
            $this->confirmEmail($activation);
        }
    }

    function confirmEmail($activation) {
        $app = &JFactory::getApplication();
        //echo $activation;
        //$activation=JRequest::getVar('confirmEmail');
        $db = JFactory::getDbo();
        $query = "SELECT id FROM #__users WHERE activation='{$activation}'";
        $db->setQuery($query);
        $userid = $db->loadResult();
        if (!empty($userid)) {
            $account = JFactory::getUser($userid);
            $account->block = 0;
            $account->save();
            $app->redirect('index.php', 'Your account has been activated.');
        } else {
            $app->redirect('index.php', 'The activation code is not valid.', 'error');
        }
    }
		
	static function getTemplate(){
		$db=JFactory::getDBO();
		$query=$db->getQuery(true);
		$query->select('*');
		$query->from('#__template_styles');
		$query->where('home=1');
		$query->where('client_id=0');
		$db->setQuery($query);
		return $db->loadObject()->template;
	}
    public static function getURLReturn($params, $type)
	{
		$app	= JFactory::getApplication();
		$router = $app->getRouter();
		$url = null;
        
		if ($itemid =  $params->get($type))
		{
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true);

			$query->select($db->quoteName('link'));
			$query->from($db->quoteName('#__menu'));
			$query->where($db->quoteName('published') . '=1');
			$query->where($db->quoteName('id') . '=' . $db->quote($itemid));

			$db->setQuery($query);
			if ($link = $db->loadResult()) {
				if ($router->getMode() == JROUTER_MODE_SEF) {
					$url = 'index.php?Itemid='.$itemid;
				}
				else {
					$url = $link.'&Itemid='.$itemid;
				}
			}
		}
		if (!$url)
		{
			// stay on the same page
			$uri = clone JFactory::getURI();
			$vars = $router->parse($uri);
			unset($vars['lang']);
			if ($router->getMode() == JROUTER_MODE_SEF)
			{
				if (isset($vars['Itemid']))
				{
					$itemid = $vars['Itemid'];
					$menu = $app->getMenu();
					$item = $menu->getItem($itemid);
					unset($vars['Itemid']);
					if (isset($item) && $vars == $item->query) {
						$url = 'index.php?Itemid='.$itemid;
					}
					else {
						$url = 'index.php?'.JURI::buildQuery($vars).'&Itemid='.$itemid;
					}
				}
				else
				{
					$url = 'index.php?'.JURI::buildQuery($vars);
				}
			}
			else
			{
				$url = 'index.php?'.JURI::buildQuery($vars);
			}
		}
		return base64_encode($url);
    
        
	}
public static function getLoginUrlReturn($params){
    $app	= JFactory::getApplication();
    $menu = $app->getMenu();
    $menuItem = $menu->getItem($params->get('login'));
    $url = JRoute::_($menuItem->link.'&Itemid='.$params->get('login'));
    return base64_encode($url);
}
public static function getLogoutUrlReturn($params){
    $app	= JFactory::getApplication();
    $menu = $app->getMenu();
    $menuItem = $menu->getItem($params->get('logout'));
    $url = JRoute::_($menuItem->link.'&Itemid='.$params->get('logout'));
    return base64_encode($url);
}
public static function jmajax(){
		$mainframe =& JFactory::getApplication('site');
		//JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$jmtask = JRequest::getVar('jmtask');
		
		/**
		 * check task is login to do
		 */
		if($jmtask=='login'){
				if ($return = JRequest::getVar('return', '', 'method', 'base64')) {
					$return = base64_decode($return);
					if (!JURI::isInternal($return)) {
						$return = '';
					}
				}		
				$options = array();
				
				$options['remember'] = JRequest::getBool('remember', false);
				
				$options['return'] = $return;
		
				$credentials = array();
				
				$credentials['username'] = JRequest::getVar('username', '', 'method', 'username');
				
				$credentials['password'] = JRequest::getString('passwd', '', 'post', JREQUEST_ALLOWRAW);
				
				//preform the login action
				$error = $mainframe->login($credentials, $options);
				self::ajaxResponse($error);
		}elseif($jmtask=='register') {   
			/**
			 * check task is registration to do
			 */
			// If registration is disabled - Redirect to login page.
			if(JComponentHelper::getParams('com_users')->get('allowUserRegistration') == 0){
				// set message in here : Registration is disable
				self::ajaxResponse("Registration is not allow!");
			}
		
			//check captcha 
		/*	$enabledRecaptcha=JRequest::getVar('recaptcha');
			if($enabledRecaptcha=='yes'){
				if(JRequest::getVar('recaptcha_response_field')){
					$captcha = JCaptcha::getInstance('recaptcha');		
					//$captcha->initialise('6Lf7Js8SAAAAAJBSx3JdwDKN0F1kVTF47Uz_DEli ');
					$checkCaptcha = $captcha->checkAnswer(JRequest::getVar('recaptcha_response_field'));
					if($checkCaptcha==false){
						self::ajaxResponse('$error$'.JText::_('PLG_RECAPTCHA_ERROR_INCORRECT_CAPTCHA_SOL'));
					}
				}elseif(JRequest::getString('btl_captcha')){
					$session = JFactory::getSession();
					echo $session->get('btl_captcha');
					if(JRequest::getString('btl_captcha') != $session->get('btl_captcha')){
						self::ajaxResponse('$error$'.JText::_('INCORRECT_CAPTCHA'));
					}
				}else{
					self::ajaxResponse('$error$'.JText::_('INCORRECT_CAPTCHA'));
				}				
			}*/
		
			// Get the user data.
			// reset params form name in getVar function (not yet)
			$requestData ['name']= JRequest::getVar('name');
			$requestData ['username']= JRequest::getVar('username');
			$requestData ['password1']= JRequest::getVar('passwd1');
			$requestData ['password2']= JRequest::getVar('passwd2');
			$requestData ['email1']= JRequest::getVar('email1');
			$requestData ['email2']= JRequest::getVar('email2');

			// Save the data in the session.
			// may be use
			//$app->setUserState('com_users.registration.data', $requestData);
			 
			// Attempt to save the data.
			$return	=self::register($requestData);	
			if ($return === 'adminactivate'){
				self::ajaxResponse(JText::_('COM_USERS_REGISTRATION_COMPLETE_VERIFY'));
			} elseif ($return === 'useractivate') {
				self::ajaxResponse(JText::_('COM_USERS_REGISTRATION_COMPLETE_ACTIVATE'));		
			} else {
				self::ajaxResponse(JText::_('COM_USERS_REGISTRATION_SAVE_SUCCESS'));	
			}
		}else{
			//self::ajaxResponse(self::createCaptcha());
		}
	}
	public static function ajaxResponse($message){
		$obLevel = ob_get_level();
		if($obLevel){
			while ($obLevel > 0 ) {
				ob_end_clean();
				$obLevel --;
			}
		}else{
			ob_clean();
		}
		echo $message;
		die;
	}
    public static function register($temp)
	{ 
		$config = JFactory::getConfig();
		$db		= JFactory::getDbo();
		$params = JComponentHelper::getParams('com_users');
		
		// Initialise the table with JUser.
		$user = new JUser;
		
		// Merge in the registration data.
		foreach ($temp as $k => $v) {
			$data[$k] = $v;
		}

		// Prepare the data for the user object.
		$data['email']		= $data['email1'];
		$data['password']	= $data['password1'];
		$useractivation = $params->get ( 'useractivation' );
		
		// Check if the user needs to activate their account.
		if (($useractivation == 1) || ($useractivation == 2)) {
			$data ['activation'] = JApplication::getHash ( JUserHelper::genRandomPassword () );
			$data ['block'] = 1;
		}
		$system	= $params->get('new_usertype', 2);
		$data['groups'] = array($system);
		
		// Bind the data.
		if (! $user->bind ( $data )) {
			self::ajaxResponse('$error$'.JText::sprintf ( 'COM_USERS_REGISTRATION_BIND_FAILED', $user->getError () ));
		}
		
		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		// Store the data.
		if (!$user->save()) {
			self::ajaxResponse('$error$'.JText::sprintf('COM_USERS_REGISTRATION_SAVE_FAILED', $user->getError()));
		}

		// Compile the notification mail values.
		$data = $user->getProperties();
		$data['fromname']	= $config->get('fromname');
		$data['mailfrom']	= $config->get('mailfrom');
		$data['sitename']	= $config->get('sitename');
		$data['siteurl']	= str_replace('modules/mod_jmlogin/','',JURI::root());
		
		// Handle account activation/confirmation emails.
		if ($useractivation == 2)
		{
			// Set the link to confirm the user email.					
			$data['activate'] = $data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'];
			
			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username'],
				$data['password_clear']
			);
			
		}
		elseif ($useractivation == 1)
		{
			// Set the link to activate the user account.						
			$data['activate'] = $data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'];
			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);
			

			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username'],
				$data['password_clear']
			);

		} else {

			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl']
			);
		}

		// Send the registration email.
		$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);
		
		//Send Notification mail to administrators
		if (($params->get('useractivation') < 2) && ($params->get('mail_to_admin') == 1)) {
			$emailSubject = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_BODY',
				$data['name'],
				$data['sitename']
			);

			$emailBodyAdmin = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_NOTIFICATION_TO_ADMIN_BODY',
				$data['name'],
				$data['username'],
				$data['siteurl']
			);

			// get all admin users
			$query = 'SELECT name, email, sendEmail' .
					' FROM #__users' .
					' WHERE sendEmail=1';

			$db->setQuery( $query );
			$rows = $db->loadObjectList();

			// Send mail to all superadministrators id
			foreach( $rows as $row )
			{
				JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBodyAdmin);

				// Check for an error.
				if ($return !== true) {
					//echo(JText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
				}
			}
		}
		// Check for an error.
		if ($return !== true) {
			//echo (JText::_('COM_USERS_REGISTRATION_SEND_MAIL_FAILED'));
			// Send a system message to administrators receiving system mails
			$db = JFactory::getDBO();
			$q = "SELECT id
				FROM #__users
				WHERE block = 0
				AND sendEmail = 1";
			$db->setQuery($q);
			$sendEmail = $db->loadColumn();
			if (count($sendEmail) > 0) {
				$jdate = new JDate();
				// Build the query to add the messages
				$q = "INSERT INTO ".$db->quoteName('#__messages')." (".$db->quoteName('user_id_from').
				", ".$db->quoteName('user_id_to').", ".$db->quoteName('date_time').
				", ".$db->quoteName('subject').", ".$db->quoteName('message').") VALUES ";
				$messages = array();

				foreach ($sendEmail as $userid) {
					$messages[] = "(".$userid.", ".$userid.", '".$jdate->toSql()."', '".JText::_('COM_USERS_MAIL_SEND_FAILURE_SUBJECT')."', '".JText::sprintf('COM_USERS_MAIL_SEND_FAILURE_BODY', $return, $data['username'])."')";
				}
				$q .= implode(',', $messages);
				$db->setQuery($q);
				$db->query();
			}
		}
	
		
		if ($useractivation == 1)
			return "useractivate";
		elseif ($useractivation == 2)
			return "adminactivate";
		else
			return $user->id;
	}		
	
 }
?>