$(window).ready(function(){
    frontPageEasycomment.init(); 
});

var frontPageEasycomment = {
    currentUrl : '',
    iLimit : 0,
    showDelete_idx : 0,
    clickDeleteIdx : 0,
    iFixedLimit : 0,
    init : function(){
        var sHtml = '';
        this.currentUrl = ( this.currentUrl) ?  this.currentUrl : $("#easycomment_current_url").val();
        this.iLimit = (this.iLimit ) ? this.iLimit : $("#easycomment_limit").val();
        this.iFixedLimit = ( this.iFixedLimit ) ?  this.iFixedLimit : $("#easycomment_limit").val();

        $("#easycomment_current_url").remove();
        $("#easycomment_limit").remove();
        var options = {
            url : usbuilder.getUrl('apiFrontComments'),
            dataType : 'json',
            type : 'post',
            data : {
                page_url : frontPageEasycomment.currentUrl,
                limit : this.iLimit
            },success : function(serverResponse){
                    
                if(serverResponse.Data.list){
                    $("#easycomment_per_comment").html(frontPageEasycomment.iLimit + '/' + serverResponse.Data.total_comment)
                    $.each(serverResponse.Data.list,function(index,value){
                        sHtml += "<li id='easycomment_list_comment" + value.idx + "' onmouseover='frontPageEasycomment.execShowDelete(" + value.idx + ")' onmouseout='frontPageEasycomment.execHideDelete(" + value.idx + ")'>\n";
                        sHtml += "  <div class='date_author_info' style='background-color:#royalblue'>";
                        sHtml += "		<a class='author' style='color:white'>" +  value.visitor_name + "</a>\n";
                        sHtml += "		<a href='#none' class='date' style='color:white'>" + value.date_posted + "</a>\n";
                        sHtml += "		<a href='#none' alt='Delete Comment' title='Delete Comment' id='easycomment_delete_link" + value.idx + "' class='delete_icon' style='display:none;' onclick='frontPageEasycomment.execDeleteComment(" + value.idx + ")' ><span>Delete Comment</span></a>";
                        sHtml += "		</div>\n";
                        sHtml += "  <p class='sdk_easycomment_text' style='color:black'>\n";
                        sHtml += value.visitor_comment;
                        sHtml += "  </p>\n";
                        sHtml += "<div class='delete_comment' style='display:none;' id='easycomment_delete_form" + value.idx + "'>\n";
                        sHtml += "  <p>Enter Password:</p>\n";
                        sHtml += "  <input type='password' id='easycomment_password" + value.idx + "' />\n";
                        sHtml += "  <p class='expandable_btn' style='border-bottom:none;display:visible;'><a href='#none' style='width:20px !important' onclick='frontPageEasycomment.execDelete(" + value.idx + ");'><span>Delete</span></a></p>\n";
                        sHtml += "</div>\n";
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
            name.attr('style','border:solid 2px #DC4E22;');
            errors += 1;
        }else{
            name.attr('style','border:solid 1px #CCCCCC;');
        }

        if($.trim(comment.val()).length==0){
            comment.attr('style','border:solid 2px #DC4E22;');
            errors += 1;
        }else{
            comment.attr('style','border:solid 1px #CCCCCC;');
        }
        
        if($.trim(password.val()).length<5){
            password.attr('style','border:solid 2px #DC4E22;');
            errors += 1;
        }else{
            password.attr('style','border:solid 1px #CCCCCC;');
        }

        if($.trim(captcha.val()).length==0 || PG_Easycomment_front.sC!=captcha.val()){
            captcha.attr('style','border:solid 2px #DC4E22;');
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
                    frontPageEasycomment.init();
                    name.val('');
                    comment.val('');
                    password.val('');
                    captcha.val('');                      
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
              
            }
        }
        $.ajax(options);
    },execLeaveMessage : function(){
        
        $("#easycomment_scrolling").attr('style','display:none !important');     
        $('div,#easycomment_holder').scrollTo( 
            $('#easycomment_comment'),
            1000,
            {onAfter:function(){ 
                $("#easycomment_scrolling").show();

            }}
        );
        $("#easycomment_comment").focus();
        $("#easycomment_comment").text('');
        
    },execShowDelete : function(comment_idx){
        $("#easycomment_delete_link"+comment_idx).show();
        this.showDeleteIdx = comment_idx;
    
    },execHideDelete : function(comment_idx){
        $("#easycomment_delete_link"+this.showDeleteIdx).hide();        
    },execDeleteComment : function(comment_idx){
//        
//        $("#easycomment_password"+comment_idx).attr('style','border:solid 1px #CCC;');
//        
//        $("#easycomment_delete_form"+comment_idx).show();
//        
//        if(comment_idx == this.clickDeleteIdx){
//            $("#easycomment_delete_form"+ comment_idx).show();            
//        }else{
//            $("#easycomment_delete_form"+ this.clickDeleteIdx).hide();            
//            
//        }
//        
//        this.clickDeleteIdx = comment_idx
//    
    
        
        $("#easycomment_password"+comment_idx).css({'border':'solid 1px #CCCCCC'});

        if(comment_idx!=this.clickDeleteIdx){
            $('#easycomment_delete_form'+this.clickDeleteIdx).slideUp(150);
        }
        $("#easycomment_delete_form"+comment_idx).toggle();
        this.clickDeleteIdx = comment_idx;
        $("#easycomment_password"+this.clickDeleteIdx).focus();
    
    
    
    
    },execDelete : function(idx){
        var password = $("#easycomment_password"+idx);
        $("#easycomment_password"+idx).attr('style','border:solid 1px #CCC;');
        var options = {
            url : usbuilder.getUrl('apiFrontDeleteComment'),
            dataType : 'json',
            type : 'post',
            data : {
                idx : idx,
                password : password.val()
            },success : function(serverResponse){
                if(serverResponse.Data=='deleted'){
                    $('#easycomment_list_comment'+idx).slideUp();
                    $('#easycomment_password'+idx).css({'border':'solid 1px #CCC'});
                }else{
                    $('#easycomment_password'+idx).css({'border':'solid 2px #DC4E22'});
                }
            }
        }
        $.ajax(options);
    
    },execLimitComment : function(){
        

        this.iLimit = parseInt(this.iLimit) + parseInt(this.iFixedLimit);

        this.init();
        
    }
}