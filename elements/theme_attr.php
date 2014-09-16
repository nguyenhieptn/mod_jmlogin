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
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

$jmversion = new JVersion;

?>
<script type="text/javascript">
	var JAFileConfig = window.JAFileConfig || {};
	JAFileConfig.profiles = <?php echo json_encode($jsonData)?>;
	JAFileConfig.mod_url = '<?php echo JURI::root() , '/', $extpath; ?>/admin/jmtheme/helper.php';
	JAFileConfig.langs = <?php echo json_encode(array(
		'confirmCancel' => JText::_('ARE_YOUR_SURE_TO_CANCEL'),
		'enterName'	=> JText::_('ENTER_PROFILE_NAME'),
		'invalidName' => JText::_('PROFILE_NAME_NOT_EMPTY'),
		'confirmDelete' => JText::_('CONFIRM_DELETE_PROFILE')
	))?>;
	
	JAFileConfig.inst = null;

	window.addEvent('load', function(){
		JAFileConfig.inst = new JAProfileConfig('jformparams<?php echo str_replace('holder', '', $this->fieldname);?>');
		JAFileConfig.inst.changeProfile($('jformparams<?php echo str_replace('holder', '', $this->fieldname);?>').value);
	});
</script>

<div class="ja-profile">	
	<?php echo $HTML_Profile?>
	<div class="profile_action">
	
	</div>
</div>

<?php if($jmversion->isCompatible('3.0')) : ?>
	</div>
</div>
<?php else : ?>
</li>
<?php endif; ?>


<?php		
$fieldSets = $paramsForm->getFieldsets('params');

foreach ($fieldSets as $name => $fieldSet) :
	if (isset($fieldSet->description) && trim($fieldSet->description)){
		echo '<p class="tip">'.JText::_($fieldSet->description).'</p>';
	}
	
	$hidden_fields = '';
	foreach ($paramsForm->getFieldset($name) as $field) :
		if (!$field->hidden): 
			if($jmversion->isCompatible('3.0')) : ?>
				<div class="control-group">
					<div class="control-label">
			<?php else: ?> 
				<li>
			<?php endif;
				echo $paramsForm->getLabel($field->fieldname,$field->group);
			
				if($jmversion->isCompatible('3.0')) : ?>
					</div>	
					<div class="controls">
				<?php endif;
					echo $paramsForm->getInput($field->fieldname,$field->group);
				
				if($jmversion->isCompatible('3.0')) : ?>
					</div>
				</div>
				<?php else: ?> 
					</li>
				<?php endif;

		else : 
			$hidden_fields .= $paramsForm->getInput($field->fieldname,$field->group);	
		endif;
	endforeach;
	echo $hidden_fields; 
endforeach; 
?>	

<?php 
	if($jmversion->isCompatible('3.0')) : ?>
		<div class="control-group hide">
			<div class="control-label"></div>
				<div class="controls">
	<?php else: ?> 
		<li>
	<?php endif; ?>
<script type="text/javascript">
    
	// <![CDATA[ 
	window.addEvent('load', function(){  
	    jmlogin_LayoutChange(jQuery('#jformparamstheme').val());
        jQuery('#jformparamstheme').change(function(){  
            jmlogin_LayoutChange(jQuery(this).val());
        });
        
		Joomla.submitbutton = function(task){  
		      var layout=jQuery('#jformparamstheme').val();
		    <?php
                foreach($jsonData as $key => $jd){
                    ?>
                    if(layout=='<?php echo $key?>'){
                        <?php
                        foreach($jd as $k => $v){
                            if($v<>''){
                                ?>
                                if(jQuery('#jmform_params_<?php echo $k;?>').val()==''){
                                    var lbl_text=jQuery('#jmform_params_<?php echo $k;?>').parent().prev().children('label').html();
                                    alert(lbl_text+' is required');
                                    return false;
                                }
                                <?php
                            } 
                        }
                        ?>
                    }
                    <?php
                }
                ?>  
			if (task == 'module.cancel' || document.formvalidator.isValid(document.id('module-form'))) {	 
				if(task != 'module.cancel' && document.formvalidator.isValid(document.id('module-form'))){ 
					JAFileConfig.inst.saveProfile(task);
				}else if(task == 'module.cancel' || document.formvalidator.isValid(document.id('module-form'))){
					Joomla.submitform(task, document.getElementById('module-form'));
				}
				if (self != top) {
					window.top.setTimeout('window.parent.SqueezeBox.close()', 1000);
				}
			} else {
				alert('Invalid form');
			}
		}
	});
	// ]]> 
  

function jmlogin_LayoutChange(layout){  
    <?php
    foreach($jsonData as $key => $jd){
        ?>
        if(layout=='<?php echo $key?>'){
            <?php
            foreach($jd as $k => $v){
                if($v==''){
                    ?>
                    jQuery('#jmform_params_<?php echo $k;?>').parent().parent('.control-group').css('display','none');
                    <?php
                }else{
                    ?>
                    jQuery('#jmform_params_<?php echo $k;?>').parent().parent('.control-group').css('display','block');
                    <?php
                }
            }
            ?>
            
        }
        <?php
    }
    ?>
    
}
</script>
