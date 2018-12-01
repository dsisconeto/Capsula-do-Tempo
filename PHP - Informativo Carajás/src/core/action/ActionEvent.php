<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 16:37
 */
sysLoadClass("ModelEvent");
sysLoadClass("GeoRegion");
sysLoadClass("EventCategory");

abstract class ActionEvent extends ModelEvent
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("event");
        $sql->setRowData("event_name", $this->getName());
        $sql->setRowData("event_description", $this->getDescription());
        $sql->setRowData("event_local", $this->getEventLocal());
        $sql->setRowData("event_date", $this->getDate());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("event_address", $this->getAddress());
        $sql->setRowData("event_address_maps", $this->getAddressMaps());
        $sql->setRowData("event_status", $this->getEventStatus());
        $sql->setRowData("system_user_id", $this->getSystemUserId());
        $sql->setRowData("system_user_id_permission", $this->getSystemUserIdPermission());
        $sql->setRowData("event_date_insert", $this->currentTime());
        $sql->setRowData("event_category_id_fk", $this->category()->getId());
        $sql->setRowData("system_url_id_fk", $this->url()->getId());
        $sql->setRowData("event_roof", $this->getRoof());
        $sql->setRowData("session", session_id());

        return $this->runQuery($sql);
    }

    public function sqlUpdateRoof()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('event');
        $criteria->add(New Filter('event_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_roof_cover", $this->getRoofCover());


        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }


    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $criteria = new Criteria();
        $sql->setEntity('event');
        $criteria->add(New Filter('event_id', '=', "{$this->getId()}"));
        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('event');
        $criteria->add(New Filter('event_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_name", $this->getName());
        $sql->setRowData("event_description", $this->getDescription());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("event_local", $this->getEventLocal());
        $sql->setRowData("event_date", $this->getDate());
        $sql->setRowData("event_cover", $this->getCover());
        $sql->setRowData("event_address", $this->getAddress());
        $sql->setRowData("event_address_maps", $this->getAddressMaps());
        $sql->setRowData("event_category_id_fk", $this->category()->getId());
        $sql->setRowData("event_roof", $this->getRoof());
        $sql->setRowData("event_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlUpdateStatus()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('event');
        $criteria->add(New Filter('event_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_status", $this->getEventStatus());
        $sql->setRowData("system_user_id_permission", $this->getSystemUserIdPermission());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }


    public function sqlUpdateCover()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('event');
        $criteria->add(New Filter('event_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_cover", $this->getCover());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }


    public function sqlUpdateCounterVIew()
    {

        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('event');
        $criteria->add(New Filter('event_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_counter_view", $this->getCounterView());

        return $this->runQuery($sql);

    }


    public function sqlSelect($criteria = NULL, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("event");
        $sql->addColumn($col);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk", "left");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");

        if ($criteria) {

            $sql->setCriteria($criteria);

        }

        return $this->runSelect($sql);
    }


    public function searchAdmin($criteria = NULL, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("event");
        $sql->addColumn($col);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");

        if ($criteria) {

            $sql->setCriteria($criteria);

        }


        return $this->runSelect($sql->getInstruction(true));

    }


    public function sqlSelectSimple($criteria = NULL, $col = false)
    {

        $sql = new SqlSelect();
        $sql->setEntity("event");
        $sql->addColumn($col);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");

        if ($criteria) {

            $sql->setCriteria($criteria);

        }
        return $this->runSelect($sql);
    }

    public function sqlSelectBasic($criteria = NULL, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("event");
        $sql->addColumn($col);

        if ($criteria) {
            $sql->setCriteria($criteria);
        }

        return $this->runSelect($sql);
    }

    public function sqlLoad($eventId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('event_id', '=', $eventId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelectSimple($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["event_id"]);
            $this->setName($res["event_name"]);
            $this->setDescription($res["event_description"]);
            $this->setEventLocal($res["event_local"]);
            $this->setDate($res["event_date"]);
            $this->setCover($res["event_cover"]);
            $this->region()->setName($res["geo_region_name"]);
            $this->region()->setId($res["geo_region_id"]);
            $this->setAddress($res["event_address"]);
            $this->setAddressMaps($res["event_address_maps"]);
            $this->setEventStatus($res["event_status"]);
            $this->setCounterView($res["event_counter_view"]);
            $this->setDateInsert($res["event_date_insert"]);
            $this->setDateUpdate($res["event_date_update"]);
            $this->category()->setId($res["event_category_id"]);
            $this->category()->setName($res["event_category_name"]);
            $this->setRoof($res["event_roof"]);
            $this->setRoofCover($res["event_roof_cover"]);
            $this->url()->setId($res["system_url_id"]);
            $this->url()->setUrl($res["system_url_url"]);
            $this->setSystemUserId($res["system_user_id"]);
            $this->setSystemUserIdPermission($res["system_user_id_permission"]);
        endif;

        return $res;
    }

    public function sqlLoadUrl($systemUrl)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('system_url_url', '=', $systemUrl));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelectSimple($criteria);
        if ($res):

            $res = $res[0];
            $this->setId($res["event_id"]);
            $this->setName($res["event_name"]);
            $this->setDescription($res["event_description"]);
            $this->setEventLocal($res["event_local"]);
            $this->setDate($res["event_date"]);
            $this->setCover($res["event_cover"]);
            $this->setAddress($res["event_address"]);
            $this->setAddressMaps($res["event_address_maps"]);
            $this->setEventStatus($res["event_status"]);
            $this->setCounterView($res["event_counter_view"]);
            $this->setDateInsert($res["event_date_insert"]);
            $this->region()->setName($res["geo_region_name"]);
            $this->region()->setId($res["geo_region_id"]);
            $this->setDateUpdate($res["event_date_update"]);
            $this->category()->setId($res["event_category_id"]);
            $this->setRoof($res["event_roof"]);
            $this->setRoofCover($res["event_roof_cover"]);
            $this->url()->setId($res["system_url_id"]);
            $this->url()->setUrl($res["system_url_url"]);
            $this->setSystemUserId($res["system_user_id"]);
            $this->setSystemUserIdPermission($res["system_user_id_permission"]);
            $this->setSession($res["session"]);

        endif;

        return $res;


    }


}