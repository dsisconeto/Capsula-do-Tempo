<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/05/16
 * Time: 21:30
 */
sysLoadClass("ModelGeoRegion");

class ActionGeoRegion extends ModelGeoRegion
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("geo_region");
        $sql->setRowData("geo_region_id", $this->getId());
        $sql->setRowData("geo_region_name", $this->getName());
        $sql->setRowData("geo_region_level", $this->getLevel());
        $sql->setRowData("system_user_id_register", $this->getUserId());
        $sql->setRowData("geo_region_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('geo_region');
        $criteria->add(New Filter('geo_region_id', '=', "{$this->getId()}"));
        $sql->setCriteria($criteria);
        $sql->setRowData("geo_region_name", $this->getName());

        return $this->runQuery($sql);
    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("geo_region");
        $cri = new Criteria();
        $cri->add(New Filter("geo_region", "=", $this->getId()));
        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }


    public function sqlSelectConfig($criteria = null,$col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("geo_region");
        $sql->addColumn($col);

        $sql->setJoin("geo_region", "system_config_geo_region", "geo_region_id", "geo_region_id_fk" );


        if ($criteria):
            $sql->setCriteria($criteria);
        endif;


        return $this->runSelect($sql);




    }

    public function sqlSelect(Criteria $criteria = null, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("geo_region");
        $sql->addColumn($col);


        if ($criteria):
            $sql->setCriteria($criteria);
        endif;


        return $this->runSelect($sql);
    }


    public function sqlLoad($geoRegionId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('geo_region_id', '=', $geoRegionId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];

            $this->setId($res["geo_region_id"]);
            $this->setName($res["geo_region_name"]);
            $this->setLevel($res["geo_region_level"]);
            $this->setUserId($res["system_user_id_register"]);
            $this->setDateInsert($res["geo_region_date_insert"]);


        endif;

        return $res;
    }


}