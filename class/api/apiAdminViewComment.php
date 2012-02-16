<?php

require_once('builder/builderInterface.php');

class apiAdminViewComment extends Controller_Api
{
    public function post($aArgs)
    {
       $aResult = common()->modelAdmin()->execViewComment($aArgs['idx']);
       return $aResult;
    }
}