<?php
require_once('builder/builderInterface.php');

class apiAdminDeleteMultiple extends Controller_Api
{
    public function post($aArgs)
    {
        $model = new modelAdmin();
        foreach($aArgs['idx'] as $rows)
        {
            $model->execDelete($rows);
        }
    }
}