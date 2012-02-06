<?php

class apiFrontComments extends Controller_Api
{
    protected function post($aArgs)
    {
       $aData = array();
       $model = new modelFront();
       $aUrl = $model->execGetUrl($aArgs);
       $aSettings = $model->execGetSettings();

       $sLimit = " LIMIT " . (isset($aArgs['limit']) ? $aArgs['limit'] : (($aSettings['post_count']) ? $aSettings['post_count']: 3));

       $aResult = $model->execGetComments($aUrl['idx'],$sLimit);
       $aCount = $model->execGetCommentsCount($aUrl['idx']);

       foreach($aResult as $rows)
       {
            $aData['list'][] = array(
                'idx' => $rows['idx'],
                'url_idx' => $rows['url_idx'],
                'visitor_name' => $rows['visitor_name'],
                'visitor_comment' => $rows['visitor_comment'],
                'user_type' => $rows['user_type'],
                'password' => $rows['password'],
                'comment_date' => $rows['comment_date'],
                'date_posted' => $rows['date_posted']
            );
       }

       $aData['total_comment'] = count($aCount);

       return $aData;
    }
}