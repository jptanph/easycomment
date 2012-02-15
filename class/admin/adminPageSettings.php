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

        $model = new modelAdmin();
        $aResult = $model->execGetSettings();

        $this->importCss('farbtastic');
        $this->importJs('farbtastic');
        $this->importCss(__CLASS__);
        $this->importJs(__CLASS__);

        /** settings assign value.**/
        $this->assign('sPrefix',$this->_sPrefix);
        $this->assign('sImagePath',$sImagePath);
        $this->assign('iIdx',$aResult['idx']);
        $this->assign('iCommentLimit',$aResult['comment_limit']);
        $this->assign('sUnAuthorizedWord',$aResult['unauthorized_word']);
        $this->assign('sBackgroundColor',$aResult['background_color']);
        $this->assign('sTextColor',$aResult['text_color']);
        $this->assign('sHeaderColor',$aResult['header_color']);
        $this->assign('sHeaderTextColor',$aResult['header_text_color']);
        $this->assign('sShowCustom',($aResult['background_color'] || $aResult['text_color'] || $aResult['header_color'] || $aResult['header_text_color']) ? 'yes' : 'no');
        /** settings assign value.**/

        $this->view(__CLASS__);
    }
}
