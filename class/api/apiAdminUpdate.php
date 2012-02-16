<?php
require_once('builder/builderInterface.php');
class apiAdminUpdate extends Controller_Api
{
    protected function post($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        return common()->modelAdmin()->execUpdate($aArgs);
    }
}