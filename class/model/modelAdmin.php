<?php
require_once('builder/builderInterface.php');

define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');

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
        $sSql = "UPDATE " . EASYCOMMENT_CONTENTS . " SET visitor_comment = '{$aArgs['comment']}' WHERE idx = {$aArgs['idx']}";
        return $this->query($sSql);
    }
}