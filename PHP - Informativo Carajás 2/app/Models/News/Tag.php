<?php

namespace App\Models\News;

use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;

class Tag extends Model
{

    private $id;
    private $nickname;
    private $name;
    private $category;

    public function __construct()
    {
        $this->setTable("news_tag");

        $this->category = new Category();
    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("news_category_id_fk", $this->category()->getId());
        $sql->setRowData("news_tag_name", $this->getName());
        $sql->setRowData("news_tag_nickname", $this->getNickname());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('news_tag_id', '=', "{$this->getId()}"));
        $sql->setRowData("news_tag_name", $this->getName());
        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('news_tag_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        $sql->setJoin("news_tag", "news_category", "news_category_id_fk", "news_category_id");


        return $sql->execute();
    }

    public function load($id)
    {

        $criteria = $this->criteria();

        $criteria->add($this->filter('news_tag_id', '=', $id));
        $criteria->setProperty("limit", 1);

        $result = $this->select($criteria);
        if ($result):
            $result = $result[0];
            $this->setId($result["news_tag_id"]);
            $this->setName($result["news_tag_name"]);
            $this->setNickname($result["news_tag_nickname"]);
            $this->category()->setId($result["news_category_id_fk"]);
            $this->category()->setNickname($result["news_category_nickname"]);
            $this->category()->setName($result["news_category_name"]);

        endif;

        return $result;
    }


    public function selectByCategory($col = null)
    {

        $newsTag = new Tag();

        $cri = $this->criteria();

        $cri->add($this->filter("news_category_id_fk", "=", $this->category()->getId()));

        $cri->setProperty("order", "news_tag_name ASC");

        return $newsTag->selectBasic($cri, $col);
    }

    public function issetTagId($newsTagId)
    {

        $cri = $this->criteria();
        $cri->add($this->filter("news_tag_id", "=", $newsTagId));
        $col[] = "news_tag_id";
        return boolval($this->select($cri, $col));
    }

    public function issetTagByCategory($name, $newsCategoryId)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("news_tag_name", "=", $name));
        $cri->add($this->filter("news_category_id_fk", "=", $newsCategoryId));
        $cri->add($this->filter("news_tag_nickname", "=", DataFormat::standardizeUrl($name)), Criteria::OR_OPERATOR);
        $cri->setProperty("limit", 1);


        return $this->select($cri);
    }

    public function tagByCategoryNick($tagNick, $catNick)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("news_category_nickname", "=", DataFormat::standardizeUrl($tagNick)));
        $cri->add($this->filter("news_tag_nickname", "=", DataFormat::standardizeUrl($catNick)));
        $cri->setProperty("limit", 1);
        $result = $this->select($cri);
        if ($result):
            $result = $result[0];
            $this->setId($result["news_tag_id"]);
            $this->setName($result["news_tag_name"]);
            $this->setNickname($result["news_tag_nickname"]);
            $this->category()->setId($result["news_category_id_fk"]);
            $this->category()->setNickname($result["news_category_nickname"]);
            $this->category()->setName($result["news_category_name"]);

        endif;

        return $result;
    }


    public function validateUser($newsCategoryId)
    {

        $category = new RelationshipUserCategory();

        if ($category->validateRelationship(Login::user()->getId(), $newsCategoryId) && Login::user()->getPermission(1)):

            return true;

        else:
            return false;
        endif;


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
     * @return Category
     */
    public function category()
    {


        return $this->category;
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


}