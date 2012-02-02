<?php
require_once('builder/builderInterface.php');

class adminPageSettings extends Controller_Admin
{
    private $_sPrefix;

    protected function run($aArgs)
    {
        $this->_sPrefix = $this->Request->getAppID() . '_';
        $sImagePath = '/_sdk/img/' . $this->Request->getAppID() . '/';
        /** usbuilder initializer.**/
        $sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
        $this->writeJs($sInitScript);

        $sFormScript = usbuilder()->getFormAction($this->_sPrefix . 'settings_form','adminExecSaveSettings');
        $this->writeJs($sFormScript);
        /** usbuilder initializer.**/

        $sUrlContents = usbuilder()->getUrl('adminPageContents');

        $model = new modelAdmin();
        $aResult = $model->execGetSettings();

        $this->importCss('farbtastic');
        $this->importJs('farbtastic');
        $this->importCss(__CLASS__);
        $this->importJs(__CLASS__);

        /** settings assign value.**/
        $this->assign('sPrefix',$this->_sPrefix);
        $this->assign('sUrlContents',$sUrlContents);
        $this->assign('sImagePath',$sImagePath);
        $this->assign('iIdx',$aResult['idx']);
        $this->assign('iCommentLimit',($aResult['comment_limit']=='') ? 5 : $aResult['comment_limit']);
        $this->assign('sUnAuthorizedWord',$aResult['unauthorized_word']);
        /** settings assign value.**/

        $this->view(__CLASS__);
    }
}
