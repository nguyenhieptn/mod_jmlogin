<?php
/**
 * ------------------------------------------------------------------------
 * JA News Pro Module for J25 & J32
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */


/**
 *
 * JAFileConfig helper module class
 * @author JoomlArt
 *
 */
class JAFileConfig
{
	/**
	 *
	 * save Profile
	 */
	public static function response($result = array()){
		die(json_encode($result));
	}

	public static function error($msg = ''){
		return self::response(array(
			'error' => $msg
			));
	}

	public static function save()
	{
		// Initialize some variables
		
		$theme = JRequest::getCmd('theme');
		if (!$theme) {
			return self::error(JText::_('INVALID_DATA_TO_SAVE_PROFILE'));
		}

		$params = new JRegistry;
		$post = $_POST;
		if (isset($post)) {
			foreach ($post as $k => $v) {
				$params->set($k, $v);
			}
		}

		$file = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'themesattr' . DIRECTORY_SEPARATOR . $theme . '.ini';
		if (JFile::exists($file)) {
			@chmod($file, 0777);
		}

		$data = $params->toString();
		if (!@JFile::write($file, $data)) {
			return self::error(JText::_('OPERATION_FAILED'));
		}

		return self::response(array(
			'successful' => sprintf(JText::_('SAVE_PROFILE_SUCCESSFULLY'), $theme),
			'theme' => $theme,
			'type' => 'new'
			));
	}

	 
}