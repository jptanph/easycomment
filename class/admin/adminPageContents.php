<?php

require_once('builder/builderInterface.php');

class adminPageContents extends Controller_Admin
{
    protected function run($aArgs)
    {
        $aData = array();
        $sPrefix = $this->Request->getAppID() . '_';
        $sImagePath = '/_sdk/img/' . $this->Request->getAppID() . '/';
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
        $this->importCss('jqueryCalendar');
        $this->importJs(__CLASS__);
        $this->importJs('jqueryCalendar');

        /** assigns for search functionality.**/
        $this->assign('sKeyword',$aArgs['keyword']);
        $this->assign('iRow',$aArgs['row']);
        $this->assign('sDateRange',$aArgs['date_range']);
        $this->assign('sStartDate',(!isset($aArgs['start_date'])) ? date("Y/m/") . '01' : $aArgs['start_date']);
        $this->assign('sEndDate',(!isset($aArgs['end_date'])) ? date("Y/m/t") : $aArgs['end_date']);
        /** assigns for search functionality.**/

        $this->assign('sPrefix',$sPrefix);
        $this->assign('sImagePath',$sImagePath);
        $this->assign('aData',$aData);
        $this->view(__CLASS__);
    }
}