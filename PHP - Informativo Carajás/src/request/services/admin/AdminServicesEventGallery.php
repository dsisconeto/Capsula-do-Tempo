<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 28/08/16
 * Time: 17:27
 */

sysLoadClass("EventGallery");


class AdminServicesEventGallery
{


    public function byEvent()
    {

        $gallery = new EventGallery();

        $cri = new Criteria();
        $cri->add(new Filter("event_id", "=", DjRequest::get("event_id")));
        $cri->setProperty("order", "event_gallery_order ASC");
        $col[] = "event_gallery_id";
        $col[] = "event_gallery_file";

        return $gallery->sqlSelect($cri, $col);


    }

}