<?php

sysLoadClass("ModelGeoCity");

class ActionGeoCity extends ModelGeoCity
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("geo_city");

        $sql->setRowData("geo_city_name", $this->getName());
        $sql->setRowData("geo_state_id", $this->state()->getId());
        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('geo_city');
        $criteria->add(New Filter('geo_city_id', '=', "{$this->getId()}"));

        $sql->setRowData("geo_city_name", $this->getName());
        $sql->setRowData("geo_state_id", $this->state()->getId());
        $sql->setRowData("geo_city_date_update", $this->currentTime());
        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlSelect(Criteria $criteria = null)
    {
        $sql = new SqlSelect();
        $sql->setEntity("geo_city");
        $sql->addColumn("*");
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($geoCityId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('geo_city_id', '=', $geoCityId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["geo_city_id"]);
            $this->setName($res["geo_city_name"]);
            $this->state()->setId($res["geo_state_id"]);
            $this->setDateInsert($res["geo_city_date_insert"]);
            $this->setDateUpdate($res["geo_city_date_update"]);
        endif;

        return $res;
    }
}
