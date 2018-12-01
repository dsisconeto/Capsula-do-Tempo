<?php

namespace App\Models\News;

use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;

class Category extends Model
{

    private $id;
    private $nickname;
    private $name;
    private $color;
    private $categoryParent;
    private $dataInsert;
    private $dataUpdate;

    public function __construct()
    {
        $this->setTable("news_category");
        $this->setPrimaryKey("news_category_id");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("news_category_nickname", $this->getNickname());
        $sql->setRowData("news_category_name", $this->getName());
        $sql->setRowData("news_category_parent_id", $this->getCategoryParent());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('news_category_id', '=', "{$this->getId()}"));

        $sql->setRowData("news_category_nickname", $this->getNickname());
        $sql->setRowData("news_category_name", $this->getName());
        $sql->setRowData("news_category_date_update", GetData::getCurrentTime());
        $sql->setCriteria($criteria);

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

        $criteria->add($this->filter('news_category_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["news_category_id"]);
            $this->setName($res["news_category_name"]);
            $this->setNickname($res["news_category_nickname"]);
            $this->setColor($res[]);
            $this->setDataInsert($res["news_category_date_insert"]);
            $this->setDataUpdate($res["news_category_date_update"]);
        endif;

        return $res;
    }

    public function loadNickName($nickName)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('news_category_nickname', '=', $nickName));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");

        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["news_category_id"]);
            $this->setName($res["news_category_name"]);
            $this->setNickname($res["news_category_nickname"]);
            $this->setColor($res["news_category_color"]);
            $this->setDataInsert($res["news_category_date_insert"]);
            $this->setDataUpdate($res["news_category_date_update"]);
        endif;

        return $res;
    }


    public function selectAllByName()
    {
        $cri = $this->criteria();
        $cri->setProperty("order", "news_category_name ASC");
        return $this->select($cri);
    }


    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
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
    public function getCategoryParent()
    {
        return $this->categoryParent;
    }

    /**
     * @param mixed $categoryParent
     */
    public function setCategoryParent($categoryParent)
    {
        $this->categoryParent = $categoryParent;
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


}