<?php

/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Login
  # Version 1.0.1
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */

// no direct access
define( '_JEXEC', 1 );
header('Content-Type: application/json');
define('DS', DIRECTORY_SEPARATOR);
define('JPATH_BASE', dirname(__FILE__) . DS . ".." . DS . "..");
require_once ( JPATH_BASE . DS . 'includes' . DS . 'defines.php' );
require_once ( JPATH_BASE . DS . 'includes' . DS . 'framework.php' );
$app = JFactory::getApplication('site');
$app->initialise();
jimport( 'joomla.application.module.helper' );
$module = &JModuleHelper::getModule('mod_jmlogin');
$moduleParams = json_decode($module->params);
$type=  JRequest::getVar('type');
$info= JRequest::getVar('info');
$user=  JRequest::getVar('user');
$repassword=  JRequest::getVar('repassword');

if(!empty($type) && !empty($info)){
    $data=array();
    $val= checkinfo($info, $type);
    if(!empty($val)){
        $data['status']='failed';
        if($type=='username'){
           $data['error']=$moduleParams->error_existing_username_register; 
        }elseif ($type=='email') {
            $data['error']=$moduleParams->error_existing_email_register;
        }
    }else{
        $data['status']='ok';
    }
     print json_encode($data);
    exit;

}elseif(!empty ($repassword)){
    $data=array();
    $val=repassword($user,$type);
    if(empty($val)){
        $data['status']='failed';
        if($type=='username'){
           $data['error']=$moduleParams->mess_account_not_exists_regainpass; 
        }elseif ($type=='email') {
            $data['error']=$moduleParams->mess_check_mail_regainpass;
        }
    }else{
        $data['status']='ok';
    }
     print json_encode($data);
    exit;
}
function checkinfo($info,$type){
    $db=  JFactory::getDbo();
    $query="select id from #__users where {$type}='{$info}'";
    $db->setQuery($query);
    return $db->loadResult();
    //return (string)$query;
}

function repassword($user,$type){
    $db=JFactory::getDbo();
    $query="select id from #__users where {$type}='{$user}'";
    $db->setQuery($query);
    return $db->loadResult();
}