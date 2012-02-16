<?php

require_once('builder/builderInterface.php');

class apiFrontDeleteComment extends Controller_Api
{
    protected function post($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        $sStatus = '';
        $aResult = common()->modelFront()->execViewComment($aArgs);
        if($aResult){
            common()->modelFront()->execDeleteComment($aArgs);
            $sStatus = 'deleted';
        }else{
            $sStatus = 'error';
        }

        return $sStatus;
    }

}
