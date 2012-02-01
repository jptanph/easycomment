<?php
require_once('builder/builderInterface.php');

class adminPageContents extends Controller_Admin
{
    protected function run($aArgs)
    {
        $aData = array();
        $iLimit = 20;
        $sPrefix = $this->Request->getAppID() . '_';
        $sImagePath = '/_sdk/img/' . $this->Request->getAppID() . '/';
        /** usbuilder initializer.**/
        $sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
        $this->writeJs($sInitScript);

        $sFormScript = usbuilder()->getFormAction($this->_sPrefix . 'edit_comment_form','');
        $this->writeJs($sFormScript);
        /** usbuilder initializer.**/

        /** query strings. **/
         $sQrySearch = (
            isset($aArgs['keyword']) &&
            isset($aArgs['start_date']) &&
            isset($aArgs['end_date']) &&
            isset($aArgs['field_search']) &&
            isset($aArgs['date_range'])
            )
            ?
            "&keyword={$aArgs['keyword']}&start_date={$aArgs['start_date']}&end_date={$aArgs['end_date']}&field_search={$aArgs['field_search']}&date_range={$aArgs['date_range']}"
            :
            ''
            ;
        $sQryRow = (isset($aArgs['row'])) ? "&row=" . $aArgs['row'] : '';
        $sQrySort = (isset($aArgs['sort']) && isset($aArgs['type'])) ? '&sort=' . $aArgs['sort'] . "&type=" . $aArgs['type'] : '';
        $sQryPage = (isset($aArgs['page'])) ? '&page=' . $aArgs['page'] : '';
        /** query strings. **/

        $iPage =(isset($aArgs['page'])) ? $aArgs['page'] : '1';
        $iRow = ($iPage - 1) * $iLimit;

        /** queries for model.**/
        $sSearchWhere = (
            isset($aArgs['keyword']) &&
            isset($aArgs['start_date']) &&
            isset($aArgs['end_date']) &&
            isset($aArgs['field_search']) &&
            isset($aArgs['date_range'])
            )
           ?
           " WHERE " . $aArgs['field_search'] . " LIKE '%" . $aArgs['keyword'] . "%' AND DATE_FORMAT(comment_date,'%Y/%m/%d') BETWEEN '" . $aArgs['start_date'] . "' AND '" . $aArgs['end_date'] . "' "
           :
           '';
        $sOrderBy = (isset($aArgs['sort']) && isset($aArgs['type']))
            ?
            " ORDER BY " . $aArgs['sort'] . " " . (($aArgs['type']=='des' ) ? " DESC " : " ASC ")
            : " ORDER BY comment_date DESC ";
        $sLimit = (isset($aArgs['row'])) ? " LIMIT $iLimit ": " ";
        /** queries for model.**/

        $sUrlContents = usbuilder()->getUrl('adminPageContents');
        $model = new modelAdmin();
        $aResult = $model->execGetContents($sSearchWhere,$sOrderBy,$sLimit);
        $aCount = $model->execGetCount($sSearchWhere);
        $iResult = count($aCount);
        $iIncRow = 0;

        foreach($aResult as $rows)
        {
            $aData[] = array(
                'row' => (($iPage==1) ? ( $iResult - $iIncRow ) : ($iResult-$iRow) - $iIncRow),
                'idx' => $rows['idx'],
                'url_idx' => $rows['url_idx'],
                'user_type' => $rows['user_type'],
                'name' => $rows['visitor_name'],
                'comment' => $rows['visitor_comment'],
                'password' => $rows['password'],
                'comment_date' => $rows['comment_date']
            );
            $iIncRow++;
        }

        /** assign for css and js**/
        $this->importCss('adminPageStyle');
        $this->importCss('jqueryCalendar');
        $this->importJs('jqueryCalendar');
        $this->importJs(__CLASS__);
        /** assign for css and js**/

        $this->assign('sUrlContents',$sUrlContents);

        /** assigns for search functionality.**/
        $this->assign('sKeyword',$aArgs['keyword']);
        $this->assign('sFieldSearch',$aArgs['field_search']);
        $this->assign('iRow',$aArgs['row']);
        $this->assign('sDateRange',(isset($aArgs['date_range'])) ? $aArgs['date_range'] : 'currentMonth');
        $this->assign('sStartDate',(!isset($aArgs['start_date'])) ? date("Y/m/") . '01' : $aArgs['start_date']);
        $this->assign('sEndDate',(!isset($aArgs['end_date'])) ? date("Y/m/t") : $aArgs['end_date']);
        /** assigns for search functionality.**/

        /** query string assigns. **/
        $this->assign('sSortType',($aArgs['type']=='asc') ? 'des' : 'asc');
        $this->assign('sQrySearch',$sQrySearch);
        $this->assign('sQryRow',$sQryRow);
        $this->assign('sQrySort',$sQrySort);
        $this->assign('sQryPage',$sQryPage);
        /** query string assigns. **/

        $this->assign('sSort',$aArgs['sort']);
        $this->assign('sPrefix',$sPrefix);
        $this->assign('sImagePath',$sImagePath);
        $this->assign('sPagination',(!$aData) ? '' : usbuilder()->pagination(count($aCount), $iLimit));
        $this->assign('aData',$aData);
        $this->view(__CLASS__);
    }
}
