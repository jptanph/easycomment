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
        $sHtml .="				<div class='sdk_easycomment_wrap' style='background-color:none'>\n";
        $sHtml .="					<div class='sdk_easycomment_content' style='background-color:{$bg_color}'>\n";
        $sHtml .="						<div class='{$this->_sPrefix}move'></div>\n";
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
            $sHtml .="<table class='{$this->_sPrefix}add_comment_form'>\n";
            $sHtml .="<colgroup>\n";
            $sHtml .="<col width='100px' />\n";
            $sHtml .="<col />\n";
            $sHtml .="</colgroup>\n";
            $sHtml .="<tr><td><label>Name : </label></td><td><input type='text' value='' id='{$this->_sPrefix}name'></td></tr>\n";
            $sHtml .="<tr><td><label>Comment : </label></td><td><textarea   id='{$this->_sPrefix}comment'></textarea></td></tr>\n";
            $sHtml .="<tr><td><label>Password : </label></td><td><input type='password' value='' id='{$this->_sPrefix}password'></td></tr>\n";
            $sHtml .="<tr><td><label>Captcha : </label></td><td><div class='box'></div><p class='expandable_btn2' style='border-bottom:none;margin:0 5px 0 15px !important;width:48px;display:inline !important;' id='{$sPrefix}send'><a href='#none' onclick='frontPageEasycomment.execRefreshCaptcha();'><span>Change</span></a></p></td></tr>\n";
            $sHtml .="<tr><td><label>Enter captcha : </label></td><td><input type='text' id='{$this->_sPrefix}captcha'></td></tr>\n";
            $sHtml .="</table>\n";
        $sHtml .="								<div class='sdk_easycomment'>\n";
        $sHtml .="									<p class='expandable_btn2' style='border-bottom:none;display:visible;' id='{$sPrefix}send'><a href='#none' onclick='frontPageEasycomment.execSaveComment();'><span>Send</span></a></p>\n";
        $sHtml .="									<p class='expandable_btn4 ' style='border-bottom:none;display:none !important;' id='{$sPrefix}processing'><label><a><span class='no_cursor'>Processing...</span></a></label></p>\n";
        $sHtml .="								</div>\n";
        $sHtml .="							</form>\n";
        /*
        $sHtml .="							<form name='test_form' id='test_form'>\n";
        $sHtml .="								<input type='hidden' id='{$this->_sPrefix}show_comment' value='{$iShowComment}'>\n";
        $sHtml .="								<input type='hidden' id='{$this->_sPrefix}limit' value='{$aResult['comment_limit']}'>\n";
        $sHtml .="								<input type='hidden' id='{$this->_sPrefix}current_url' value='{$_SERVER['SCRIPT_URI']}'>\n";
        $sHtml .="								<label for='name'>Name:</label>\n";
        $sHtml .="								<input type='text' value='' id='{$this->_sPrefix}name' class='name' />\n";
        $sHtml .="								<label for='comment'>Comments:</label>\n";
        $sHtml .="								<textarea class='comment'  id='{$this->_sPrefix}comment'></textarea>\n";
        $sHtml .="								<p class='sdk_easycomment_textarea_count'><span class='sdk_easycomment_textarea_remaining' id='{$sPrefix}text_remaining'><!--1000</span>/<span class='sdk_easycomment_textarea_total'>1000</span>char</p>-->\n";
        $sHtml .="								<label for='name'>Password:</label>\n";
        $sHtml .="								<input type='password' value='' id='{$this->_sPrefix}password' class='password' />\n";
        $sHtml .="								<div class='captcha'>\n";
        $sHtml .="									<label for='name' class='captcha_name'>Captcha:</label>\n";
        $sHtml .="										<div class='box'></div>\n";
        $sHtml .="									<br />\n";
        $sHtml .="									<label for='textinthebox'>Enter text:</label>\n";
        $sHtml .="									<input type='text' value='' id='{$this->_sPrefix}captcha' class='textinthebox' />\n";
        $sHtml .="								</div>\n";
        $sHtml .="								<div class='sdk_easycomment'>\n";
        $sHtml .="									<p class='expandable_btn2' style='border-bottom:none;display:visible;' id='{$sPrefix}send'><a href='#none' onclick='frontPageEasycomment.execSaveComment();'><span>Send</span></a></p>\n";
        $sHtml .="									<p class='expandable_btn4 ' style='border-bottom:none;display:none !important;' id='{$sPrefix}processing'><label><a><span class='no_cursor'>Processing...</span></a></label></p>\n";
        $sHtml .="								</div>\n";
        $sHtml .="							</form>\n";
        */
        $sHtml .="						</div>\n";
        $sHtml .="					</div>\n";
        $sHtml .="				</div>\n";
        $sHtml .="			</div>\n";
        $sHtml .="	</div>\n";
        $sHtml .="</div>";

        $this->assign('sVar',"<input type='text' value='" . $_SERVER['SCRIPT_URI'] . "' id='{$this->_sPrefix}current_url'>");
        $this->assign('easycomment',$sHtml);
    }
}