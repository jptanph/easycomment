$(window).ready(function(){
    
    frontPageEasycomment.init();

});

var frontPageEasycomment = {
    currentUrl : '',

    iLimit : '',
    iSeq : 0,
    showDelete_idx : 0,
    clickDeleteIdx : 0,
    iFixedLimit : 0,
    viewIdx : [],
    cacheComment : [],
    bShowComment : false,
    init : function(){

        var sHtml = '';
        var sShowLimit = '';
        this.currentUrl = ( this.currentUrl) ?  this.currentUrl : $("#easycomment_current_url").val();
        
        this.iLimit = (this.iLimit) ? this.iLimit : $("#easycomment_limit").val();
        this.iFixedLimit = ( this.iFixedLimit ) ?  this.iFixedLimit : $("#easycomment_limit").val();
        this.iSeq = ( this.iSeq ) ? this.iSeq : $("#easycomment_seq").val();

//        $("#easycomment_seq").remove();
//        $("#easycomment_current_url").remove();
//        $("#easycomment_limit").remove();
        var options = {
            url : usbuilder.getUrl('apiFrontComments'),
            dataType : 'json',
            cache : false,
            type : 'post',
            data : {
                
                page_url : frontPageEasycomment.currentUrl,
                limit : frontPageEasycomment.iLimit,
                seq : frontPageEasycomment.iSeq
                
            },success : function(serverResponse){
                console.log(serverResponse)
                if(serverResponse){
                    
                    if(serverResponse.Data.total_comment < frontPageEasycomment.iLimit){
                        frontPageEasycomment.iLimit = serverResponse.Data.total_comment;
                        
                    }
                    
                   (frontPageEasycomment.iLimit>5) ? $("#easycomment_main_comments").css({'height':'370px'}) : '';
                  
               
                    if(serverResponse.Data.total_comment > 0){
                        $.each(serverResponse.Data.list,function(index,value){
    
                          sHtml += "            <li id='easycomment_list_comment" + value.idx + "' onmouseover='frontPageEasycomment.execShowDelete(" + value.idx + ")' onmouseout='frontPageEasycomment.execHideDelete(" + value.idx + ")'>";
                          sHtml += "                <div class='easycomment_author'  style='background:" + value.header_color + "'><span class='easycomment_author_name' style='color:" + value.htext_color + "'>" + value.visitor_name + "</span><span class='easycomment_date'>" + value.date_posted + "</span></div>";
                          if(value.user_type=='visitor'){
                              sHtml += "                <p class='easycomment_delete_icon' style='visibility:hidden !important;' id='easycomment_delete_link" + value.idx + "'><a href='#none' class='delete_link_right' onclick='frontPageEasycomment.execDeleteComment(" + value.idx + ")'></a></p>";
                          }
                          sHtml += "                <p class='easycomment_text' id='easycomment_users_comment" + value.idx + "' style='color:" + value.text_color + "'>";
                          sHtml += value.visitor_comment;
                          if(value.comment_length>300){
                            sHtml += "<br /><i class='{$sPrefix}see_more_comment_loader{$rows.ped_idx}' style='display:none'>loading..</i>";
                            sHtml += "  <a href='#none' onclick='frontPageEasycomment.execSeeMore(" + value.idx + ");' id='{$sPrefix}see_more_comment{$rows.ped_idx}' class='sdk_easycomment_see_more_comment'>See more.. </a>";
                          }
                          sHtml +="</p>";
                          sHtml += "                <div class='easycomment_delete_comment' style='display:none;' id='easycomment_delete_form" + value.idx + "'>\n";
                          sHtml += "                    <label>Password : </label><input type='password' id='easycomment_password" + value.idx + "' class='delete_li_password'/> <p class='expandable_btn' style='border-bottom:none;display:visible;' id='{$sPrefix}send'><a href='#none'  onclick='frontPageEasycomment.execDelete(" + value.idx + ");'><span>Delete</span></a></p>";
                          sHtml += "                </div>\n";
                          sHtml += "            </li>\n";
                        });
                        sHtml += "<li><div class='see_more_comment' style='display:none !important;'>\n";
                        sHtml +="    <span id='limit_option_area'><a href='#none' class='older_post' onclick='frontPageEasycomment.execLimitComment();'><span>Show Comment <span>"+frontPageEasycomment.iLimit + '/' + serverResponse.Data.total_comment+"</span></span></a></span></span>\n";
                        sHtml +="    <div class='loader_message'><img style='margin-top:5px' src='/_sdk/img/easycomment/small-loader.gif' /></div>\n";
                        sHtml +="</div></li>\n";
                    }else{
                        sHtml += "<li><div class='see_more_comment' style='display:none !important;'>\n";
                        sHtml +="    <span id='limit_option_area'><span style='color:#558DE2'>No comment.</span></span>\n";
                        sHtml +="</div></li>\n";
                        
                    }
                }
//                else{
//                    sHtml += "<li><div class='see_more_comment' style='display:none !important;'>\n";
//                    sHtml +="    <span id='limit_option_area'><span class='older_post_no_record'>No Comment.</span>\n";
//                    sHtml +="    <div class='loader_message'><img style='margin-top:5px'  src='/_sdk/img/easycomment/small-loader.gif' /></div>\n";
//                    sHtml +="</div></li>\n";
//                    $("#limit_option_area").append(sHtml)
//
//                }
                
                
                $("#easycomment_main_comments").html(sHtml);

                
                
                if ( $.browser.msie==true){
                      if( $.browser.version=='7.0' && frontPageEasycomment.iLimit>=5 && frontPageEasycomment.isIE9() == false) {
                          $('.delete_link_right').attr('style','margin-right:15px');
                      }
                }
                
                if(frontPageEasycomment.cacheComment.length>0){
                    
                    var total_comment = frontPageEasycomment.cacheComment.length;   
                    for(var i = 0 ; i < total_comment ; i++){
                        $('#easycomment_users_comment'+frontPageEasycomment.viewIdx[i]).html(frontPageEasycomment.cacheComment[i]);
                    }
                }
                $(".see_more_comment").fadeIn(250);
                $(".older_post").show();
                $(".loader_message").hide();
                $("#easycomment_add_comment").slideDown(300);
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
        var security = $("input[name='security']");
        var errors = 0;     

        if($.trim(name.val()).length==0){
            name.attr('style','border:solid 2px #DC4E22 !important;');
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

        if($.trim(captcha.val()).length==0){
            captcha.attr('style','border:solid 2px #DC4E22 !important;');
            errors += 1;
        }else{
            captcha.attr('style','border:solid 1px #CCCCCC;');
        }
        
        if(errors==0){
            var options = {
                url : usbuilder.getUrl('apiFrontSaveComment'),
                dataType : 'json',
                type : 'post',
                data : {
                    name : name.val(),
                    comment : comment.val(),
                    password : password.val(),
                    captcha : captcha.val(),
                    page_url : frontPageEasycomment.currentUrl,
                    security : security.val(),
                    seq : frontPageEasycomment.iSeq
                },success : function(serverResponse){
                    if(serverResponse.Data.status=='errorc'){
                        captcha.attr('style','border:solid 2px #DC4E22 !important;');
                    }else{
                      
                      name.val('');
                      comment.val('');
                      password.val('');
                      captcha.val('');                      
                      $('#easycomment_main_comments').animate({ scrollTop: 0 }, 500);
                      frontPageEasycomment.bShowComment = false;
                      frontPageEasycomment.init();
                    }

                }                
            }
            
            $.ajax(options);
        }
        
    },execGenerateCaptcha : function(){
       if(this.bShowComment==false){
           
            $('.input_captcha').realperson('destroy');
            $('.input_captcha').realperson({ 
                length: 6,
                includeNumbers: true,
                regenerate: '',
                hashName: 'security'
            });            
       }
           
    },execLeaveMessage : function(){
        
        $("#easycomment_scrolling").attr('style','display:none !important');     
        $('div,#easycomment_holder').scrollTo( 
            $('#easycomment_comment'),
            1000,
            {onAfter:function(){ 
                $("#easycomment_scrolling").show();

            }}
        );
        $("#easycomment_name").attr('style','border:solid 1px #CCCCCC;');
        $("#easycomment_comment").attr('style','border:solid 1px #CCCCCC;');
        $("#easycomment_password").attr('style','border:solid 1px #CCCCCC;');
        $("#easycomment_captcha").attr('style','border:solid 1px #CCCCCC;');
        $("#easycomment_current_url").attr('style','border:solid 1px #CCCCCC;');
        $("input[name='security']").attr('style','border:solid 1px #CCCCCC;');
        $("#easycomment_comment").focus();
        $("#easycomment_comment").text('');
        
    },execShowDelete : function(comment_idx){
        
        $("#easycomment_delete_link"+comment_idx).attr('style','display:visible');
        this.showDeleteIdx = comment_idx;
    
    },execHideDelete : function(comment_idx){
        
        $("#easycomment_delete_link"+this.showDeleteIdx).attr('style','visibility:hidden');    
        
    },execDeleteComment : function(comment_idx){
    
        
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
                password : password.val(),
                seq : frontPageEasycomment.iSeq
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
        
        $(".older_post").hide();
        $(".loader_message").show();
        this.iLimit = parseInt(this.iLimit) + parseInt(this.iFixedLimit);
        
        this.bShowComment = true;
        this.init();
        
    },execSeeMore : function(idx){
        var options = {
            url : usbuilder.getUrl('apiFrontGetSingleComment'),
            dataType : 'json',
            type : 'post',
            data : {
                idx : idx,
                seq : frontPageEasycomment.iSeq
            },success : function(serverResponse){

                if($.inArray(idx, frontPageEasycomment.viewIdx)==-1){
                    frontPageEasycomment.viewIdx.push(serverResponse.Data.idx);
                    frontPageEasycomment.cacheComment.push(serverResponse.Data.visitor_comment);
                }
                $("#easycomment_users_comment"+idx).html(serverResponse.Data.visitor_comment);
            }
        }
        $.ajax(options);

    },execRefreshCaptcha : function(){
        
        $('.input_captcha').realperson('destroy');
        $('.input_captcha').realperson({ 
            length: 6,
            includeNumbers: true,
            regenerate: '',
            hashName: 'security'
        });     
        
    },isIE9 : function(){
        var a;
        try{var b=arguments.caller.length;a=0;}catch(e){a=1;}
        return((document.all&&a)==1);   
    }
}