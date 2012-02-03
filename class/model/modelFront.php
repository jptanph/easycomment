<?php
require_once('builder/builderInterface.php');
define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');

class modelFront extends Model
{
    public function execGetComments()
    {
        $sSql = "SELECT
            idx,
            url_idx,
            visitor_name,
            user_type,
            visitor_comment,
            password,
            comment_date,
            DATE_FORMAT(comment_date,'%Y/%d/%m %H:%i:%s') as date_posted
            FROM " . EASYCOMMENT_CONTENTS . " ORDER BY comment_date DESC ";
        return $this->query($sSql);
    }
}
