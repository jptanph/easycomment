<?php

class apiFrontGetSingleComment extends Controller_Api
{

    protected function post($aArgs)
    {
        $model = new modelFront();

        $aResult = $model->execShowComment($aArgs);
        return $aResult;
    }
}