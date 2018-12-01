<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 18/08/2016
 * Time: 00:43
 */
sysLoadClass("ModelSystemConfigGeoRegion");

class ActionSystemConfigGeoRegion extends ModelSystemConfigGeoRegion
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("system_config_geo_region");

        $sql->setRowData("geo_region_id_fk", $this->getGeoRegionIdFk());
        $sql->setRowData("company_view", $this->getCompanyView());
        $sql->setRowData("event_view", $this->getEventView());
        $sql->setRowData("newspaper_view", $this->getNewspaperView());

        return $this->runQuery($sql);
    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $cri = new Criteria();
        $sql->setEntity("system_config_geo_region");
        $cri->add(new Filter("geo_region_id_fk", "=", $this->getGeoRegionIdFk()));
        $sql->setCriteria($cri);

        $sql->setRowData("company_view", $this->getCompanyView());
        $sql->setRowData("event_view", $this->getEventView());
        $sql->setRowData("newspaper_view", $this->getNewspaperView());



        return $this->runQuery($sql);
    }


    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("system_config_geo_region");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);

        return $this->runSelect($sql);

    }


    public function sqlLoadByGeoRegion($geoRegionId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('geo_region_id_fk', '=', $geoRegionId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setGeoRegionIdFk($res["geo_region_id_fk"]);
            $this->setCompanyView($res["company_view"]);
            $this->setEventView($res["event_view"]);
            $this->setNewspaperView($res["newspaper_view"]);
        endif;

        return $res;


    }


}