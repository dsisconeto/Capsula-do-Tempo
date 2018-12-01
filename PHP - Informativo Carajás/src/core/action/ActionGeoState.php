<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 17:24
 */
sysLoadClass("ModelGeoState");

class ActionGeoState extends ModelGeoState
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("geo_state");

        $sql->setRowData("geo_state_name", $this->getName());
        $sql->setRowData("geo_state_abbr", $this->getAbbr());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('geo_state');
        $criteria->add(New Filter('geo_state_id', '=', "{$this->getId()}"));

        $sql->setRowData("geo_state_name", $this->getName());
        $sql->setRowData("geo_state_abbr", $this->getAbbr());
        $sql->setRowData("geo_state_date_update", $this->currentTime());
        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlSelect(Criteria $criteria = NULL)
    {
        $sql = new SqlSelect();
        $sql->setEntity("geo_state");
        $sql->addColumn("*");
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($geoStateId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('geo_state_id', '=', $geoStateId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["geo_state_id"]);
            $this->setName($res["geo_state_name"]);
            $this->setAbbr($res["geo_state_abbr"]);
            $this->setDateInsert($res["geo_state_date_insert"]);
            $this->setDataUpdate($res["geo_state_date_update"]);
        endif;

        return $res;
    }

}