$(window).ready(function(){
    frontPageEasycomment.init();    
});

var frontPageEasycomment = {
    currentUrl : '',
    init : function(){
        this.currentUrl = $("#easycomment_current_url").val();
        $("#easycomment_current_url").remove(); 
        
    },execSaveComment : function(){
        alert(this.currentUrl)
    }
}