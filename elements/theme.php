<?php
/*
#------------------------------------------------------------------------
# Package - JoomlaMan JMLogin
# Version 1.0
# -----------------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
# @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
# Websites: http://www.JoomlaMan.com
#------------------------------------------------------------------------
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
class JFormFieldTheme extends JFormField {
protected $type = 'Theme'; //the form field type
	    var $options = array();
	    
	    protected function getInput() {
	    $extpath = $this->element['extpath'];	
		JHtml::_('script', $extpath . '/elements/japrofile.js');
		JHtml::_('stylesheet', $extpath . '/elements/japrofile.css');   
        $jsonData = array();
		$folder_profiles = array();
		$profiles = array();
		$jsonData = array();
        // get in module
        jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');
		$path = JPATH_SITE . DIRECTORY_SEPARATOR . $extpath . DIRECTORY_SEPARATOR . 'themesattr';
		if (!JFolder::exists($path)){
			return JText::_('PROFILE_FOLDER_NOT_EXIST');
		}
		$files = JFolder::files($path, '.ini');
		if ($files) {
			foreach ($files as $fname) {
				$fname = substr($fname, 0, -4);

				$f = new stdClass();
				$f->id = $fname;
				$f->title = $fname;

				$profiles[$fname] = $f;
				
				$params = new JRegistry(JFile::read($path . DIRECTORY_SEPARATOR . $fname . '.ini'));
				$jsonData[$fname] = $params->toArray();
			}
		}
         
        
        $xmlparams = JPATH_SITE . DIRECTORY_SEPARATOR . $extpath . DIRECTORY_SEPARATOR . 'admin/jmtheme/config.xml';
		if (file_exists($xmlparams)) {
			/* For General Form */
			$options = array('control' => 'jmform');
			$paramsForm = JForm::getInstance('jform', $xmlparams, $options);

			$HTML_Profile = JHTML::_('select.genericlist', $profiles, '' . $this->name, 'style="width:150px;"', 'id', 'title', $this->value);
			ob_start();
				require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'theme_attr.php';
				$content = ob_get_clean();		
			 
			return $content;
		}
		 
	}
	function getTemplate(){
		$db=JFactory::getDBO();
		$query=$db->getQuery(true);
		$query->select('*');
		$query->from('#__template_styles');
		$query->where('home=1');
		$query->where('client_id=0');
		$db->setQuery($query);
		return $db->loadObject()->template;
	}
    
}
 
