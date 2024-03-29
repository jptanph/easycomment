<?php
require_once('builder/builderInterface.php');
define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');
define('EASYCOMMENT_SETTINGS' , sPrefix . 'settings');
define('EASYCOMMENT_URL' , sPrefix . 'url');

class modelAdmin extends Model
{
    public function execGetContents($sSearchWhere,$sOrderBy,$sLimit)
    {
        $sSql = "SELECT
            t_contents.visitor_name as visitor_name,
            t_contents.visitor_comment as visitor_comment,
            t_contents.idx as idx,t_url.url as url,
            t_contents.url_idx as url_idx,
            t_contents.comment_date as date_posted
             FROM " . EASYCOMMENT_CONTENTS . " AS t_contents
            INNER JOIN " . EASYCOMMENT_URL . " as t_url ON
             t_contents.url_idx = t_url.idx  $sSearchWhere $sOrderBy $sLimit";
        return $this->query($sSql);
    }

    public function execViewComment($iIdx,$seq)
    {
        $sSql = "SELECT
             t_contents.idx AS idx,
             t_contents.url_idx as url_idx,
             t_contents.visitor_name as visitor_name,
             t_contents.visitor_comment as visitor_comment,
             t_url.url as url
             FROM " . EASYCOMMENT_CONTENTS . " AS t_contents
            INNER JOIN " . EASYCOMMENT_URL . " AS t_url on t_contents.url_idx = t_url.idx WHERE t_contents.idx = $iIdx AND t_contents.seq = $seq " ;
        return $this->query($sSql,'row');
    }

    public function execUpdate($aArgs)
    {

       $sSql = "UPDATE " . EASYCOMMENT_CONTENTS . " SET visitor_comment = '".$aArgs['comment'] ."' WHERE idx = {$aArgs['idx']} AND seq = {$aArgs['seq']}";

        return $this->query($sSql);
    }

    public function execGetCount($sInnerJoin,$sSearchWhere)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_CONTENTS . " $sInnerJoin  $sSearchWhere";
        return $this->query($sSql);
    }

    public function execDelete($iIdx,$seq)
    {
        $sSql = "DELETE FROM " . EASYCOMMENT_CONTENTS . " WHERE idx = $iIdx AND seq = $seq";
        return $this->query($sSql);
    }

    public function execGetSettings($aArgs)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_SETTINGS . " WHERE seq = {$aArgs['seq']}";
        return $this->query($sSql,'row');
    }

     public function execSaveSettings($aData)
    {
        $sSql = "INSERT INTO " . EASYCOMMENT_SETTINGS .
            "(seq,comment_limit,unauthorized_word,background_color,text_color,header_color,header_text_color)
            VALUES
            (
            {$aData['seq']},
            '{$aData['easycomment_comment_limit']}',
            '{$aData['easycomment_ua_word']}',
            '{$aData['easycomment_bg_color']}',
            '{$aData['easycomment_text_color']}',
            '{$aData['easycomment_header_color']}',
            '{$aData['easycomment_htext_color']}'
            )
            ";
            usbuilder()->vd($sSql);
        return $this->query($sSql);
    }

    public function execUpdateSettings($aData)
    {
        $sSql = "UPDATE " . EASYCOMMENT_SETTINGS .
            " SET
              comment_limit = {$aData['easycomment_comment_limit']},
              unauthorized_word = '{$aData['easycomment_ua_word']}',
              background_color = '{$aData['easycomment_bg_color']}',
              text_color = '{$aData['easycomment_text_color']}',
              header_color = '{$aData['easycomment_header_color']}',
              header_text_color = '{$aData['easycomment_htext_color']}'
              WHERE idx = {$aData['easycomment_idx']}
            ";
        return $this->query($sSql);
    }

    public function execSaveComment($aData,$iUrlIdx)
    {
        $sSql = " INSERT INTO " . EASYCOMMENT_CONTENTS .
            "(seq,url_idx,user_type,visitor_name,visitor_comment,comment_date)
            VALUES
            ({$aData['seq']},$iUrlIdx,'admin','{$aData['name']}','{$aData['comment']}',UNIX_TIMESTAMP(NOW()))";
        $this->query($sSql);
    }

    public function execGetUrlInfo($aData)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_URL . " WHERE url = '" . $aData['url']  .  "'";
        return $this->query($sSql,'row');
    }

    public function deleteContentsBySeq($aSeq)
    {
        $sSeqs = implode(',', $aSeq);
        $sQuery = "DELETE FROM " . EASYCOMMENT_CONTENTS . " WHERE seq in($sSeqs)";
        $mResult = $this->query($sQuery);
        return $mResult;
    }

    public function deleteSettingsBySeq()
    {
        $sQuery = "DELETE FROM " . EASYCOMMENT_SETTINGS;
        $mResult = $this->query($sQuery);
        return $mResult;
    }

    public function deleteUrlBySeq()
    {
        $sQuery = "DELETE FROM " . EASYCOMMENT_URL;
        $mResult = $this->query($sQuery);
        return $mResult;
    }
}