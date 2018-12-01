<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 31/08/16
 * Time: 19:26
 */

sysLoadClass("NewsTag");


class AdminServicesNewsTag
{


    public function selectByCategory()
    {
        $newsTag = new NewsTag();

        return $newsTag->selectByCategory(DjRequest::get("news_category_id", "int", 0));
    }


}