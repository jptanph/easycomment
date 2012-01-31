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
    },execEditComment : function(){
        
        popup.load('easycomment_edit_comment').skin('admin').layer({
            'title' : 'Edit Comment',
            'width' : 460,
            'classname': 'ly_set ly_editor'
        });        
        popup.close('easycomment_add_comment');
    },execSelectAll : function(id){
        var is_checked = $("#"+id).is(':checked');
        $("input[name='idx_val[]']").each(function(index,value){
            $(this).attr('checked',is_checked);
        });
        if($("input[name='idx_val[]']:checked").length==0){
            popup.close("simplesample_delete_popup");
        }
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
    },execShowRows  : function(){
       var show_row = $("#easycomment_show_row");
       
       location.href = usbuilder.getUrl('adminPageContents') + '&row=' + show_row.val();
    }
}