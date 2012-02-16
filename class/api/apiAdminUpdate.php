<?php

class apiAdminUpdate extends Controller_Api
{
    protected function post($aArgs)
    {
        return common()->modelAdmin()->execUpdate($aArgs);
    }
}