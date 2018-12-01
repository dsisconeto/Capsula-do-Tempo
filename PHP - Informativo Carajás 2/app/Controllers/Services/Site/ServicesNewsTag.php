<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 09/05/17
 * Time: 23:25
 */

namespace App\Controllers\Services\Site;


use App\Models\News\Tag;
use DSisconeto\Simple\Request;

class ServicesNewsTag
{


    public function byCategory()
    {

        $tag = new Tag();
        $col= array("news_tag_id", "news_tag_name");
        $tag->category()->setId(Request::get("news_category_id", "int", 0));

        return $tag->selectByCategory($col);
    }

}