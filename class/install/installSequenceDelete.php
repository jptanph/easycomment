<?php
class installSequenceDelete
{
    function run($aArgs)
    {
        $bResult = common()->modelAdmin()->deleteContentsBySeq($aArgs['seq']);
        common()->modelAdmin()->deleteSettingsBySeq();
        common()->modelAdmin()->deleteUrlBySeq();

        if ($bResult !== false) {
            return true;
        } else {
            return false;
        }
    }
}