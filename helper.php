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
jimport( 'joomla.user.user' );
jimport ('joomla.user.helper');
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
    public static $messages = array();
    function getLogin($params) {
        $activation = JRequest::getVar('activation');
        if ($activation) {
            $this->confirmEmail($activation);
        }
    }
    function loadScriptJtext(){
        JText::script('JM_LOGIN_AUTHENTICATE'); 
        JText::script('JM_REQUIRED_NAME'); 
        JText::script('JM_REQUIRED_USERNAME'); 
        JText::script('JM_REQUIRED_PASSWORD'); 
        JText::script('JM_REQUIRED_CONFIRM_PASSWORD'); 
        JText::script('JM_PASSWORD_NOT_MATCH'); 
        JText::script('JM_REQUIRED_EMAIL'); 
        JText::script('JM_EMAIL_INVALID'); 
        JText::script('JM_REQUIRED_CONFIRM_EMAIL'); 
        JText::script('JM_EMAIL_NOT_MATCH'); 
        JText::script('JM_CAPTCHA_REQUIRED');
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

public static function jmajax(){
		$mainframe =& JFactory::getApplication('site');
		$jmtask = JRequest::getVar('jmtask');
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
			$captcha=JRequest::getVar('captcha');
			if($captcha=='yes'){
				if(JRequest::getString('jm_captcha')){
					$session = JFactory::getSession();
					echo $session->get('jm_captcha');
					if(JRequest::getString('jm_captcha') != $session->get('jm_captcha')){
						self::ajaxResponse('error_capt'.JText::_('INCORRECT_CAPTCHA'));
					}
				}else{
					self::ajaxResponse('error_capt'.JText::_('INCORRECT_CAPTCHA'));
				}				
			}
		
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
			self::ajaxResponse(self::createCaptcha());
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
    public static function createCaptcha(){
    		$session = JFactory::getSession();
    		$oldImages = glob(JPATH_ROOT . '/modules/mod_jmlogin/assets/captcha/*.png');
    		if($oldImages){
    			foreach($oldImages as $oldImage){
    				if(file_exists($oldImage)){
    					unlink($oldImage);
    				}
    			}
    		}	
    		
    		$imagePath = base64_encode($session->getId() . time()). '.png';
    		$session->set('jm_captcha_image_path', $imagePath);
    		
    		$image = imagecreatetruecolor(130, 40) or die("Cannot Initialize new GD image stream");
    		$background_color = imagecolorallocate($image, 255, 255, 255);
    		$text_color = imagecolorallocate($image, 0, 255, 255);
    		$line_color = imagecolorallocate($image, 64, 64, 64);
    		$pixel_color = imagecolorallocate($image, 0, 0, 255);
    		imagefilledrectangle($image, 0, 0, 200, 50, $background_color);
    		
    		//create 3 lines
    	
    		//random dots
            $border = imagecolorallocate($image, 0, 0, 0);
            $fill = imagecolorallocate($image, 205, 206, 207);
            imagefilltoborder($image, 50, 50, $border, $fill);
            
          /*  for ($i = 0; $i < 3; $i++) {
    			//imageline($image, 0, rand() % 50, 200, rand() % 50, $line_color);
                imageline($image,0,rand()%50,200,rand()%45, $line_color);
    		}*/
            
    		for ($i = 0; $i < 1000; $i++) {
    		//imagesetpixel($image, rand() % 200, rand() % 50, $pixel_color);
             
    		}
            
    		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    		$len = strlen($letters);
    		
    		$text_color = imagecolorallocate($image,64,64,64);
    		$word = "";
    		for ($i = 0; $i < 6; $i++) {
    			$letter = $letters[rand(0, $len - 1)];
    			imagestring($image, 5, 5 + ($i * 20), 12, $letter, $text_color);
    			$word .= $letter;
    		}
    		$session->set('jm_captcha', $word);
     
    		if(!file_exists(JPATH_ROOT . "/modules/mod_jmlogin/captcha")){
    			mkdir(JPATH_ROOT . "/modules/mod_jmlogin/captcha");
    		}
    		
    		imagepng($image, JPATH_ROOT . '/modules/mod_jmlogin/captcha/' . $imagePath);
    		return JURI::root(). 'modules/mod_jmlogin/captcha/' . $imagePath;
    }
    public static function getCaptcha(){
            $html = '<span id="jm-captcha-reload" title="' . JText::_('JM_RELOAD_CAPTCHA') . '"><i class="fa fa-refresh"></i></span>
                    <img id="captchar-img" src="' . self::createCaptcha() .'" alt=""/>
    				<input type="text" name="jm_captcha" class="inputbox" id="jm-captcha" size="10"/>
                    <div style="clear:both"></div>
    				';
    	return $html;
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
    // get module
    public static function getModules($params) {
		$user =  JFactory::getUser();
		if ($user->get('guest')) return '';
		
		$document = JFactory::getDocument();
		$moduleRender = $document->loadRenderer('module');
		$positionRender = $document->loadRenderer('modules');
		
		$html = '';
		
		$db = JFactory::getDbo();
		$i=0;
		$module_id = $params->get('module_id', array());
		if (count($module_id) > 0) {
			$sql = "SELECT * FROM #__modules WHERE id IN (".implode(',', $module_id).") ORDER BY ordering";
			$db->setQuery($sql);
			$modules = $db->loadObjectList();
			foreach ($modules as $module) {
				
				if ($module->module != 'mod_jmlogin') {
					$i++;
					$html = $html . $moduleRender->render($module->module, array('title' => $module->title, 'style' => 'xhtml'));
				}
			}
		}	
		$module_position = $params->get('module_position', array());
		if (count($module_position) > 0) {
			foreach ($module_position as $position) {
				$modules = JModuleHelper::getModules($position);
				foreach ($modules as $module) {
					if ($module->module != 'mod_jmlogin') {
						$i++;
						$html = $html . $moduleRender->render($module, array('style' => 'xhtml'));
					}
				}
			}
		}
		if ($html==''){
			$html= $moduleRender->render('mod_menu',array('title'=>'User Menu','style'=>'xhtml'));
		}
		return $html;
	}
    // load config ini file
    public function loadlThemeData($params)
    {
        $theme = $params->get('theme','default');
        $ini_file = JPATH_ROOT . DS . "modules" . DS . 'mod_jmlogin' . DS . "themesattr" . DS . $theme . ".ini";
        $theme_data = "";
        if (file_exists($ini_file)) {
            $theme_data = json_decode(JFile::read($ini_file));
        }
        return $theme_data;
         
    }
    public static function getfb_popup($app_id,$callback_url){
        $popup_url = "http://www.facebook.com/dialog/oauth?client_id=" 
		  . $app_id . "&redirect_uri=" . urlencode($callback_url) . "&state=fb&display=popup&scope=email,user_birthday,user_location,email,user_website,user_photos,user_hometown,user_about_me";
         return $popup_url;
    }
    public static function deniedRequest(){
		if(isset($_REQUEST['state']) && (isset($_REQUEST['denied']) || isset($_REQUEST['error']))){
			echo '<script type="text/javascript"> window.close();</script>';
			exit;
		}
	}
    public static function getOpenerUrl($curent_url){
		$indexOfSubString = strpos($curent_url,"&state");
   		if($indexOfSubString == 0){
   			$indexOfSubString = strpos($curent_url,"?state");
   		}
   		if($indexOfSubString!=0){
   		 	$callback_url = substr($curent_url,0,$indexOfSubString);
   		}
   		return $callback_url;
	}
    public static function getTokenUrl($appfb_id,$callback_url,$appfb_secret,$code){
		 return "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $appfb_id . "&redirect_uri=" . urlencode($callback_url)
       . "&client_secret=" . $appfb_secret ."&code=" . $code;
	}	
	public static function curlResponse($url,$data = null){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
		if($data){
			curl_setopt($ch,CURLOPT_POST, true);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
		}
		$response = curl_exec($ch);
		if (curl_errno($ch) == 60 && substr_count($url,'facebook')>0) { 
			// CURLE_SSL_CACERT
			curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/assets/facebook/fb_ca_chain_bundle.crt');
			$response = curl_exec($ch);
		}
		if(curl_errno($ch))
		{
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			$response = curl_exec($ch);
		}
		curl_close($ch);
		return $response;
	}
    public static function prepareData($user,$type){
		$data = array();
        $session = JFactory::getSession();
		switch($type){
			case 'facebook': 
                if (!empty($user->first_name) && !empty($user->last_name)) {
            	    $username = $user->first_name.$user->last_name;
            	    $name = $user->first_name;
         	    }else {
       	            $username = $user->email;
       	            $name = $user->id;
         	    }
				$data ['id'] = $user->id;
				$data ['name'] = $name;
				$data ['username'] =  $username;
				$data ['email'] =  $user->email;
				$data ['link'] = $user->link;
				$data ['location'] = isset($user->location->name)? $user->location->name:'';
				$data ['hometown'] = isset($user->hometown->name)? $user->hometown->name:'';
				$data ['website'] =  isset($user->website)? $user->website:'';
				$data ['bio'] = isset($user->bio)? $user->bio:'';
				$data ['quotes'] = isset($user->quotes)? $user->quotes:'';
				$data ['birthday'] = isset($user->birthday)? $user->birthday:'';
			break;
			case 'google': 
				$data ['id'] = $user->id;
				$data ['name'] = $user->name;
				list($data ['username']) = explode('@',$user->email);
				$data ['email'] = $user->email;
				$data ['link'] = $user->link;
				$data ['birthday'] = isset($user->birthday)? $user->birthday:'';
				//$data ['picture'] = isset($user->picture)? $user->picture:'';
			break;
			case 'twitter':
				$data ['id'] = $user->id;
				$data ['name'] = $user->name;
				$data ['email'] =  $user->screen_name.'@twitter.com';
				$data ['username'] =  $user->screen_name;
				$data ['location'] = isset($user->location)? $user->location:'';
				//$data ['picture'] = isset($user->profile_image_url)? $user->profile_image_url:'';
				$data ['website'] = $user->url;
				$data ['link'] = 'https://twitter.com'.$user->screen_name;
				$data ['status'] = isset($user->status->text)? $user->status->text:'';
				$data ['bio'] = isset($user->description)? $user->description:'';
			break;
		}
        $session->set('user_id_picture',$user->id);
		$data['loginType'] = $type;
		$data['rawData'] = serialize($user);
		return $data;
	}
     
    public static function assignProfile($user) {
	       
		$data = array ();
		$data ['name'] = $user['name'];
		$data ['username'] = $user['username'];
		$data ['email'] = $user['email'];
		$data ['socialId'] = $user['id'];
		$data ['loginType'] = $user['loginType'];
		$data ['rawData'] = $user['rawData'];
		$password = uniqid();
		$data ['password1'] = $password;
		$data ['password2'] = $password;
		// set value for profile fields
		$data['profile'] = array ();
     	return $data;
	}
    
    public static function generalUser($user){
        $db = JFactory::getDBO();
        $query = "SELECT id FROM #__users WHERE email='".$user['email']."'";
        $db->setQuery($query);
        $user_id = $db->loadResult(); 
        if (empty($user_id)) { 
           // jimport ('joomla.user.helper');
            $newuser = new JUser;
            //$user = JFactory::getUser(0);
            $name=modJmloginHelper::remove_unescapedChar($user['name']);
            $username=modJmloginHelper::remove_unescapedChar($user['username']);
            $usersConfig = JComponentHelper::getParams( 'com_users' );
            $defaultUserGroups = $usersConfig->get('new_usertype', 2);
    	    if (empty($defaultUserGroups)) {
              $defaultUserGroups = 'Registered';
            } 
            $userdata = array ();
    	    $userdata ['name'] = $db->escape($name);
            $userdata ['username'] = $db->escape($username);
            $userdata ['email'] = $user['email'];
            $userdata ['usertype'] = 'deprecated';
            $userdata ['groups'] = array($defaultUserGroups);
            $userdata ['registerDate'] = JFactory::getDate ()->toSql ();
            $userdata ['password'] = JUserHelper::genRandomPassword ();
            $userdata ['password2'] = $userdata ['password'];
    		$useractivation = $usersConfig->get( 'useractivation' );
            if (!$newuser->bind ($userdata)) {
              JError::raiseWarning ('', JText::_ ('COM_USERS_REGISTRATION_BIND_FAILED'));
              return false;
            }
    		//Save the user
            if (!$newuser->save()) {
              JError::raiseWarning ('', JText::_ ('COM_USERS_REGISTRATION_SAVE_FAILED'));
              return false;
            } 
        }
    }
    public static function remove_unescapedChar($str) {
	   $in_str = str_replace(array('<', '>', '&', '{', '}', '*', '/', '(', '[', ']' , '@', '!', ')', '&', '*', '#', '$', '%', '^', '|','?', '+', '=','"',','), array(''), $str);
	   $cur_encoding = mb_detect_encoding($in_str) ;
       if($cur_encoding == "UTF-8" && mb_check_encoding($in_str,"UTF-8"))
         return $in_str;
       else
         return utf8_encode($in_str);
    }
    public static function checkUser($user){ 
		if($user['socialId']==''){
			modJmloginHelper::response('Could not get user data. Please try again later.');
		}
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select("email,block,activation");
		$query->from("#__users");
		$query->where ( 'email=' . $db->quote ( $user['email'] ) );
		$db->setQuery ($query);
		
		$user = $db->loadObject();
		if($user){  
			if($user->block==1){
				if($user->activation){
					self::unblockUser($user->email);
					self::loginSocial($user->email);
					self::reloadParent();
				}else{
					self::response('User block');
				}
			}else{
				self::loginSocial($user->email);
				self::reloadParent();
			}
		}
	}
    public static function unblockUser($email) {
		$db = JFactory::getDbo ();
		$query = 'UPDATE `#__users` SET `block` ="0" , `activation` = "" WHERE `email`="' . $email . '"';
		$db->setQuery ( $query );
		$db->query();
	}
    public static function loginSocial($email) { 
		$db = JFactory::getDbo ();
		$app = JFactory::getApplication ();
		
	 	$sql = "SELECT * FROM #__users WHERE email = " . $db->quote ( $email );
		$db->setQuery ( $sql );
		$result = $db->loadObject ();
		
		$jUser = JFactory::getUser ( $result->id );
		$instance = $jUser;
		$instance->set ( 'guest', 0 );
		// Register the needed session variables
		$session = JFactory::getSession();
		$session->set ( 'user', $jUser );
		// Check to see the the session already exists.                        
		$app->checkSession ();
		
		$db->setQuery ( 'UPDATE ' 
			. $db->quoteName ( '#__session' ) 
			. ' SET ' . $db->quoteName ( 'guest' ) 
			. ' = ' 
			. $db->quote ( $instance->get ( 'guest' ) ) 
			. ',' . '   ' 
			. $db->quoteName ( 'username' ) 
			. ' = ' . $db->quote ( $instance->get ( 'username' ) ) 
			. ',' . '   ' 
			. $db->quoteName ( 'userid' ) 
			. ' = ' 
			. ( int ) $instance->get ( 'id' ) 
			. ' WHERE ' . $db->quoteName ( 'session_id' ) . ' = ' . $db->quote ( $session->getId () ) );
		$db->query (); 
		
		// Hit the user last visit field
		$instance->setLastVisit ();
	} 
    public static function reloadParent(){  
		$alert = '';
		if(count(self::$messages)) $alert = "alert('".addslashes(implode("\n",self::$messages))."');";
		echo '<script type="text/javascript">'.$alert.'window.opener.location.href=window.opener.jmOpt.JM_RETURN; window.close();</script>';
		exit;
	}
 }
?>