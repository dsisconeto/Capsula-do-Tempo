<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/04/16
 * Time: 16:25
 */
sysLoadClass("ModelRelationshipUserCategory");

class ActionNewsRelationshipUserCategory extends ModelRelationshipUserCategory
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();

        $sql->setEntity("news_relationship_user_category");

        $sql->setRowData("system_user_id_fk", $this->getSystemUserId());
        $sql->setRowData("news_category_id_fk", $this->getNewsCategoryId());

        return $this->runQuery($sql);

    }


    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("news_relationship_user_category");

        $cri = new Criteria();
        $cri->add(New Filter("system_user_id_fk", "=", $this->getSystemUserId()));
        $cri->add(New Filter("news_category_id_fk", "=", $this->getNewsCategoryId()));

        $sql->setCriteria($cri);

        return $this->runSelect($sql);
    }


    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("news_relationship_user_category");

        $sql->setJoin("news_relationship_user_category", "news_category", "news_category_id_fk", "news_category_id");
        
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }


}