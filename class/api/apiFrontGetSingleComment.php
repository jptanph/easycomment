<?php
require_once('builder/builderInterface.php');
class apiFrontGetSingleComment extends Controller_Api
{

    protected function post($aArgs)
    {
        usbuilder()->init($this, $aArgs);

        $aResult = common()->modelFront()->execShowComment($aArgs);
        return $aResult;
    }
}