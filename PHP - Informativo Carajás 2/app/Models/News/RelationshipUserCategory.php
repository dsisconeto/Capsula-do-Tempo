<?php

namespace App\Models\News;

use App\Models\User\Login;
use App\Models\User\User;
use DSisconeto\Simple\Model;

class RelationshipUserCategory extends Model
{

    private $user;
    private $category;

    public function __construct()
    {
        $this->setTable("news_relationship_user_category");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("system_user_id_fk", $this->user()->getId());
        $sql->setRowData("news_category_id_fk", $this->category()->getId());
        return $sql->execute();
    }

    public function edit()
    {
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter("system_user_id_fk", '=', "{ $this->user()->getId()}"));
        $criteria->add($this->filter("news_category_id_fk", '=', "{$this->category()->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setJoin("news_relationship_user_category", "news_category", "news_category_id_fk", "news_category_id");


        return $sql->execute();
    }


    public function relatedToUser()
    {

        $cri = $this->criteria();

        $col = array("news_category.news_category_id", "news_category_name");

        $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));


        return $this->select($cri, $col);
    }


    public function validateRelationship($systemUserId, $newsCategoryId)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("system_user_id_fk", "=", $systemUserId));
        $cri->add($this->filter("news_category_id_fk", "=", $newsCategoryId));

        return $this->selectBasic($cri);
    }


    /**
     * @return User
     */
    public function user()
    {

        $this->user = $this->user ? $this->user : new User();
        return $this->user;
    }


    /**
     * @return Category
     */
    public function category()
    {
        $this->category = $this->category ? $this->category : new Category();

        return $this->category;
    }


}