<?php

namespace App\Controllers\Services\Admin;

use App\Models\News\ContentImg;
use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;

class ServicesNewsContentImg
{

    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"), array(1));
    }

    public function selectByUser()
    {
        $newsImg = new ContentImg();
        $cri = new Criteria();
        $cri->setProperty("order", "news_content_img_id DESC");
        $cri->setProperty("limit", 8);
        $cri->add(New Filter("system_user_id_fk", "=", Login::user()->getId()));

        return $newsImg->select($cri);
    }

}