<?php

namespace App\Models\Geo;

use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class City extends Model
{

    //put your code here
    private $id;
    private $name;
    private $state;
    private $dateInsert;
    private $dateUpdate;


    public function __construct()
    {
        $this->setTable("geo_city");
    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("geo_city_name", $this->getName());
        $sql->setRowData("geo_state_id", $this->state()->getId());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('geo_city_id', '=', "{$this->getId()}"));

        $sql->setRowData("geo_city_name", $this->getName());
        $sql->setRowData("geo_state_id", $this->state()->getId());
        $sql->setRowData("geo_city_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('geo_city_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");


        return $sql->execute();
    }

    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;


        return $sql->execute();
    }

    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();

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


    public function searchNameBy($geoCityName)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri->setProperty("order", "geo_city_name ASC");
        $cri->add($this->filter("geo_city_name", "like", "%{$geoCityName}%"));
        $sql->addColumn("*");
        $sql->setCriteria($cri);

        return $sql->execute();

    }


    public function selectOrderByName($order = "ASC")
    {
        $sql = $this->sqlSelect();

        $cri = $this->criteria();
        if ($order == "DESC"):
            $order = "DESC";
        else:
            $order = "ASC";
        endif;
        $cri->setProperty("order", "geo_city_name " . $order);

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
     * @return State
     */
    public function state()
    {
        $this->state = $this->state ? $this->state : new State();
        return $this->state;
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

