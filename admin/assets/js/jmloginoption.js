jQuery.noConflict();
jQuery(document).ready(function($){
    var show_label=$('#jform_params_show_formlabel').val();
    var align=$('#jform_params_align_option').parent();
    if(show_label==1){
            $(align).parent().show();
        }else if(show_label==0){
            $(align).parent().hide();
        }
    $('#jform_params_show_formlabel').change(function(){
        var val=$(this).val();
        if(val==1){
            $(align).parent().show();
        }else if(val==0){
            $(align).parent().hide();
        }
    })
})