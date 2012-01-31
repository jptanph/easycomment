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
    }
}