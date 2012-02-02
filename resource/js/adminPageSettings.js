var adminPageSettings = {
    execSave : function(){
        $("#easycomment_color_picker").remove();
        document.easycomment_settings_form.submit();

    },execHideShow : function(status){
        if(status=='up'){
            $("#easycomment_custom_area").hide();
            $("#easycomment_down").hide();
            $("#easycomment_up").show();
            
        }else{
            $("#easycomment_custom_area").show();
            $("#easycomment_down").show();
            $("#easycomment_up").hide();          
        }
    },execColorPicker : function(element){

        $("#admin_popup_contents").remove();
        
        $("#color_picker_area").html("<div id='easycomment_color_picker' title='Select Color'><div class='admin_popup_contents'><div id='easycomment_cp_canvas' name='easycomment_cp_canvas'></div></div></div>");

        popup.load('easycomment_color_picker').skin('admin').layer({
            'title' : 'Color Picker',
            'width' : 195,
            'classname': 'ly_set ly_editor',
            'closeCallback' : function(){
                $("#color_picker_area").empty();
            }
        });
        
        $.farbtastic('#easycomment_cp_canvas', function(color){
            $("#"+element).val(color);
        }); 
    }
}