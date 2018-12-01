<?php

namespace App\Models\System;

use DSisconeto\Simple\Model;

class SocialNetwork extends Model
{
    private $id;
    private $name;
    private $color;
    private $icon
    ;
    private $dateInsert;
    private $dateUpdate;


    public function __construct()
    {
        $this->setTable("system_social_network");
        $this->setPrimaryKey("system_social_network_id");
        $this->setImgFolder("");

    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("system_social_network_name", $this->getName());
        $sql->setRowData("system_social_network_icon", $this->getIcon());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));

        $sql->setRowData("system_social_network_name", $this->getName());
        $sql->setRowData("system_social_network_icon", $this->getIcon());
        $sql->setRowData("system_social_network_date_update", $this->getIcon());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }




    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];

            $this->setId($res["system_social_network_id"]);
            $this->setName($res["system_social_network_name"]);
            $this->setIcon($res["system_social_network_icon"]);
            $this->setDateInsert($res["system_social_network_date_insert"]);
            $this->setDateUpdate($res["system_social_network_date_update"]);

        }

        return $res;
    }


    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
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
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
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