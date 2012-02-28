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
        usbuilder()->init($this, $aArgs);
        /** usbuilder initializer.**/

        $iSequence = $this->getSequence();

        $aSettings = array();
        $aResult = common()->modelFront()->execGetSettings($iSequence);
        if($aResult){
            $aSettings = $aResult;
        }else{
            common()->modelFront()->initDefault($iSequence);
            $aSettings = common()->modelFront()->execGetSettings($iSequence);
        }

        $aDataUrl = array('page_url' => $_SERVER['SCRIPT_URI']);
        $aUrl = common()->modelFront()->execGetUrl($aDataUrl);
        $aCountUrlComment = common()->modelFront()->execGetCommentsCount($aUrl['idx'],$iSequence);

        $this->importJs('jquery.realperson');
        $this->importJs(__CLASS__);
        $this->importCss('frontPageTemplate');
        $this->importCss('jquery.realperson');

        $sHtml = "";
        $sHtml .= " <div class='{$this->_sPrefix}wrapper' id='{$this->_sPrefix}wrapper' >\n";
        $sHtml .= " 	<div class='{$this->_sPrefix}header'></div>\n";
        $sHtml .= "	    <div class='{$this->_sPrefix}contents'>\n";
        $sHtml .= " 		<ul class='{$this->_sPrefix}comments' id='{$this->_sPrefix}main_comments' style='background:{$aSettings['background_color']};height:" . (($aSettings['comment_limit']< 10) ? '' : '370px !important') . "'></ul>\n";
        $sHtml .= "	    </div>\n";
        $sHtml .= "	    <div class='{$this->_sPrefix}add_comment' style='display:none;' id='{$this->_sPrefix}add_comment'>\n";
        $sHtml .= "		   <h3>Add Comment</h3>\n";
        $sHtml .="<form>";
        $sHtml .="<input type='hidden' id='{$this->_sPrefix}seq' value='{$iSequence}'>\n";
        $sHtml .="<input type='hidden' id='{$this->_sPrefix}show_comment' value='{$iShowComment}'>\n";
        $sHtml .="<input type='hidden' id='{$this->_sPrefix}limit' value='{$aSettings['comment_limit']}'>\n";
        $sHtml .="<input type='hidden' id='{$this->_sPrefix}current_url' value='{$_SERVER['SCRIPT_URI']}'>\n";
        $sHtml .= "		       <p><label>Name : </label><input type='text' id='{$this->_sPrefix}name' class='add_comment_text'></p>\n";
        $sHtml .= "		       <p><label>Comment : </label><textarea id='{$this->_sPrefix}comment'></textarea></p>\n";
        $sHtml .= "		       <p><label>Password : </label><input type='password' id='{$this->_sPrefix}password' class='add_comment_password'></p>\n";
        $sHtml .= "		       <p><label>Captcha : </label><div class='input_captcha'></div><p style='margin-left:4px;' class='expandable_btn_change' style='border-bottom:none;display:visible;' ><a href='#none' onclick='frontPageEasycomment.execRefreshCaptcha();'><span>Change</span></a></p></p>\n";
        $sHtml .= "		       <p><label>Enter Captcha : </label><input type='text' id='{$this->_sPrefix}captcha' class='add_comment_text'></p>\n";
        $sHtml .="</form>";
         $sHtml .="	<p class='expandable_btn_submit' style='border-bottom:none;display:visible;' id='{$this->_sPrefix}send'><a href='#none' onclick='frontPageEasycomment.execSaveComment();'><span>Send</span></a></p>\n";
        $sHtml .= "	    </div>\n";
        $sHtml .= "</div>\n";


        $this->assign('sVar',"<input type='text' value='" . $_SERVER['SCRIPT_URI'] . "' id='{$this->_sPrefix}current_url'>");
        $this->assign('easycomment',$sHtml);
    }
}