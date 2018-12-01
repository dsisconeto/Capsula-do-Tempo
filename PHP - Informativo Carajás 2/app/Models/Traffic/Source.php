<?php

namespace App\Models\Traffic;

use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class Source extends Model
{


    private $id;
    private $name;
    private $dateInsert;
    private $dateUpdate;


    public function __construct()
    {
        $this->setTable("traffic_source");
        $this->setPrimaryKey("traffic_source_id");

    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("traffic_source_name", $this->getName());


        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));
        $sql->setRowData("traffic_source_name", $this->getName());
        $sql->setRowData("traffic_date_update",GetData::getCurrentTime());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter("{$this->getPrimaryKey()}", '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }



    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];
            $this->setId($res["traffic_source_id"]);
            $this->setName($res["traffic_source_name"]);
            $this->setDateInsert($res["traffic_source_date_insert"]);
            $this->setDateUpdate($res["traffic_source_date_Update"]);
        }

        return $res;
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
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * @param mixed $dateInsert
     */
    public function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }


}