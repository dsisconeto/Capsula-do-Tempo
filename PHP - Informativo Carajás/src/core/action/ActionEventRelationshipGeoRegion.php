<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 17:23
 */
sysLoadClass("ModelEventRelationshipGeoRegion");

class ActionEventRelationshipGeoRegion extends ModelEventRelationshipGeoRegion
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("event_relationship_geo_region");

        $sql->setRowData("geo_region_id_fk", $this->getGeoRegionIdFk());
        $sql->setRowData("event_id_fk", $this->getEventIdFk());

        return $this->runQuery($sql);

    }


    protected function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("event_relationship_geo_region");

        $cri = new Criteria();
        $cri->add(New Filter("event_category_id_fk", "=", $this->getGeoRegionIdFk()));
        $cri->add(New Filter("event_id_fk", "=", $this->getEventIdFk()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }

    protected function sqlDeleteByEvent()
    {
        $sql = new SqlDelete();
        $sql->setEntity("event_relationship_geo_region");

        $cri = new Criteria();

        $cri->add(New Filter("event_id_fk", "=", $this->getEventIdFk()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }


    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("event_relationship_geo_region");
        $sql->addColumn($col);
        $sql->setCriteria($criteria);
        $sql->setJoin("event_relationship_geo_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event_relationship_geo_region", "event", "event_id_fk", "event_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");

        return $this->runSelect($sql);
    }


}