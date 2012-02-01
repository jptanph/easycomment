<?php

class apiAdminUpdate extends Controller_Api
{
    protected function post($aArgs)
    {
        $model = new modelAdmin();
        return $model->execUpdate($aArgs);
    }
}