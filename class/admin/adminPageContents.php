<?php

require_once('builder/builderInterface.php');

class adminPageContents extends Controller_Admin
{
    protected function run($aArgs)
    {
        $aData = array();
        $sPrefix = $this->Request->getAppID() . '_';
        /** usbuilder initializer.**/
        $sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
        $this->writeJs($sInitScript);
        /** usbuilder initializer.**/

        $this->importCss('adminPageStyle');
        $model = new modelAdmin();
        $aResult = $model->execGetContents();

        foreach($aResult as $rows)
        {
            $aData[] = array(
                'idx' => $rows['idx'],
                'url_idx' => $rows['url_idx'],
                'user_type' => $rows['user_type'],
                'name' => $rows['name'],
                'comment' => $rows['comment'],
                'password' => $rows['password'],
                'comment_date' => $rows['comment_date']
            );
        }
        $this->importJs(__CLASS__);
        $this->assign('sPrefix',$sPrefix);
        $this->assign('aData',$aData);
        $this->view(__CLASS__);
    }
}