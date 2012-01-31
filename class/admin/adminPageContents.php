<?php

require_once('builder/builderInterface.php');

class adminPageContents extends Controller_Admin
{
    protected function run($aArgs)
    {
        $this->view(__CLASS__);
    }
}