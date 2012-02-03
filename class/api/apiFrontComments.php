<?php

class apiFrontComments extends Controller_Api
{
    protected function post($aArgs)
    {
       $model = new modelFront();
       $aResult = $model->execGetComments();
       return $aResult;
    }
}