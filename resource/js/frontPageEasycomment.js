$(window).ready(function(){
    frontPageEasycomment.init();    
});

var frontPageEasycomment = {
    currentUrl : '',
    init : function(){
    
        this.currentUrl = $("#easycomment_current_url").val();
        $("#easycomment_current_url").remove();    
    },test : function(){
        alert( this.currentUrl)
    }
}