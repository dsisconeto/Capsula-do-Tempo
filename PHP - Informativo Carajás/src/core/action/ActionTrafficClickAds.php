<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 13/04/16
 * Time: 10:23
 */
sysLoadClass("ModelTrafficClickAds");
class ActionTrafficClickAds extends ModelTrafficClickAds
{
    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("traffic_click_ads");

        $sql->setRowData("ads_id", $this->getAdsId());
        $sql->setRowData("traffic_click_ads_url", $this->getTrafficClickAdsUrl());
        $sql->setRowData("traffic_click_ads_os", $this->captureOs());
        $sql->setRowData("traffic_click_ads_ip", $this->getIp());
        $sql->setRowData("traffic_click_ads_date_Insert", DjWork::currentTime());

        return $this->runQuery($sql);
    }


    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("traffic_click_ads");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }



}