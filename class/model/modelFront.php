<?php
require_once('builder/builderInterface.php');
define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');
define('EASYCOMMENT_SETTINGS' , sPrefix . 'settings');
define('EASYCOMMENT_URL' , sPrefix . 'url');

class modelFront extends Model
{
    public function execGetComments($iIdx,$seq,$sLimit)
    {
        $sSql = "SELECT
            idx,
            url_idx,
            visitor_name,
            user_type,
            visitor_comment,
            password,
            comment_date,
            DATE_FORMAT(FROM_UNIXTIME(comment_date),'%Y/%d/%m %H:%i:%s') as date_posted
            FROM " . EASYCOMMENT_CONTENTS . " WHERE url_idx = $iIdx AND seq = $seq ORDER BY comment_date DESC $sLimit";
        return $this->query($sSql);
    }

    public function execGetCommentsCount($iIdx,$seq)
    {
        $sSql = "SELECT
        idx,
        url_idx,
        visitor_name,
        user_type,
        visitor_comment,
        password,
        comment_date,
        DATE_FORMAT(FROM_UNIXTIME(comment_date),'%Y/%d/%m %H:%i:%s') as date_posted
        FROM " . EASYCOMMENT_CONTENTS . " WHERE url_idx = $iIdx AND seq = $seq ORDER BY comment_date DESC";
        return $this->query($sSql);
    }

    public function execGetSettings($seq)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_SETTINGS . " WHERE seq = $seq" ;
        return $this->query($sSql,'row');
    }

    public function execSaveComment($aData,$iIdx)
    {
        $sSql = "INSERT INTO " . EASYCOMMENT_CONTENTS .
            "(seq,url_idx,user_type,visitor_name,visitor_comment,password,comment_date)
            VALUES
            ({$aData['seq']},$iIdx,'visitor','{$this->filter_data($aData['name'])}','{$this->filter_data($aData['comment'])}',PASSWORD('{$aData['password']}'),UNIX_TIMESTAMP(NOW()))
            ";

        return $this->query($sSql);
    }

    public function execSaveUrl($aData)
    {
        $sSql = "INSERT INTO " . EASYCOMMENT_URL ."(seq,url) VALUES({$aData['seq']},'{$aData['page_url']}')";
        return $this->query($sSql);
    }

    public function execGetUrl($aData)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_URL . " WHERE url = '{$aData['page_url']}' AND seq = {$aData['seq']}";
        return $this->query($sSql,'row');
    }

    public function execDeleteComment($aData)
    {

        $sSql = "DELETE FROM " . EASYCOMMENT_CONTENTS . " WHERE idx = " . $aData['idx'] . " AND PASSWORD = PASSWORD('{$aData['password']}')";
        return $this->query($sSql);
    }

    public function execViewComment($aData)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_CONTENTS . " WHERE idx = " . $aData['idx'] . " AND PASSWORD = PASSWORD('{$aData['password']}') AND seq = {$aData['seq']}";
        return $this->query($sSql);
    }

    public function execShowComment($aData)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_CONTENTS . " WHERE idx = " . $aData['idx'] . " AND seq = " . $aData['seq'];
        return $this->query($sSql,'row');
    }

    public function initDefault($iSequence)
    {
        $sSql = " INSERT INTO " . EASYCOMMENT_SETTINGS . " (seq,comment_limit) VALUES($iSequence,5)";
        return $this->query($sSql);
    }

    //============================================//
    //           Filter data method               //
    //============================================//
    public function filter_data($sData)
    {
        return $this->_sanitize_data($sData);
    }

    private function _sanitize_data($sData)
    {
        $sNewWord = '';
        $iCharCount = strlen($sData);

        for($i = 0 ; $i < $iCharCount ; $i++)
        {
            if($sData[$i] =='\\')
            {
                $sNewWord .= '';
            }
            else
            {
                $sNewWord .= htmlentities( $sData[$i] );
            }
        }

        return $this->_strip_quotes($sNewWord);
    }

    private function _strip_quotes($sData)
        {
        return filter_var($sData,FILTER_SANITIZE_MAGIC_QUOTES);
    }
}
