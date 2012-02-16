<?php
require_once('builder/builderInterface.php');

class apiAdminDeleteSingle extends Controller_Api
{
    public function post($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        common()->modelAdmin()->execDelete($aArgs['idx']);
    }
}