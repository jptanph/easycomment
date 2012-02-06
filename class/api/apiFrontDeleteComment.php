<?php

require_once('builder/builderInterface.php');

class apiFrontDeleteComment extends Controller_Api
{
    protected function post($aArgs)
    {
        $model = new modelFront();
        $sStatus = '';
        $aResult = $model->execViewComment($aArgs);
        if($aResult){
            $model->execDeleteComment($aArgs);
            $sStatus = 'deleted';
        }else{
            $sStatus = 'error';
        }

        return $sStatus;
    }

}
