<?php

namespace App\Controllers\Services\Admin;

use App\Models\Event\Gallery;
use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;

class ServicesEventGallery
{


    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"), array(4));
    }


    public function byEvent()
    {
        $gallery = new Gallery();
        $gallery->event()->setId(Request::get("event_id"));
        if ($gallery->event()->validateByUser($gallery->event()->getId())) {


            $cri = new Criteria();
            $cri->add(new Filter("event_id", "=", $gallery->event()->getId()));
            $cri->setProperty("order", "event_gallery_order ASC");
            $col[] = "event_gallery_id";
            $col[] = "event_gallery_file";
            return $gallery->select($cri, $col);
        }

        return array();
    }

}