<?php
require_once('builder/builderInterface.php');

class frontPageCommentForm extends Controller_Front
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
        $aDataUrl = array('page_url' => $_SERVER['SCRIPT_URI']);
        $aUrl = $model->execGetUrl($aDataUrl);
        $aCountUrlComment = $model->execGetCommentsCount($aUrl['idx']);

        $this->importJs('jquery.scrollTo-1.4.2');
        $this->importJs('jquery.scrollto');
        $this->importJs('jquery.realperson');
        $this->importJs(__CLASS__);
        $this->importCss('jquery.realperson');
        $this->importCss('frontPageTemplate');

        $sHtml = "";

        $sHtml .="";
        $sHtml .= " <div class='{$this->_sPrefix}wrapper'>\n";
        $sHtml .= "	    <div class='{$this->_sPrefix}add_comment'>\n";
        $sHtml .= "		   <h3>Add Comment</h3>\n";
        $sHtml .="<form>";
        $sHtml .="<input type='hidden' id='{$this->_sPrefix}show_comment' value='{$iShowComment}'>\n";
        $sHtml .="<input type='hidden' id='{$this->_sPrefix}limit' value='{$aResult['comment_limit']}'>\n";
        $sHtml .="<input type='hidden' id='{$this->_sPrefix}current_url' value='{$_SERVER['SCRIPT_URI']}'>\n";
        $sHtml .= "		       <p><label>Name : </label><input type='text' id='{$this->_sPrefix}name' class='add_comment_text'></p>\n";
        $sHtml .= "		       <p><label>Comment : </label><textarea id='{$this->_sPrefix}comment'></textarea></p>\n";
        $sHtml .= "		       <p><label>Password : </label><input type='password' id='{$this->_sPrefix}password' class='add_comment_password'></p>\n";
        $sHtml .= "		       <p><label>Captcha : </label><span><div class='input_captcha'></div></span></p>\n";
        $sHtml .= "		       <br /><p><label>Enter Captcha : </label><input type='text' id='{$this->_sPrefix}captcha' class='add_comment_text'></p>\n";
        $sHtml .="</form>";
         $sHtml .="	<p style='margin-left:4px;' class='expandable_btn_submit' style='border-bottom:none;display:visible;' id='{$this->_sPrefix}send'><a href='#none' onclick='frontPageEasycomment.execSaveComment();'><span>Send</span></a></p>\n";
        $sHtml .= "	    </div>\n";
        $sHtml .= "</div>\n";
        $this->assign('easycomment',$sHtml);
    }
}