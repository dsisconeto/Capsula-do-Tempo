<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 28/10/16
 * Time: 06:42
 */
sysLoadClass("TrafficClickAds");

class ControllerAds extends DjView
{


    public function redirect()
    {

        $url = DjRequest::get("url", "str", "");
        $adsId = DjRequest::get("ads_id", "int", 0);
        $continue = DjRequest::get("continue", "str", 0);
        $click = new TrafficClickAds();

        $click->register($adsId, $url);


        header("location:$continue");
        exit();


    }


}