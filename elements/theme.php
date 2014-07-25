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
	    $html=array();
	    $folder=array();
            $options = array();
	    $i=0;
	    	$html[]='<select class="jm-field single" name="'.$this->name.'">';
	    	if(is_dir(JPATH_SITE . '/modules/mod_jmlogin/themes/'))
	    	if ($handle = opendir(JPATH_SITE . '/modules/mod_jmlogin/themes/')) {
                    
		    while (false !== ($entry = readdir($handle))) {
		    	$files[$entry]=$entry;
                        
		    	if ($entry != "." && $entry != ".." &&$entry!="index.html"){
                            
		    		if($this->value==str_replace('.php','',$entry)) {
		    			$selected=" selected=true ";
		    			}
		    		else $selected="";
						//Parser layout name
						$theme_name = str_replace('.php','',$entry);
						$order = 9999;
						ob_start();
						readfile(JPATH_SITE . '/modules/mod_jmlogin/themes/' . $entry);
						$file_content = ob_get_clean();
                                                //var_dump($file_content); die;
						preg_match("'<!--layout:(.*?),order:(.*?)-->'si", $file_content, $match);
						if(isset($match[1])) $theme_name = $match[1];
						if(isset($match[2])) $order = $match[2];
						$option_html = '<option '.$selected.' value="'.str_replace('.php','',$entry).'">'.$theme_name.'</option>';
						$options[] = array('order'=>$order,'html'=> $option_html);
						//$html[]='<option '.$selected.' value="'.str_replace('.php','',$entry).'">'.$theme_name.'</option>';
			}
		    }
		    closedir($handle);
		}
		$orders = array();
		foreach($options as $key => $option){
			$orders[$key] = $option['order'];
		}
		array_multisort($orders, SORT_ASC, $options);
		$html='<select class="jm-field single" name="'.$this->name.'">';
		foreach($options as $option){
			$html .= $option['html'];
		}
		$html .= '</select>';
		return $html;
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
