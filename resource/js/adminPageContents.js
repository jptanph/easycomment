$(document).ready(function(){
    var options = { 'years_between' : [2000,2030],'format' : 'yyyy/mm/dd' };
    $("#easycomment_start_date, #easycomment_end_date").BuilderCalendar(options);
});


var adminPageContents = {
    execAddComment : function(){
        
        popup.load('easycomment_add_comment').skin('admin').layer({
            'title' : 'Add Comment',
            'width' : 460,
            'classname': 'ly_set ly_editor'
        });
        popup.close('easycomment_edit_comment');
        
    },execEditComment : function(idx){
        
        var options = {
            url : usbuilder.getUrl('apiAdminViewComment'),
            type : 'post',
            dataType : 'json',
            data : {
                idx : idx
            },success : function(serverResponse){
               
                
                popup.load('easycomment_edit_comment').skin('admin').layer({
                    'title' : 'Edit Comment',
                    'width' : 460,
                    'classname': 'ly_set ly_editor'
                });
                
                $("#easycomment_edit_idx").val('');
                $("#easycomment_edit_user_comment").val('');
                
                $("#easycomment_edit_idx").val(serverResponse.Data.idx);
                $("#easycomment_edit_url").html(serverResponse.Data.url_idx);
                $("#easycomment_edit_name").html(serverResponse.Data.visitor_name);
                $("#easycomment_edit_user_comment").val(serverResponse.Data.visitor_comment);
               
            }            
        }
        
        $.ajax(options);
        
        popup.load('easycomment_edit_comment').skin('admin').layer({
            'title' : 'Edit Comment',
            'width' : 460,
            'classname': 'ly_set ly_editor'
        });        
        popup.close('easycomment_add_comment');
        
    },execSearch : function(){
    
        var date_range = $("#easycomment_date_range");
        var field_search = $("#easycomment_field_search");
        var start_date = $("#easycomment_start_date");
        var end_date = $("#easycomment_end_date");
        var keyword = $("#easycomment_keyword");
        
        location.href = usbuilder.getUrl('adminPageContents') + '&keyword='+keyword.val()+'&start_date='+start_date.val()+'&end_date='+end_date.val()+'&field_search='+field_search.val()+'&date_range='+date_range.val();
    
    },execReset : function(){
    
        $("select#easycomment_field_search").val('name');
        $("select#easycomment_date_range").val('currentMonth');
        $("#easycomment_keyword").val('');
    
    },execShowRows  : function(sQry){
       
        var show_row = $("#easycomment_show_row");
       
       location.href = usbuilder.getUrl('adminPageContents') + '&row=' + show_row.val() + sQry;
   
    },execUpdate : function(sQry){
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
                    popup.close('easycomment_edit_comment');
                    oValidator.generalPurpose.getMessage(true, "Save successfully!");
                    location.href = usbuilder.getUrl('adminPageContents') + sQry;
                }
            }
        }
        if(oValidator.formName.getMessage('easycomment_edit_comment_form')){
            $.ajax(options);    
        }
            
    },execSingleDelete : function(){
        
        popup.load('easycomment_delete_single_comment').skin('admin').layer({
            'title' : 'Delete Comment',
            'width' : 280,
            'classname': 'ly_set ly_editor'
        });       
        popup.close('easycomment_edit_comment');
        popup.close('easycomment_add_comment');
        
    
    },execDateRange : function(){
        
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
        
        var total_checked = $("input[name='idx_val[]']:checked").length;
        if(total_checked==0){
            oValidator.generalPurpose.getMessage(false, "Please select the record(s) you'd like to delete.");
        }else{
            $("#validation_message").hide();
            popup.load('easycomment_delete_multiple_comment').skin('admin').layer({
                'title' : 'Delete Comment',
                'width' : 280,
                'classname': 'ly_set ly_editor'
            });  
        }
    },execSelectAll : function(id){
        
        var is_checked = $("#"+id).is(':checked');
        $("input[name='idx_val[]']").each(function(index,value){
            $(this).attr('checked',is_checked);
        });
        if($("input[name='idx_val[]']:checked").length==0){
            popup.close("simplesample_delete_popup");
        }
        
        var total_checked = $("input[name='idx_val[]']:checked").length;
        if(total_checked>0){
            $("#validation_message").hide();
        }
    }
}