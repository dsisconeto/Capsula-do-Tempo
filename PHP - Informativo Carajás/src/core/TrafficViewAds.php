<?php

sysLoadClass("ActionTrafficViewAds");


class TrafficViewAds extends ActionTrafficViewAds
{


    public function register($adsId)
    {

        $this->setAdsId($adsId);
        $this->setUserIp($this->getIp());
        $this->setOs($this->captureOs());


        if (!isset($_COOKIE["ads_$adsId"])):

            if ($this->sqlInsert()):

                setcookie("ads_$adsId", "url", time() + 10);

                return true;

            else:
                return false;
            endif;

        else:

            return true;
        endif;
    }

}