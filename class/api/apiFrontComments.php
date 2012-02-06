<?php

class apiFrontComments extends Controller_Api
{
    protected function post($aArgs)
    {
       $model = new modelFront();
       $aUrl = $model->execGetUrl($aArgs);
       $aResult = $model->execGetComments($aUrl['idx']);
       return $aResult;
    }
}