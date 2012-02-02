<?php
require_once('builder/builderInterface.php');

class frontPageEasycomment extends Controller_Front
{
    protected function run($aArgs)
    {

       $this->assign('sVar',$_SERVER['SCRIPT_URI']);
    }
}