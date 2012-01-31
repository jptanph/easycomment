<?php

require_once('builder/builderInterface.php');

class apiAdminViewComment extends Controller_Api
{
    public function post($aArgs)
    {
       $model = new modelAdmin();

       $aResult = $model->execViewComment($aArgs['idx']);

       return $aResult;
    }
}