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
$main = JFactory::getApplication();
$menu = $main->getMenu();
if ($load_jquery == 1) {
    $doc->addScript(JURI::base(true) . '/modules/mod_jmlogin/assets/js/jquery-1.8.3.js');
}
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/scrollbar.css');
$user = JFactory::getUser();
$name = !$user->guest;
?>
<script type="text/javascript">
var jm_login_base_url = '<?php print JURI::root(true);?>';
var modal_height='<?php echo $modal_height;?>';
</script>
<?php
    $jm_login_pre_text = $theme_data->jm_login_pre_text; 
    $jm_login_title =$theme_data->jm_login_title;
    $jm_login_button_text =$theme_data->jm_login_button_text;
    $jm_login_post_text =$theme_data->jm_login_post_text;
    $jm_login_connect_with =$theme_data->jm_login_connect_with;
    $jm_register_title =$theme_data->jm_register_title;
    $jm_register_button_text =$theme_data->jm_register_button_text;
?>  
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jquery.tinyscrollbar.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jmmodal.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jmtab.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jmlogin.js';?>"></script>
 
<!-- START Jm Login MODULE -->
<div class="jmlogins <?php echo $moduleclass_sfx; ?><?php echo $theme ? ' ' . $theme : '' ?>" id="jm-login-<?php print $module->id; ?>">
    <?php if ($name):  ?>
    <div id="jm-panel-loged-modules" class='jmlogin_dropdown_after'>
		<div class='jmlogin_username_wrap'> 
            <?php
            if($jmlogin_social_show_avatar):
            $user_picture=$session->get('user_id_picture');
            ?>
            <span style="float:left;">
                <img src="<?php if (!empty($user_picture)) { echo 'http://graph.facebook.com/'.$user_picture.'/picture?type=square';} else {echo JURI::root().'modules/mod_jmlogin/assets/images/noimage.png';}?>" alt="<?php echo $user->get('name');?>" style="width:50px; height:auto;background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #CCCCCC; display: block; margin: -4px 4px 4px 0; padding: 2px;">
            </span>
            <?php endif;?>
			<span class='jmlogin_username jm-login-link-modal'><?php echo ($name_display) ? JText::_('JM_GREETING').$user->name : JText::_('JM_GREETING').$user->username; ?>  <i class="fa fa-caret-down"></i></span>
		</div>
	</div>
    <?php else : ?>
    <div class="btn-jm-group" id="btn-action">
            <?php if($login_tab):?>
                <?php if($params->get( "display_type" ) == 1):?>
                <span id="jm-panel-login" class="<?php echo $display_type;?> jm-login-link-modal link-login"><i class="icon-user"></i><?php echo JText::_('JLOGIN');?></span>
                <?php else:?>
                <a id="jm-panel-login" class="jm-login-link-modal link-login" href="#jmmodal" data-tabid="#jmlogin" data-tab="jmtab" data-toggle="jmmodal"><i class="icon-user"></i><?php echo JText::_('JLOGIN');?></a>
                <?php endif;?>
            <?php endif;?>
            <?php if ($register_tab): 
                $option = JRequest::getCmd('option');
				$task = JRequest::getCmd('task');
				if($option!='com_user' && $task != 'register' ){
                ?>
                    <?php if($params->get( "display_type" ) == 1):?>
                    <span id="jm-panel-registration" class="<?php echo $display_type;?> jm-login-link-modal link-registet"><?php echo JText::_('JREGISTER');?></span>
                    <?php else:?>
                    <a id="jm-panel-registration" class="jm-login-link-modal link-registet" href="#jmmodal" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_('JREGISTER');?></a>
                    <?php endif;?>
            <?php }
             endif; ?>
        </div>
    <?php endif;?>
    <?php if ($name) : ?>
        <div id="jm-loged-wraper" class="btn-jm-group" > 
            <div id="jm-dropdown-loged">
                <?php if($loggedload): ?>
    			<div id="jm-module-position-profile">
    				<?php echo $loggedload; ?>
    			</div>
    			<?php endif; ?>
                <div class="jmlogin_form_logout">
                    <form class="form_logout" action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="POST" name="frmlogout">
                        <button name="Submit" class="btl-buttonsubmit jm-login-link-modal" onclick="document.frmlogout.submit();"><?php echo JText::_('JLOGOUT'); ?></button>
                        <input type="hidden" name="option" value="com_users" />
    					<input type="hidden" name="task" value="user.logout" />
                        <input type="hidden" name="return" value="<?php echo $return; ?>" />
                        <?php echo JHtml::_('form.token'); ?>
                    </form>
                </div>
             </div>
        </div>
		<div class='clear'></div>
    <?php endif; ?> 
        <?php if($params->get("display_type" ) == 1):?>
            <div id="tab-content-dropdown"  class="jm-dropdown-body jm-modal-dropdown" style="width:<?php echo $modal_width.'px';?>;">
            <?php 
                if($login_tab){
                    include("modules/mod_jmlogin/themes/".$theme."/login.php");  
                }
                if ($register_tab) {
                    include("modules/mod_jmlogin/themes/".$theme."/register.php");
                }
            ?>
            </div>
        <?php else:?>
            <div id="jmmodal" class="jm-tabs-content jmmodal" data-modalwidth="<?php echo $modal_width;?>"  data-modalclose="<?php echo $show_close_btn;?>" >
            <div id="jm-login-wrap">
                <div id="tab-content" class="jmmodal-body jm-modal-dropdown">
                
                    <?php 
                        if($login_tab){
                            include("modules/mod_jmlogin/themes/".$theme."/login.php");  
                        }
                        if ($register_tab) {
                            include("modules/mod_jmlogin/themes/".$theme."/register.php");
                        }
                    ?>
                </div>
            </div>		
            </div>
        
        <?php endif;?>
        
         
	<div class="jmtab_active"></div>
</div>
<!-- END Jm Login MODULE -->
<script type="text/javascript">
var jmOpt = 
{
	JM_AJAX					:'<?php echo addslashes(JURI::getInstance()->toString()); ?>',
	JM_RETURN				:'<?php echo addslashes($return_decode); ?>',
    CAPTCHA				    :'<?php echo $use_captcha ;?>',
    DISPLAY_TYPE            :'<?php echo $display_type ;?>',
    MOUSE_EVENT             :'<?php echo $mount_event ;?>',
}

</script>