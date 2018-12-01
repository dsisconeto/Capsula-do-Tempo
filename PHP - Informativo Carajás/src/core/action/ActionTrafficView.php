<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 13/04/16
 * Time: 10:51
 */
sysLoadClass("ModelTrafficView");

class ActionTrafficView extends ModelTrafficView
{
    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("traffic_view");

        $sql->setRowData("traffic_source_id_fk", $this->getTrafficSourceId());
        $sql->setRowData("traffic_user_ip", $this->getTrafficUserId());
        $sql->setRowData("traffic_os", $this->getTrafficOsId());
        $sql->setRowData("system_url_id_fk", $this->getSystemUrl());
        $sql->setRowData("traffic_view_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("traffic_view");
        $sql->addColumn($col);
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($trafficViewId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('traffic_view_id', '=', $trafficViewId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setTrafficViewId($res["traffic_view_id"]);
            $this->setTrafficSourceId($res["traffic_source_id_fk"]);
            $this->setTrafficUserId($res["traffic_user_ip"]);
            $this->setTrafficOsId($res["traffic_os"]);
            $this->setSystemUrl($res["system_url_id_fk"]);
            $this->setTrafficViewDateInsert($res["traffic_view_date_insert"]);
        endif;

        return $res;
    }

}