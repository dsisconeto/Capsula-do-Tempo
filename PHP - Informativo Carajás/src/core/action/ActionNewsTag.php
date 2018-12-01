<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 20/05/2016
 * Time: 13:17
 */
sysLoadClass("ModelNewsTag");

class ActionNewsTag extends ModelNewsTag
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("news_tag");
        $sql->setRowData("news_category_id_fk", $this->getNewsCategoryIdFk());
        $sql->setRowData("news_tag_name", $this->getNewsTagName());
        $sql->setRowData("news_tag_nickname", $this->getNewsTagNickname());

        return $this->runQuery($sql);

    }

    public function sqlUpdateName()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('news_tag');
        $criteria->add(New Filter('news_tag_id', '=', $this->getNewsTagId()));

        $sql->setRowData("news_tag_name", $this->getNewsTagName());


        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $cri = new Criteria();
        $sql->setEntity("news_tag");
        $cri->add(New Filter("news_tag_id", "=", $this->getNewsTagId()));
        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("news_tag");
        $sql->addColumn($col);
        
        $sql->setJoin("news_tag", "news_category", "news_category_id_fk", "news_category_id");

        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($newsTagId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('news_tag_id', '=', $newsTagId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setNewsTagId($res["news_tag_id"]);
            $this->setNewsCategoryIdFk($res["news_category_id_fk"]);
            $this->setNewsTagName($res["news_tag_name"]);

        endif;

        return $res;
    }


}