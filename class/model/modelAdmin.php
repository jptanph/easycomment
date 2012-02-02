<?php
require_once('builder/builderInterface.php');
define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');
define('EASYCOMMENT_SETTINGS' , sPrefix . 'settings');

class modelAdmin extends Model
{
    public function execGetContents($sSearchWhere,$sOrderBy)
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_CONTENTS . " $sSearchWhere $sOrderBy $sLimit";
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

    public function filter_data($sData)
    {
        $htmlSpecialChars = htmlspecialchars($sData);

        return strip_tags($this->_remove_injection($htmlSpecialChars));
    }

    private function _remove_injection($sData)
    {
        $s = filter_var($sData,FILTER_SANITIZE_STRING);
        return filter_var($s,FILTER_SANITIZE_MAGIC_QUOTES);
    }
}