<?php
require_once('builder/builderInterface.php');

class frontPageEasycomment extends Controller_Front
{
    private $_sPrefix;
    private $_sImagePath;

    protected function run($aArgs)
    {
        $this->_sImagePath = '/_sdk/img/' . $this->Request->getAppID() . '/';
        $this->_sPrefix = $this->Request->getAppID() . '_';
        /** usbuilder initializer.**/
        $sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
        $this->writeJs($sInitScript);
        /** usbuilder initializer.**/

        $model = new modelFront();
        $aResult = $model->execGetSettings();

        $this->importJs('jquery.scrollTo-1.4.2');
        $this->importJs('jquery.scrollto');
        $this->importJs('jquery.realperson');
        $this->importJs(__CLASS__);
        $this->importCss('jquery.realperson');
        $this->importCss(__CLASS__);
        $sHtml = '';
        $sHtml .= "<div id='sdk_easycomment_holder'>\n";
        $sHtml .="		<div id='sdk_easycomment_container'>\n";
        $sHtml .="			<p class='sdk_easycomment_header'></p>\n";
        $sHtml .="			<div class='sdk_easycomment_expand'>\n";
        $sHtml .="				<div class='leave_message2 fixed2'>\n";
        $sHtml .="					<a href='#none'  id='{$this->_sPrefix}scrolling' onclick='frontPageEasycomment.execLeaveMessage();return false;'>\n";
        $sHtml .="						<span>Leave Message</span>\n";
        $sHtml .="					</a>\n";
        $sHtml .="				</div>\n";
        $sHtml .="				<div class='sdk_easycomment_wrap'>\n";
        $sHtml .="					<div class='sdk_easycomment_content' style='background-color:{$aResult['background_color']}'>\n";
        $sHtml .="						<div id='{$sPrefix}loader'style='display:none;' ><img src='/_sdk/img/easycomment/comment-loader.gif'></div>\n";
        $sHtml .="						<ul id='{$this->_sPrefix}main_comments'></ul>\n";
        $sHtml .="						<div class='see_more_comment' style='display:none !important;'>\n";
        $sHtml .="							<span id='limit_option_area'><a href='#none' class='older_post' onclick='frontPageEasycomment.execLimitComment();'><span>Show Comment <span id='{$this->_sPrefix}per_comment'></span></span></a></span>\n";
        $sHtml .="							<div class='loader_message'><img src='{$this->_sImagePath}small-loader.gif' /></div>\n";
        $sHtml .="						</div>\n";
        $sHtml .="						<div class='comment_frm' id='{$this->_sPrefix}comment_form' style='display:none !important;'>\n";
        $sHtml .="							<h3 class='comment_frm_title'>Add Comment </h3>\n";
        $sHtml .="							<form name='test_form' id='test_form'>\n";
        $sHtml .="								<input type='hidden' id='{$this->_sPrefix}show_comment' value='{$iShowComment}'>\n";
        $sHtml .="								<input type='hidden' id='{$this->_sPrefix}limit' value='{$aResult['comment_limit']}'>\n";
        $sHtml .="								<input type='hidden' id='{$this->_sPrefix}current_url' value='{$_SERVER['SCRIPT_URI']}'>\n";
        $sHtml .="								<div class='sdk_easycomment'>\n";
        $sHtml .="									<p class='expandable_btn2' style='border-bottom:none;display:visible;' id='{$sPrefix}send'><a href='#none' onclick='frontPageEasycomment.execSaveComment();'><span>Send</span></a></p>\n";
        $sHtml .="									<p class='expandable_btn4 ' style='border-bottom:none;display:none !important;' id='{$sPrefix}processing'><label><a><span class='no_cursor'>Processing...</span></a></label></p>\n";
        $sHtml .="								</div>\n";
        $sHtml .="							</form>\n";
        $sHtml .="						</div>\n";
        $sHtml .="					</div>\n";
        $sHtml .="				</div>\n";
        $sHtml .="			</div>\n";
        $sHtml .="	    </div>\n";
        $sHtml .="</div>";

        $this->assign('sVar',"<input type='text' value='" . $_SERVER['SCRIPT_URI'] . "' id='{$this->_sPrefix}current_url'>");
        $this->assign('easycomment',$sHtml);
    }
}