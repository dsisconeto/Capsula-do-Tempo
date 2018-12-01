<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 20/05/2016
 * Time: 10:05
 */
sysLoadClass("ActionNewsLocal");

class NewsLocal extends ActionNewsLocal
{


    public function selectOrderByName()
    {
        $cri = new Criteria();

        $cri->setProperty("order", "news_local_name ASC");
        return $this->sqlSelect($cri);
    }
}