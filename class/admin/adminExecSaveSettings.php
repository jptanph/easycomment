<?php
require_once('builder/builderInterface.php');

class adminExecSaveSettings extends Controller_AdminExec
{
    protected function run($aArgs)
    {
        $sInitScript = usbuilder()->init($this, $aArgs);

        $sUrl = usbuilder()->getUrl('adminPageSettings');

        $aResult = common()->modelAdmin()->execGetSettings();

        if($aResult)
        {
           $bResult = common()->modelAdmin()->execUpdateSettings($aArgs);
        }
        else
        {
            $bResult = common()->modelAdmin()->execSaveSettings($aArgs);
        }

        if($bResult===false){
            usbuilder()->message('Saved failed!', 'warning');
        }else{
            usbuilder()->message('Saved succesfully!', 'success');
        }

        usbuilder()->jsMove($sUrl);
    }
}