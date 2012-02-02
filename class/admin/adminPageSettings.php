<?php

class adminPageSettings extends Controller_Admin
{
    protected function run($aArgs)
    {
        $this->importCss(__CLASS__);
        $this->view(__CLASS__);
    }
}
