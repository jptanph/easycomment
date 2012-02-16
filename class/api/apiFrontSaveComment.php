<?php
require_once('builder/builderInterface.php');

class apiFrontSaveComment extends Controller_Api
{
    protected function post($aArgs)
    {
        usbuilder()->init($this, $aArgs);

        $aResultUrl = common()->modelFront()->execGetUrl($aArgs);
        $iUrlIdx = '';
        $aStatus = array();
        if($this->_checkHash($aArgs['captcha']) ==  $aArgs['security']){

            if($aResultUrl)
            {
                $aGetUrl = common()->modelFront()->execGetUrl($aArgs);
                $iUrlIdx = $aGetUrl['idx'];
            }
            else
            {
                common()->modelFront()->execSaveUrl($aArgs);
                $aGetUrl = common()->modelFront()->execGetUrl($aArgs);
                $iUrlIdx = $aGetUrl['idx'];
            }
            common()->modelFront()->execSaveComment($aArgs,$iUrlIdx);
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