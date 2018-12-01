<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 13/04/16
 * Time: 10:58
 */
sysLoadClass("ModelTrafficViewAds");

class ActionTrafficViewAds extends ModelTrafficViewAds
{
    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("traffic_view_ads");
        $sql->setRowData("ads_id", $this->getAdsId());
        $sql->setRowData("user_ip", $this->getUserIp());
        $sql->setRowData("os", $this->getOs());
        $sql->setRowData("traffic_view_ads_date_insert", DjWork::currentTime());
        return $this->runQuery($sql);

    }

    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("traffic_view_ads");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }


}