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
		$html='<select id="jform_params_theme_source" class="jm-field single" name="'.$this->name.'">';
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
    function getLayoutIni($file){
        $ini_array = parse_ini_file(JPATH_SITE . '/modules/mod_jmlogin/themes/default/'.$file);
    }
    
}

?>
<script>
jQuery(document).ready(function(){
    jmlogin_LayoutChange(jQuery('#jform_params_theme_source').val());
    jQuery('#jform_params_theme_source').change(function(){  
        jmlogin_LayoutChange(jQuery(this).val());
    });
           
})
function jmlogin_LayoutChange(layout){
    switch(layout){
        case 'default':
            <?php
                //$xmlobj = JFactory::getXMLParser('Simple');
                $orgdoc = new DOMDocument;
                $orgdoc->loadXML("<root><element><child>text in child</child></element></root>");
                $node = $orgdoc->getElementsByTagName("element")->item(0);
                $xml=simplexml_load_file(JPATH_SITE . '/modules/mod_jmlogin/themes/default/note.xml');
                //$xmlobj->loadFile($xml);
                 
            ?>
             break;
        case 'layout1':
                 <?php
                 //$xmlobj = JFactory::getXMLParser('Simple');
                $xml=simplexml_load_file(JPATH_SITE . '/modules/mod_jmlogin/themes/layout1/note1.xml');
               //$xmlobj->loadFile($xml);
                ?>
            break;
          case 'layout2':
                <?php
                //$xmlobj = JFactory::getXMLParser('Simple');
                $xml=simplexml_load_file(JPATH_SITE . '/modules/mod_jmlogin/themes/layout2/note2.xml');
                //$xmlobj->loadFile($xml);
                ?>
            break;
    }
}	

function jmlogin_LayoutChange1(layout){
    switch(layout){
        case 'default':
                <?php
                $ini_array = parse_ini_file(JPATH_SITE . '/modules/mod_jmlogin/themes/default/default.ini');
                foreach($ini_array as $key => $attrval){
                    $lbl=strtolower(str_replace('_',' ',$key));
                    $lbl=ucfirst(str_replace('JM','',$lbl));
                    $id_class=strtolower(str_replace(' ','_',$lbl));
                ?>
                    var attval='<?php echo $attrval;?>';
                    if(attval==''){
                        jQuery('#jform_params_<?php echo $id_class;?>').parent().parent('.control-group').css('display','none');
                        jQuery('#jform_params_<?php echo $id_class;?>').val('');
                    }else{
                        jQuery('#jform_params_<?php echo $id_class;?>').parent().parent('.control-group').css('display','block');
                    }
                <?php } ?>
             break;
        case 'layout1':
                 <?php
                $ini_array = parse_ini_file(JPATH_SITE . '/modules/mod_jmlogin/themes/layout1/layout1.ini');
                foreach($ini_array as $key => $attrval){
                    $lbl=strtolower(str_replace('_',' ',$key));
                    $lbl=ucfirst(str_replace('JM','',$lbl));
                    $id_class=strtolower(str_replace(' ','_',$lbl));
                ?>
                    var attval='<?php echo $attrval;?>';
                    if(attval==''){
                        jQuery('#jform_params_<?php echo $id_class;?>').parent().parent('.control-group').css('display','none');
                        jQuery('#jform_params_<?php echo $id_class;?>').val('');
                    }else{
                        jQuery('#jform_params_<?php echo $id_class;?>').parent().parent('.control-group').css('display','block');
                    }
                     
                <?php } ?>
            break;
          case 'layout2':
                 <?php
                $ini_array = parse_ini_file(JPATH_SITE . '/modules/mod_jmlogin/themes/layout2/layout2.ini');
                foreach($ini_array as $key => $attrval){
                    $lbl=strtolower(str_replace('_',' ',$key));
                    $lbl=ucfirst(str_replace('JM','',$lbl));
                    $id_class=strtolower(str_replace(' ','_',$lbl));
                ?>
                    var attval='<?php echo $attrval;?>';
                    if(attval==''){
                        jQuery('#jform_params_<?php echo $id_class;?>').parent().parent('.control-group').css('display','none');
                        jQuery('#jform_params_<?php echo $id_class;?>').val('');
                    }else{
                        jQuery('#jform_params_<?php echo $id_class;?>').parent().parent('.control-group').css('display','block');
                    }
                     
                <?php } ?>
            break;
    }
}
</script>
