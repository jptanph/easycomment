<?php

class apiAdminSave extends Controller_Api
{
    protected function post($aArgs)
    {
        $model = new modelAdmin();

        $aResult = $model->execGetUrlInfo($aArgs);
        $aStatus = array();
        if($aResult)
        {
            $model->execSaveComment($aArgs,$aResult['idx']);
            $aStatus['status'] = 'ok';
        }
        else
        {
            $aStatus['status'] = 'error';
        }

        return $aStatus;
    }
}