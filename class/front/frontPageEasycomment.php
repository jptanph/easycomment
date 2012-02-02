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
        $this->importJs(__CLASS__);

        $sHtml = '';
        $sHtml .= "<div id='sdk_easycomment_holder'>\n";
        $sHtml .="		<div id='sdk_easycomment_container'>\n";
        $sHtml .="			<p class='sdk_easycomment_header'><h3 class='sdk_easycomment_title'>Easycomment</h3></p>\n";
        $sHtml .="			<div class='sdk_easycomment_expand'>\n";
        $sHtml .="				<div class='leave_message2 fixed2'>\n";
        $sHtml .="					<a href='#none'  id='{$sPrefix}scrolling' onclick='PG_Easycomment_front.execLeaveMessage();return false;'>\n";
        $sHtml .="						<span>Leave Message</span>\n";
        $sHtml .="					</a>\n";
        $sHtml .="				</div>\n";
        $sHtml .="				<div class='sdk_easycomment_wrap' style='background-color:none'>\n";
        $sHtml .="					<div class='sdk_easycomment_content' style='background-color:{$bg_color}'>\n";
        $sHtml .="						<div class='{$sPrefix}move'></div>\n";
        $sHtml .="						<div id='{$sPrefix}loader'><img src='/_sdk/img/easycomment/comment-loader.gif'></div>\n";
        $sHtml .="						<ul id='{$sPrefix}main_comments'></ul>\n";
        $sHtml .="						<div class='see_more_comment' style='display:none !important;'>\n";
        $sHtml .="							<a href='#none' class='older_post' onclick='PG_Easycomment_front.execLimitComment();'><span>Show Comment <span id='{$sPrefix}per_comment'></span></span></a>\n";
        $sHtml .="							<div  class='loader_message'><img src='{$sImagePath}small-loader.gif' /></div>\n";
        $sHtml .="						</div>\n";
        $sHtml .="						<div class='comment_frm' id='{$sPrefix}comment_form' style='display:visible;'>\n";
        $sHtml .="							<h3 class='comment_frm_title'>Add Comment</h3>\n";
        $sHtml .="							<form>\n";
        $sHtml .="								<input type='hidden' id='{$sPrefix}show_comment' value='{$iShowComment}'>\n";
        $sHtml .="								<input type='hidden' id='{$sPrefix}limit' value='{$iShowComment}'>\n";
        $sHtml .="								<input type='hidden' id='{$sPrefix}server_url' value='{$sServerUrl}'>\n";
        $sHtml .="								<input type='hidden' id='{$sPrefix}page_url' value='{$sPageUrl}'>\n";
        $sHtml .="								<input type='hidden' id='{$sPrefix}plugin_url' value='{$sPluginUrl}'>\n";
        $sHtml .="								<label for='name'>Name:</label>\n";
        $sHtml .="								<input type='text' value='' id='{$sPrefix}name' class='name' />\n";
        $sHtml .="								<label for='comment'>Comments:</label>\n";
        $sHtml .="								<textarea class='comment'  id='{$sPrefix}comment' onkeydown='PG_Easycomment_front.execLimiter();'></textarea>\n";
        $sHtml .="								<p class='sdk_easycomment_textarea_count'><span class='sdk_easycomment_textarea_remaining' id='{$sPrefix}text_remaining'><!--1000</span>/<span class='sdk_easycomment_textarea_total'>1000</span>char</p>-->\n";
        $sHtml .="								<label for='name'>Password:</label>\n";
        $sHtml .="								<input type='password' value='' id='{$sPrefix}password' class='password' />\n";
        $sHtml .="								<div class='captcha'>\n";
        $sHtml .="									<label for='name' class='captcha_name'>Captcha:</label>\n";
        $sHtml .="										<div class='box'>\n";
        $sHtml .="										</div>\n";
        $sHtml .="									<br />\n";
        $sHtml .="									<label for='textinthebox'>Enter text:</label>\n";
        $sHtml .="									<input type='text' value='' id='{$sPrefix}captcha' class='textinthebox' />\n";
        $sHtml .="								</div>\n";
        $sHtml .="								<div class='sdk_easycomment'>\n";
        $sHtml .="									<p class='expandable_btn2' style='border-bottom:none;display:visible;' id='{$sPrefix}send'><a href='#none' onclick='PG_Easycomment_front.execSaveComment();'><span>Send</span></a></p>\n";
        $sHtml .="									<p class='expandable_btn4 ' style='border-bottom:none;display:none !important;' id='{$sPrefix}processing'><label><a><span class='no_cursor'>Processing...</span></a></label></p>\n";
        $sHtml .="								</div>\n";
        $sHtml .="							</form>\n";
        $sHtml .="						</div>\n";
        $sHtml .="					</div>\n";
        $sHtml .="				</div>\n";
        $sHtml .="			</div>\n";
        $sHtml .="	</div>\n";
        $sHtml .="</div>";

        $this->importCss(__CLASS__);
        $this->importJs('jquery.scrollTo-1.4.2');
        $this->assign('sVar',"<input type='text' value='" . $_SERVER['SCRIPT_URI'] . "' id='{$this->_sPrefix}current_url'>");
        $this->assign('easycomment',$sHtml);

    }
}