<?php

namespace App\Models\Event;

use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;
class Category extends Model
{


    private $id;
    private $name;
    private $dataInsert;
    private $dataUpdate;


    public function __construct()
    {
        $this->setTable("event_category");

    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("event_category_name", $this->getName());
        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('event_category_id', '=', "{$this->getId()}"));

        $sql->setRowData("event_category_name", $this->getName());
        $sql->setRowData("event_category_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('event_category_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");


        return $sql->execute();
    }

    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('event_category_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["event_category_id"]);
            $this->setName($res["event_category_name"]);
            $this->setDataInsert($res["event_category_date_insert"]);
            $this->setDataUpdate($res["event_category_date_update"]);
        endif;

        return $res;
    }


    public function selectOrderByName()
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri->setProperty("order", "event_category_name ASC");
        $sql->addColumn("*");
        $sql->setCriteria($cri);
        return $sql->execute();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDataInsert()
    {
        return $this->dataInsert;
    }

    /**
     * @param mixed $dataInsert
     */
    public function setDataInsert($dataInsert)
    {
        $this->dataInsert = $dataInsert;
    }

    /**
     * @return mixed
     */
    public function getDataUpdate()
    {
        return $this->dataUpdate;
    }

    /**
     * @param mixed $dataUpdate
     */
    public function setDataUpdate($dataUpdate)
    {
        $this->dataUpdate = $dataUpdate;
    }

}