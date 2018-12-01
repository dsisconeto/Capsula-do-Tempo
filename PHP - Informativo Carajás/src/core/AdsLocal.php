<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 05/05/16
 * Time: 19:09
 */
sysLoadClass("ActionAdsLocal");

class AdsLocal extends ActionAdsLocal
{

    public function __construct()
    {
        $this->setMsg("não tem permissão", false, 1);

    }


    public function register()
    {


    }


    public function selectOrderByName($order = "ASC", $col = false)
    {
        if ($order == "DESC"):
        else:
            $order = "ASC";
        endif;

        $cri = new Criteria();
        $cri->setProperty("order", "ads_local_name " . $order);
        return $this->sqlSelect($cri, $col);

    }


}