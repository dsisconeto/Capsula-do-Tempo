<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 13/04/16
 * Time: 10:39
 */
sysLoadClass("ModelTrafficSource");

class ActionTrafficSource extends ModelTrafficSource
{
    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("traffic_source");


        $sql->setRowData("traffic_source_name", $this->getTrafficSourceName());


        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('traffic_source');

        $criteria->add(New Filter('traffic_source_id', '=', "{$this->getTrafficSourceId()}"));

        $sql->setRowData("traffic_source_name", $this->getTrafficSourceName());
        $sql->setRowData("traffic_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();

        $sql->setEntity('traffic_source');

        $criteria->add(New Filter('traffic_source_id', '=', "{$this->getTrafficSourceId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("traffic_source");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($trafficSourceId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('traffic_source_id', '=', $trafficSourceId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setTrafficSourceId($res["traffic_source_id"]);
            $this->setTrafficSourceName($res["traffic_source_name"]);
            $this->setTrafficSourceDateInsert($res["traffic_source_date_insert"]);
            $this->setTrafficSourceDateUpdate($res["traffic_source_date_Update"]);
        endif;

        return $res;
    }
}