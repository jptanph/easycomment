<?php
require_once('builder/builderInterface.php');
define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');
define('EASYCOMMENT_SETTINGS' , sPrefix . 'settings');
define('EASYCOMMENT_URL' , sPrefix . 'url');

class modelAdmin extends Model
{
    public function execGetContents($sSearchWhere,$sOrderBy)
    {
        $sSql = "SELECT
            t_contents.visitor_name as visitor_name,
            t_contents.visitor_comment as visitor_comment,
            t_contents.idx as idx,t_url.url as url,
            t_contents.url_idx as url_idx
             FROM " . EASYCOMMENT_CONTENTS . " AS t_contents
            INNER JOIN " . EASYCOMMENT_URL . " as t_url ON
             t_contents.url_idx = t_url.idx  $sSearchWhere $sOrderBy $sLimit";
        return $this->query($sSql);
    }

    public function execViewComment($iIdx)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_CONTENTS . " WHERE idx = " . $iIdx;
        return $this->query($sSql,'row');
    }

    public function execUpdate($aArgs)
    {

       $sSql = "UPDATE " . EASYCOMMENT_CONTENTS . " SET visitor_comment = '".$aArgs['comment'] ."' WHERE idx = {$aArgs['idx']}";

        return $this->query($sSql);
    }

    public function execGetCount($sSearchWhere)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_CONTENTS . " $sSearchWhere";
        return $this->query($sSql);
    }

    public function execDelete($iIdx)
    {
        $sSql = "DELETE FROM " . EASYCOMMENT_CONTENTS . " WHERE idx = $iIdx";
        return $this->query($sSql);
    }

    public function execGetSettings()
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_SETTINGS;
        return $this->query($sSql,'row');
    }

    public function execSaveSettings($aData)
    {
        $sSql = "INSERT INTO " . EASYCOMMENT_SETTINGS .
            "(comment_limit,unauthorized_word)
            VALUES
            ('{$aData['easycomment_comment_limit']}',
            '{$aData['easycomment_ua_word']}'
            )
            ";
        return $this->query($sSql);
    }

    public function execUpdateSettings($aData)
    {
        $sSql = "UPDATE " . EASYCOMMENT_SETTINGS .
            " SET
              comment_limit = {$aData['easycomment_comment_limit']},
              unauthorized_word = '{$aData['easycomment_ua_word']}'
              WHERE idx = {$aData['easycomment_idx']}
            ";
        return $this->query($sSql);
    }


}