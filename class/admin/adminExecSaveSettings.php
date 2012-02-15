<?php
require_once('builder/builderInterface.php');

class adminExecSaveSettings extends Controller_AdminExec
{
    protected function run($aArgs)
    {
        $sInitScript = usbuilder()->init($this, $aArgs);

        $sUrl = usbuilder()->getUrl('adminPageSettings');

        $model = new modelAdmin();
        $aResult = $model->execGetSettings();

        if($aResult)
        {
           $bResult = $model->execUpdateSettings($aArgs);
        }
        else
        {
            $bResult = $model->execSaveSettings($aArgs);
        }

        if($bResult===false){
            usbuilder()->message('Saved failed!', $sType = 'warning');
        }else{
            usbuilder()->message('Saved succesfully!', $sType = 'success');
        }
        usbuilder()->jsMove($sUrl);

    }
}