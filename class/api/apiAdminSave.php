<?php

class apiAdminSave extends Controller_Api
{
    protected function post($aArgs)
    {

        $aResult = common()->modelAdmin()->execGetUrlInfo($aArgs);
        $aStatus = array();
        if($aResult)
        {
            common()->modelAdmin()->execSaveComment($aArgs,$aResult['idx']);
            $aStatus['status'] = 'ok';
        }
        else
        {
            $aStatus['status'] = 'error';
        }

        return $aStatus;
    }
}