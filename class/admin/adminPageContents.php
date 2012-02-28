<?php
require_once('builder/builderInterface.php');

class adminPageContents extends Controller_Admin
{
    protected function run($aArgs)
    {
        $aData = array();
        $iQryStrStatus = 0;
        $iLimit = (isset($aArgs['row'])) ? $aArgs['row'] : 20;
        $sPrefix = $this->Request->getAppID() . '_';
        $sImagePath = '/_sdk/img/' . $this->Request->getAppID() . '/';
        /** usbuilder initializer.**/
       // $sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
        usbuilder()->init($this, $aArgs);
        usbuilder()->getFormAction($this->_sPrefix . 'edit_comment_form','');
        usbuilder()->validator(array('form' => $this->_sPrefix . 'add_form'));
        /** usbuilder initializer.**/

        $sUrlContents = usbuilder()->getUrl('adminPageContents');


        if(isset($aArgs['search'])){
            if($aArgs['search']!=='init'){
                usbuilder()->jsMove($sUrlContents);
                $iQryStrStatus +=1;
            }else{
                if(
                        !isset($aArgs['keyword']) ||
                        !isset($aArgs['start_date']) ||
                        !isset($aArgs['end_date']) ||
                        !isset($aArgs['date_range']) ||
                        !isset($aArgs['field_search'])
                )
                {
                    usbuilder()->jsMove($sUrlContents);
                    $iQryStrStatus +=1;
                }
            }
        }

        if(isset($aArgs['row']))
        {

            if(
                    !is_numeric($aArgs['row']) ||
                    $aArgs['row'] !=='10' &&
                    $aArgs['row'] !=='20' &&
                    $aArgs['row'] !=='30' &&
                    $aArgs['row'] !=='50' &&
                    $aArgs['row'] !=='100'
            )
            {
               usbuilder()->jsMove($sUrlContents);
                $iQryStrStatus +=1;
            }
        }

        /** FOR DATE RANGE. **/
        if(isset($aArgs['date_range']))
        {
            if(
                    trim($aArgs['date_range'])!=='today' &&
                    trim($aArgs['date_range'])!=='currentMonth' &&
                    trim($aArgs['date_range'])!=='currentWeek' &&
                    trim($aArgs['date_range'])!=='custom'
            )
            {
                usbuilder()->jsMove($sUrlContents);
                $iQryStrStatus +=1;
            }
            else
            {
                /** ok here.**/
            }
        }
        /** FOR DATE RANGE. **/

        /** FOR DATE **/
        if(isset($aArgs['start_date']) || isset($aArgs['end_date']))
        {
            if(!$this->checkDateFormat($aArgs['start_date']) && $this->checkDateFormat($aArgs['end_date']))
            {
                usbuilder()->jsMove($sUrlContents);
                $iQryStrStatus +=1;
            }
        }
        /** FOR DATE **/

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
            '';

        if($iQryStrStatus==0)
        {
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
               " WHERE t_contents.seq = {$aArgs['seq']} AND " . (($aArgs['field_search']=='url') ? " t_url.url " : $aArgs['field_search'] ) . " LIKE '%" . trim($aArgs['keyword']) . "%' AND DATE_FORMAT(FROM_UNIXTIME(t_contents.comment_date),'%Y/%m/%d') BETWEEN '" . $aArgs['start_date'] . "' AND '" . $aArgs['end_date'] . "' "
               :
               " WHERE t_contents.seq = {$aArgs['seq']}";
            $sOrderBy = (isset($aArgs['sort']) && isset($aArgs['type']))
                ?
                " ORDER BY " . (($aArgs['sort']=='url') ? "t_url.url" : $aArgs['sort'] ) . " " . (($aArgs['type']=='des' ) ? " DESC " : " ASC ")
                : " ORDER BY comment_date DESC ";
            $sLimit = (isset($aArgs['page'])) ?  " LIMIT $iRow, $iLimit" :  " LIMIT $iLimit ";
            $sInnerJoin = (
                isset($aArgs['keyword']) &&
                isset($aArgs['start_date']) &&
                isset($aArgs['end_date']) &&
                isset($aArgs['field_search']) &&
                isset($aArgs['date_range'])
                )
               ?
               " AS t_contents INNER JOIN easycomment_url as t_url ON t_url.idx = t_contents.url_idx "
               :
               "";
            /** queries for model.**/


            $aResult = common()->modelAdmin()->execGetContents($sSearchWhere,$sOrderBy,$sLimit);
            $aCount = common()->modelAdmin()->execGetCount($sInnerJoin,$sSearchWhere);
            $iResult = count($aCount);
            $iIncRow = 0;

            foreach($aResult as $rows)
            {
                $aData[] = array(
                    'row' => (($iPage==1) ? ( $iResult - $iIncRow ) : ($iResult-$iRow) - $iIncRow),
                    'idx' => $rows['idx'],
                    'url_idx' => $rows['url_idx'],
                    'url' => $rows['url'],
                    'user_type' => $rows['user_type'],
                    'name' => $rows['visitor_name'],
                    'comment' => $rows['visitor_comment'],
                    'password' => $rows['password'],
                    'comment_date' => date('m/d/Y :H:i:s', $rows['date_posted'])
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
            $this->assign('iSeq',$aArgs['seq']);
            $this->view(__CLASS__);
        }
    }

    private function checkDateFormat($sDate)
    {
        return preg_match( '`^\d{4}/\d{1,2}/\d{1,2}$`', $sDate );
    }
}
