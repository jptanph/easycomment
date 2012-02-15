<?php
require_once('builder/builderInterface.php');

class apiAdminDeleteSingle extends Controller_Api
{
    public function post($aArgs)
    {
        $model = new modelAdmin();

        $model->execDelete($aArgs['idx']);
    }
}