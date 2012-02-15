<?php
require_once('builder/common.function.php');
require_once('builder/filterClass.php');

class apiFrontComments extends Controller_Api
{
    private $_oFilter;

    protected function post($aArgs)
    {
       $aData = array();
       $aRepWord = array("***");
       $model = new modelFront();
       $this->_oFilter = new Filter_class();
       $aUrl = $model->execGetUrl($aArgs);
       $aSettings = $model->execGetSettings();
       $aFilterData = explode('|',@$aSettings['unauthorized_word']);
       $this->_oFilter->set_filter($aFilterData,$aRepWord);

       $sLimit = " LIMIT " . (isset($aArgs['limit']) ? $aArgs['limit'] : (($aSettings['post_count']) ? $aSettings['post_count']: 3));

       $aResult = $model->execGetComments($aUrl['idx'],$sLimit);
       $aCount = $model->execGetCommentsCount($aUrl['idx']);


       foreach($aResult as $rows)
       {
            $aData['list'][] = array(
                'idx' => $rows['idx'],
                'url_idx' => $rows['url_idx'],
                'visitor_name' => $rows['visitor_name'],
                'visitor_comment' => $this->_oFilter->filter_word(limitChar($rows['visitor_comment'],300)),
                'user_type' => $rows['user_type'],
                'password' => $rows['password'],
                'comment_date' => $rows['comment_date'],
                'date_posted' => $rows['date_posted'],
                'comment_length' => strlen($rows['visitor_comment']),
                'bg_color' => $aSettings['background_color'],
                'text_color' => $aSettings['text_color'],
                'header_color' => $aSettings['header_color'],
                'htext_color' => $aSettings['header_text_color'],
                'ua_word' => $aSettings['unauthorized_word']
            );
       }

       $aData['total_comment'] = count($aCount);

       return $aData;
    }
}