<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 17:03
 */
sysLoadClass("ModelEventCategory");
class ActionEventCategory extends ModelEventCategory
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("event_category");
        $sql->setRowData("event_category_name", $this->getName());
        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('event_category');
        $criteria->add(New Filter('event_category_id', '=', "{$this->getId()}"));

        $sql->setRowData("event_category_name", $this->getName());
        $sql->setRowData("event_category_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("event_category");

        $cri = new Criteria();
        $cri->add(New Filter("event_category_id", "=", $this->getId()));

        $sql->setCriteria($cri);

        return $this->runSelect($sql);
    }


    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("event_category");
        
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($eventCategoryId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('event_category_id', '=', $eventCategoryId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["event_category_id"]);
            $this->setName($res["event_category_name"]);
            $this->setDataInsert($res["event_category_date_insert"]);
            $this->setDataUpdate($res["event_category_date_update"]);
        endif;

        return $res;
    }


}