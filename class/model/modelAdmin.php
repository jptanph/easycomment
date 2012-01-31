<?php
define('sPrefix','easycomment_');
define('EASYCOMMENT_CONTENTS' , sPrefix . 'contents');

class modelAdmin extends Model
{

    public function execGetContents()
    {
        $sSql = "SELECT * FROM " . EASYCOMMENT_CONTENTS;
        return $this->query($sSql);
    }
}