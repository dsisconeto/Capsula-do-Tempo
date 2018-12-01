<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/05/16
 * Time: 12:52
 */
sysLoadClass("ActionTrafficClickAds");

class TrafficClickAds extends ActionTrafficClickAds
{


    public function register($adsId, $url)
    {
        if (!DjRequest::issetCookie("ads_click_$adsId")) {


            $this->setAdsId($adsId);
            $this->setTrafficClickAdsUrl($url);

            if ($this->sqlInsert()) {

                setcookie("ads_click_$adsId", "url", time() + 3600);

            }

        } else {

            return false;
        }
    }

}