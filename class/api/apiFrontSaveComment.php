<?php

class apiFrontSaveComment extends Controller_Api
{
    protected function post($aArgs)
    {
        $model = new modelFront();
        $aResultUrl = $model->execGetUrl($aArgs);
        $iUrlIdx = '';

        if($aResultUrl)
        {
            $aGetUrl = $model->execGetUrl($aArgs);
            $iUrlIdx = $aGetUrl['idx'];
        }
        else
        {
            $model->execSaveUrl($aArgs);
            $aGetUrl = $model->execGetUrl($aArgs);
            $iUrlIdx = $aGetUrl['idx'];
        }
        return $model->execSaveComment($aArgs,$iUrlIdx);
        return $sUrl;
    }
}