<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 05/10/16
 * Time: 21:39
 */

sysLoadClass("ModelGeoRegionUserPermission");

class ActionGeoRegionUserPermission extends ModelGeoRegionUserPermission
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("geo_region_user_permission");
        $sql->setRowData("system_user_id_fk", $this->getSystemUserIdFk());
        $sql->setRowData("geo_region_id_fk", $this->getGeoRegionIdFk());
        $sql->setRowData("news", $this->getNews());
        $sql->setRowData("newspaper", $this->getNewspaper());
        $sql->setRowData("event", $this->getEvent());
        $sql->setRowData("company", $this->getCompany());
        $sql->setRowData("ads", $this->getAds());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('geo_region_user_permission');
        $criteria->add(New Filter('system_user_id_fk', '=', "{$this->getSystemUserIdFk()}"));
        $criteria->add(New Filter('geo_region_id_fk', '=', "{$this->getGeoRegionIdFk()}"));

        $sql->setRowData("news", $this->getNews());
        $sql->setRowData("newspaper", $this->getNewspaper());
        $sql->setRowData("event", $this->getEvent());
        $sql->setRowData("company", $this->getCompany());
        $sql->setRowData("ads", $this->getAds());

        return $this->runQuery($sql);
    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $criteria = new Criteria();
        $sql->setEntity("geo_region_user_permission");
        $criteria->add(New Filter('system_user_id_fk', '=', "{$this->getSystemUserIdFk()}"));
        $criteria->add(New Filter('geo_region_id_fk', '=', "{$this->getGeoRegionIdFk()}"));
        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }


    public function sqlSelect(Criteria $criteria = null, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("geo_region_user_permission");
        $sql->addColumn($col);

        $sql->setJoin("geo_region_user_permission", "geo_region", "geo_region_id_fk", "geo_region_id");

        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }


    public function sqlLoad($geoRegionId, $userId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('system_user_id_fk', '=', $userId));
        $criteria->add(New Filter('geo_region_id_fk', '=', $geoRegionId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        if ($res):

            $res = $res[0];
            $this->setSystemUserIdFk($res["system_user_id_fk"]);
            $this->setGeoRegionIdFk($res["geo_region_id_fk"]);
            $this->setNews($res["news"]);
            $this->setNewspaper($res["newspaper"]);
            $this->setEvent($res["event"]);
            $this->setCompany($res["company"]);
            $this->setAds($res["ads"]);


        endif;

        return $res;
    }


}