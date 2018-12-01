<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 31/08/16
 * Time: 19:30
 */


sysLoadClass("NewsLocal");

class AdminServicesNewsLocal
{


    public function byId()
    {
        $newsLocal = new NewsLocal();

        return $newsLocal->sqlLoad(DjRequest::get("news_local_id", "int", 0));

    }


}