$(window).ready(function(){
    frontPageEasycomment.init();    
});

var frontPageEasycomment = {
    currentUrl : '',
    iLimit : 0,
    init : function(){
        var sHtml = '';
        this.currentUrl = $("#easycomment_current_url").val();
        this.iLimit = $("#easycomment_limit").val()
        $("#easycomment_current_url").remove();
        $("#easycomment_limit").remove();
        
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
        frontPageEasycomment.execGenerateCaptcha();
        
    },execSaveComment : function(){

        var name = $("#easycomment_name");
        var comment = $("#easycomment_comment");
        var password = $("#easycomment_password");
        var captcha = $("#easycomment_captcha");
        var page_url = $("#easycomment_current_url");        
        var errors = 0;     

        if($.trim(name.val()).length==0){
            name.attr('style','border:solid 1px #DC4E22;');
            errors += 1;
        }else{
            name.attr('style','border:solid 1px #CCCCCC;');
        }

        if($.trim(comment.val()).length==0){
            comment.attr('style','border:solid 1px #DC4E22;');
            errors += 1;
        }else{
            comment.attr('style','border:solid 1px #CCCCCC;');
        }
        
        if($.trim(password.val()).length<5){
            password.attr('style','border:solid 1px #DC4E22;');
            errors += 1;
        }else{
            password.attr('style','border:solid 1px #CCCCCC;');
        }

        if($.trim(captcha.val()).length==0 || PG_Easycomment_front.sC!=captcha.val()){
            captcha.attr('style','border:solid 1px #DC4E22;');
            //errors += 1;
        }else{
            captcha.attr('style','border:solid 1px #CCCCCC;');
        }
        
        if(errors==0){
            var options = {
                url : usbuilder.getUrl('apiFrontSaveComment'),
                dataType : 'html',
                type : 'post',
                data : {
                    name : name.val(),
                    comment : comment.val(),
                    password : password.val(),
                    captcha : captcha.val(),
                    page_url : frontPageEasycomment.currentUrl
                },success : function(serverResponse){
                    alert(serverResponse)
                }                
            }
            
            $.ajax(options);
        }
        
    },execGenerateCaptcha : function(){
       
        var options = {
            url : usbuilder.getUrl('apiFrontCaptcha'),
            dataType : 'html',
            type : 'post',
            success : function(serverResponse){
               // alert(serverResponse)
            }
        }
        $.ajax(options);
    }
}