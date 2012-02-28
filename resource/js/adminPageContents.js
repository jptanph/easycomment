$(document).ready(function(){
    var options = { 'years_between' : [2000,2030],'format' : 'yyyy/mm/dd' };
    $("#easycomment_start_date, #easycomment_end_date").BuilderCalendar(options);
});


var adminPageContents = {
    arrayIdx : [],
    singleIdx : 0,
    execAddComment : function(){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        $("#easycomment_edit_comment").hide();
        $("#easycomment_delete_multiple_comment").hide();
        $("#easycomment_delete_single_comment").hide();
        sdk_popup.load('easycomment_add_comment').skin('admin').layer({
            'title' : 'Add Comment',
            'width' : 485,
            'classname': 'ly_set ly_editor',
            resizable : true
        });
        popup.close('easycomment_edit_comment');
        
    },execEditComment : function(idx){
        
        $(".pop_calendar").hide();
        sdk_message.hide();

        var options = {
            url : usbuilder.getUrl('apiAdminViewComment'),
            type : 'post',
            dataType : 'json',
            data : {
                idx : idx
            },success : function(serverResponse){
               
                sdk_popup.load('easycomment_edit_comment').skin('admin').layer({
                    'title' : 'Edit Comment',
                    'width' : 480,
                    'classname': 'ly_set ly_editor'
                });
                
                $("#easycomment_edit_idx").val('');
                $("#easycomment_edit_user_comment").val('');
                
                $("#easycomment_edit_idx").val(serverResponse.Data.idx);
                $("#easycomment_edit_url").html(serverResponse.Data.url);
                $("#easycomment_edit_name").html(serverResponse.Data.visitor_name);
                $("#easycomment_edit_user_comment").val(serverResponse.Data.visitor_comment);
               
            }            
        }
        
        $.ajax(options);
        
        sdk_popup.load('easycomment_edit_comment').skin('admin').layer({
            'title' : 'Edit Comment',
            'width' : 460,
            'classname': 'ly_set ly_editor'
        });        
        sdk_popup.close('easycomment_add_comment');
        
    },execSearch : function(){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        var date_range = $("#easycomment_date_range");
        var field_search = $("#easycomment_field_search");
        var start_date = $("#easycomment_start_date");
        var end_date = $("#easycomment_end_date");
        var keyword = $("#easycomment_keyword");
        var search_flag = $("#search");
        var seq = $("#easycomment_seq");

        if((Date.parse(start_date.val()) > Date.parse(end_date.val()))){
            start_date.css('border','solid 2px #DC4E22');
            end_date.css('border','solid 2px #DC4E22');
            return false;
        }
        
        if($.trim(start_date.val())=='' && $.trim(end_date.val())==''){
            start_date.css('border','solid 2px #DC4E22');
            end_date.css('border','solid 2px #DC4E22');  
            return false;
        }
        start_date.css('border','solid 1px #CCC');
        end_date.css('border','solid 1px #CCC'); 
        
        location.href = usbuilder.getUrl('adminPageContents') + "&seq=" + seq.val() +  "&search=" + '&keyword='+keyword.val()+'&start_date='+start_date.val()+'&end_date='+end_date.val()+'&field_search='+field_search.val()+'&date_range='+date_range.val() + '&search='+search_flag.val();
    
    },execReset : function(){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        $("select#easycomment_field_search").val('name');
        $("select#easycomment_date_range").val('currentMonth');
        $("#easycomment_keyword").val('');
    
    },execShowRows  : function(sQry){
        
        $(".pop_calendar").hide();
        var show_row = $("#easycomment_show_row");
       
       location.href = usbuilder.getUrl('adminPageContents') + '&row=' + show_row.val() + sQry;
   
    },execUpdate : function(sQry){
        
        $(".pop_calendar").hide();
        var idx = $("#easycomment_edit_idx");
        var name = $("#easycomment_edit_name");
        var comment = $("#easycomment_edit_user_comment");
        
        var options = {
            url : usbuilder.getUrl('apiAdminUpdate'),
            type : 'post',
            dataType : 'json',
            data : {
                idx : idx.val(),
                name : name.val(),
                
                comment : comment.val()
            },success : function(serverResponse){
                if(serverResponse.Data){
                    sdk_popup.close('easycomment_edit_comment','success');
                    sdk_message.show("Save successfully!");
                    location.href = usbuilder.getUrl('adminPageContents') + sQry;
                }
            }
        }
        
        if(oValidator.formName.getMessage('easycomment_edit_comment_form')){
            $.ajax(options);    
        }
            
    },execSingleDelete : function(idx){
        
        $(".pop_calendar").hide();
        adminPageContents.singleIdx = idx;
        sdk_popup.load('easycomment_delete_single_comment').skin('admin').layer({
            'title' : 'Delete Comment',
            'width' : 280,
            'classname': 'ly_set ly_editor'
        });       
        $("#easycomment_add_comment").hide();
        $("#easycomment_edit_comment").hide();
        $("#easycomment_delete_multiple_comment").hide();
        
    },execDateRange : function(){
        
        $(".pop_calendar").hide();
        var date_range = $("#easycomment_date_range");
        
        var options = {
            url : usbuilder.getUrl('apiAdminDateRange'),
            type : 'post',
            dataType : 'json',
            data : {
                requestDate : date_range.val()
            },success : function(serverResponse){
                $("#easycomment_start_date").val(serverResponse.Data.sDate)
                $("#easycomment_end_date").val(serverResponse.Data.eDate)
            }
        }
        
        $.ajax(options);
        
    },execMultipleDelete : function(){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        var arrayIdx = [];
        var total_checked = $("input[name='idx_val[]']:checked").length;
        
        if(total_checked==0){
            //oValidator.generalPurpose.getMessage(false, "Please select the record(s) you'd like to delete.");
            sdk_message.show("Please select the record(s) you'd like to delete.", 'warning');

        }else{
            
            $("#validation_message").hide();
            sdk_popup.load('easycomment_delete_multiple_comment').skin('admin').layer({
                'title' : 'Delete Comment',
                'width' : 280,
                'classname': 'ly_set ly_editor'
            });
            adminPageContents.arrayIdx.splice(0,adminPageContents.arrayIdx.length);
            $("input[name='idx_val[]']").each(function(index,value){
                iIdx = $(this).attr("value");
                if($(this).is(":checked")==true){
                    if($.inArray(value.value,adminPageContents.arrayIdx)==-1){
                        adminPageContents.arrayIdx.push(iIdx);
                    }
                }
            });
            
        }
        $("#easycomment_delete_single_comment").hide();
        $("#easycomment_add_comment").hide();
        $("#easycomment_edit_comment").hide();
        
    },execSelectAll : function(id){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        $("#easycomment_delete_multiple_comment").hide();  
        var is_checked = $("#"+id).is(':checked');
        $("input[name='idx_val[]']").each(function(index,value){
            $(this).attr('checked',is_checked);
        });
        if($("input[name='idx_val[]']:checked").length==0){
            sdk_popup.close("simplesample_delete_popup");
        }
        
        var total_checked = $("input[name='idx_val[]']:checked").length;
        if(total_checked>0){
            $("#validation_message").hide();
        }
        
        $("#easycomment_add_comment").hide();
        $("#easycomment_edit_comment").hide();
        $("#easycomment_delete_multiple_comment").hide();        
        $("#easycomment_delete_single_comment").hide();  
        
    },execDeleteMConfirm  : function(){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        var options = {
            url : usbuilder.getUrl('apiAdminDeleteMultiple'),
            type : 'post',
            dataType : 'json',
            data : {
                idx : adminPageContents.arrayIdx
            },success : function(serverResponse){
                sdk_popup.close('easycomment_delete_multiple_comment');
                //oValidator.generalPurpose.getMessage(true, "Deleted successfully");
               
                sdk_message.show('Deleted successfully!', 'success');
                window.location.href=usbuilder.getUrl('adminPageContents'); 
            }            
        }
        
        $.ajax(options);
    
    },execResetSelect : function(){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        $("#easycomment_delete_multiple_comment").hide();
        $("#easycomment_edit_comment").hide();
        
        $("#easycomment_add_comment").hide();
        $("#easycomment_delete_multiple_comment").hide();
        $("#easycomment_delete_single_comment").hide();
    
    },execDeleteSConfirm : function(sQry){
        
        $(".pop_calendar").hide();
        sdk_message.hide();
        var options = {
            url : usbuilder.getUrl('apiAdminDeleteSingle'),
            type : 'post',
            dataType : 'json',
            data : {
                idx : adminPageContents.singleIdx
            },success : function(serverResponse){
                sdk_popup.close('easycomment_delete_single_comment');
                //oValidator.generalPurpose.getMessage(true, "Deleted successfully");
                sdk_message.show('Deleted successfully!', 'success');
                window.location.href=usbuilder.getUrl('adminPageContents') + sQry;              
            }
        }
        $.ajax(options);
        
    },execCustomDateRange : function(){
        
        sdk_message.hide();
        $("select#easycomment_date_range").val('custom');
        $("#easycomment_add_comment").hide();
        $("#easycomment_edit_comment").hide();
        $("#easycomment_delete_multiple_comment").hide();        
        $("#easycomment_delete_single_comment").hide();        
    
    },execSave : function(){
    
        var url = $("#easycomment_add_url");
        var name = $("#easycomment_add_name");
        var comment = $("#easycomment_add_visitor_comment");
        
        var options = {
            url : usbuilder.getUrl('apiAdminSave'),
            dataType : 'json',
            type : 'post',
            data : {
                name : name.val(),
                comment : comment.val(),
                url : url.val()
            },success : function(serverResponse){
                if(serverResponse.Data.status=='error'){
                    url.css({'border':'solid 2px #DC4E22'});
                }else{
                    url.css({'border':'solid 1px #CCC'});
                    sdk_popup.close('easycomment_add_comment');
                    //oValidator.generalPurpose.getMessage(true, "Saved successfully!");
                    sdk_message.show('Saved successfully!', 'success');
                    location.href = usbuilder.getUrl('adminPageContents');
                }
            }
        }
        
        if(oValidator.formName.getMessage('easycomment_add_comment')){
            $.ajax(options);    
        }
        
    },mostAction : function(){
        
        location.href = usbuilder.getUrl('adminPageSettings');
        
    }
}