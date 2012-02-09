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

        for($i = 1;  $i < 20 ; $i++)
        {
            $sHtml .= "            <li>";
            $sHtml .= "                <div class='{$this->_sPrefix}author'><span class='{$this->_sPrefix}author_name'>joihn Adrian tan</span><span class='{$this->_sPrefix}date'>2012-02-02 01:00</span></div>";
            $sHtml .= "                <p class='{$this->_sPrefix}delete_icon'><a href='#'></a></p>";
            $sHtml .= "                <p class='{$this->_sPrefix}text'>text</p>";
            $sHtml .= "                <div class='{$this->_sPrefix}delete_comment'>\n";
            $sHtml .= "delete";
            $sHtml .= "                </div>\n";
            $sHtml .= "            </li>\n";
        }

        $sHtml .= "         </ul>\n";
        $sHtml .= "	    </div>\n";
        $sHtml .= "	    <div>\n";
        $sHtml .= "		    form here\n";
        $sHtml .= "	    </div>\n";
        $sHtml .= "</div>\n";
        $this->importCss(__CLASS__);
        $this->assign('stest',$sHtml);
    }
}