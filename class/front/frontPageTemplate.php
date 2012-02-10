<?php
require_once('builder/builderInterface.php');

class frontPageTemplate extends Controller_Front
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

        $sHtml = "";
        $sHtml .= " <div class='{$this->_sPrefix}wrapper'>\n";
        $sHtml .= " 	<div class='{$this->_sPrefix}header'></div>\n";
        $sHtml .= "	    <div class='{$this->_sPrefix}contents'>\n";
        $sHtml .= " 		<ul class='{$this->_sPrefix}comments'>\n";

        for($i = 1;  $i < 10 ; $i++)
        {
            $sHtml .= "            <li>";
            $sHtml .= "                <div class='{$this->_sPrefix}author'><span class='{$this->_sPrefix}author_name'>joihn Adrian tan</span><span class='{$this->_sPrefix}date'>2012/08/02 17:56:53</span></div>";
            $sHtml .= "                <p class='{$this->_sPrefix}delete_icon'><a href='#none'></a></p>";
            $sHtml .= "                <p class='{$this->_sPrefix}text'>teasddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddasdddddddddddddddddddddddddddddxt</p>";
            $sHtml .= "                <div class='{$this->_sPrefix}delete_comment'>\n";
            $sHtml .= "                    <label>Password : </label><input type='password' class='delete_li_password'/> <p class='expandable_btn' style='border-bottom:none;display:visible;' id='{$sPrefix}send'><a href='#none' onclick='frontPageEasycomment.execSaveComment();'><span>Delete</span></a></p>";
            $sHtml .= "                </div>\n";
            $sHtml .= "            </li>\n";
        }

        $sHtml .= "         </ul>\n";
        $sHtml .= "	    </div>\n";
        $sHtml .= "	    <div class='{$this->_sPrefix}add_comment'>\n";
        $sHtml .= "		   <h3>Add Comment</h3>\n";
        $sHtml .= "		       <p><label>Name : </label><input type='text'  class='add_comment_text'></p>\n";
        $sHtml .= "		       <p><label>Comment : </label><textarea></textarea></p>\n";
        $sHtml .= "		       <p><label>Password : </label><input type='password' class='add_comment_password'></p>\n";
        $sHtml .= "		       <p><label>Captcha : </label><span>SASDASDASDASDASD</span></p>\n";
        $sHtml .= "		       <p><label>Enter Captcha : </label><input type='text' class='add_comment_text'></p>\n";

        $sHtml .= "	    </div>\n";
        $sHtml .= "</div>\n";
        $this->importCss(__CLASS__);
        $this->assign('stest',$sHtml);
    }
}