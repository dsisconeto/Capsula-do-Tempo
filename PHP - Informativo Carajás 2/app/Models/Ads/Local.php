<?php

namespace App\Models\Ads;


use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;

class Local extends Model
{


    private $id;
    private $name;
    private $printscreen;
    private $height;
    private $width;
    private $dateInsert;
    private $dateUpdate;


    public function __construct()
    {

        $this->setTable("ads_local");
    }



    public function edit(){}


    public function selectOrderByName($order = "ASC", $col = false)
    {
        $sql = $this->sqlSelect();
        $cri = new Criteria();
        $order = $order == "DESC" ? "DESC" : "ASC";

        $cri->setProperty("order", "ads_local_name " . $order);

        $sql->addColumn($col);
        $sql->setCriteria($cri);

        return $sql->execute();

    }


    public function Register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("ads_local_id", $this->getId());
        $sql->setRowData("ads_local_name", $this->getName());
        $sql->setRowData("ads_local_printscreen", $this->getPrintscreen());
        $sql->setRowData("ads_local_height", $this->getHeight());
        $sql->setRowData("ads_local_width", $this->getWidth());

        return $sql->execute();

    }

    public function update()
    {
        $sql = $this->sqlUpdate();
        $criteria = new Criteria();


        $criteria->add($this->filter('ads_local_id', '=', "{$this->getId()}"));
        $sql->setCriteria($criteria);

        $sql->setRowData("ads_local_name", $this->getName());
        $sql->setRowData("ads_local_printscreen", $this->getPrintscreen());
        $sql->setRowData('ads_local_date_update', GetData::getCurrentTime());

        return $sql->execute();

    }

    public function select($criteria = null, $col = false)
    {
        $sql = $this->sqlSelect();

        $sql->addColumn($col);
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $sql->execute();
    }

    public function sqlLoad($AdsLocalId)
    {
        $criteria = $this->criteria();
        $criteria->add($this->filter('ads_local_id', '=', $AdsLocalId));
        $criteria->setProperty("limit", 1);

        $res = $this->select($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["ads_local_id"]);
            $this->setName($res["ads_local_name"]);
            $this->setPrintscreen($res["ads_local_printscreen"]);
            $this->setWidth($res["ads_local_width"]);
            $this->setHeight($res["ads_local_height"]);
            $this->setDateInsert($res["ads_local_date_insert"]);
            $this->setDateUpdate($res["ads_local_date_update"]);
        endif;

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
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }


    /**
     * @return mixed
     */
    public function getPrintscreen()
    {
        return $this->printscreen;
    }

    /**
     * @param mixed $printscreen
     */
    public function setPrintscreen($printscreen)
    {
        $this->printscreen = $printscreen;
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