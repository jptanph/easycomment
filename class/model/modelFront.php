<?php
require_once('builder/builderInterface.php');
define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');
define('EASYCOMMENT_SETTINGS' , sPrefix . 'settings');
define('EASYCOMMENT_URL' , sPrefix . 'url');

class modelFront extends Model
{
    public function execGetComments($iIdx)
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
            FROM " . EASYCOMMENT_CONTENTS . " WHERE url_idx = $iIdx ORDER BY comment_date DESC ";
        return $this->query($sSql);
    }

    public function execGetSettings()
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_SETTINGS;
        return $this->query($sSql,'row');
    }

    public function execSaveComment($aData,$iIdx)
    {
        $sSql = "INSERT INTO " . EASYCOMMENT_CONTENTS .
            "(url_idx,user_type,visitor_name,visitor_comment,password,comment_date)
            VALUES
            ($iIdx,'visitor','{$aData['name']}','{$aData['comment']}','{$aData['password']}',UNIX_TIMESTAMP(NOW()))
            ";

        return $this->query($sSql);
    }

    public function execSaveUrl($aData)
    {
        $sSql = "INSERT INTO " . EASYCOMMENT_URL ."(url) VALUES('{$aData['page_url']}')";
        return $this->query($sSql);
    }

    public function execGetUrl($aData)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_URL . " WHERE url = '{$aData['page_url']}'";
        return $this->query($sSql,'row');
    }

}
