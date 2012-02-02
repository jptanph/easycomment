var adminPageSettings = {
    execSave : function(){
        alert(1)
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
    }
}