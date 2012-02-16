<?php
require_once('builder/builderInterface.php');

class apiAdminDeleteMultiple extends Controller_Api
{
    public function post($aArgs)
    {
        foreach($aArgs['idx'] as $rows)
        {
            common()->modelAdmin()->execDelete($rows);
        }
    }
}