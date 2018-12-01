<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 27/07/2016
 * Time: 17:06
 */

sysLoadClass("ActionEventCategory");

class EventCategory extends ActionEventCategory
{


    public function selectOrderByName()
    {
        $cri = new Criteria();
        $cri->setProperty("order", "event_category_name ASC");


        return $this->sqlSelect($cri);
    }

}