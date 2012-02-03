$(window).ready(function(){
    frontPageEasycomment.init();    
});

var frontPageEasycomment = {
    currentUrl : '',
    init : function(){
        var sHtml = '';
        this.currentUrl = $("#easycomment_current_url").val();
        $("#easycomment_current_url").remove();
        
        var options = {
            url : usbuilder.getUrl('apiFrontComments'),
            dataType : 'json',
            type : 'post',
            data : {
                
            },success : function(serverResponse){
                
                if(serverResponse.Data){
                    
                    $.each(serverResponse.Data,function(index,value){
                        sHtml += "<li>\n";
                        sHtml += "  <div class='date_author_info' style='background-color:red'><a class='author' style='color:blue'>" +  value.visitor_name + "</a><a href='#none' class='date' style='color:blue'>" + value.date_posted + "</a><a alt='Delete Comment' title='Delete Comment' class='delete_icon' style='display:none;' ><span>Delete Comment</span></a></div>\n";
                        sHtml += "  <p class='sdk_easycomment_text' style='color:brown'>\n";
                        sHtml += value.visitor_comment;
                        sHtml += "  </p>\n";
                        sHtml += "  <div class='delete_comment' style='display:none;'>\n";
                        sHtml += "      <p>Enter Password:</p> \n";
                        sHtml += "      <input type='password' />\n";
                        sHtml += "      <p class='expandable_btn' style='border-bottom:none;display:visible;'><a href='#none'><span>Delete</span></a></p>\n";
                        sHtml += "  </div>\n";
                        sHtml += "</li>\n";                         
                    });                                      
                }
                
                
                $("#easycomment_main_comments").html(sHtml);
            }
        }
        
        $.ajax(options);
        
    },execSaveComment : function(){
        oValidator.formName.getMessage('test_form')
        alert(this.currentUrl)
    }
}