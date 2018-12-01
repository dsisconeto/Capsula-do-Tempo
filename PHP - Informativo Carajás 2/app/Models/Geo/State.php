<?php

namespace App\Models\Geo;

use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;

class State extends Model
{
    private $id;
    private $name;
    private $abbr;
    private $dateInsert;
    private $dataUpdate;


    public function __construct()
    {
        $this->setTable("");
        $this->setImgFolder("");
    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("geo_state_name", $this->getName());
        $sql->setRowData("geo_state_abbr", $this->getAbbr());


        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('geo_state_id', '=', "{$this->getId()}"));
        $sql->setRowData("geo_state_name", $this->getName());
        $sql->setRowData("geo_state_abbr", $this->getAbbr());
        $sql->setRowData("geo_state_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('geo_state_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

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

        $criteria->add($this->filter('geo_state_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");

        $res = $sql->execute();

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


    public function searchNameBy($geoStateName)
    {
        $cri = $this->criteria();
        $cri->setProperty("order", "geo_state_name ASC");
        $cri->add($this->filter("geo_state_name", "like", "%{$geoStateName}%"));
        return $this->select($cri);
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
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * @param mixed $abbr
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
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