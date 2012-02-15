<?php

class apiFrontSaveComment extends Controller_Api
{
    protected function post($aArgs)
    {
        $model = new modelFront();
        $aResultUrl = $model->execGetUrl($aArgs);
        $iUrlIdx = '';
        $aStatus = array();
        if($this->_checkHash($aArgs['captcha']) ==  $aArgs['security']){

            if($aResultUrl)
            {
                $aGetUrl = $model->execGetUrl($aArgs);
                $iUrlIdx = $aGetUrl['idx'];
            }
            else
            {
                $model->execSaveUrl($aArgs);
                $aGetUrl = $model->execGetUrl($aArgs);
                $iUrlIdx = $aGetUrl['idx'];
            }
            $model->execSaveComment($aArgs,$iUrlIdx);
            $aStatus['status'] = 'ok';
        }else{
            $aStatus['status'] = 'errorc';
        }
        return $aStatus;
    }

    private function _checkHash($value)
    {
        $hash = 5381;
        $value = strtoupper($value);
        for($i = 0; $i < strlen($value); $i++) {
            $hash = (($hash << 5) + $hash) + ord(substr($value, $i));
        }
        return $hash;
    }
}