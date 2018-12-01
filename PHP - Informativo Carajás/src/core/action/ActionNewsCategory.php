<?php

sysLoadClass("ModelNewsCategory");

class ActionNewsCategory extends ModelNewsCategory
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("news_category");
        $sql->setRowData("news_category_nickname", $this->getNewsCategoryNickname());
        $sql->setRowData("news_category_name", $this->getNewsCategoryName());
        $sql->setRowData("news_category_level", $this->getNewsCategoryLevel());
        $sql->setRowData("news_category_parent_id", $this->getNewsCategoryParentId());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('news_category');

        $criteria->add(New Filter('news_category_id', '=', "{$this->getNewsCategoryId()}"));
        $sql->setRowData("news_category_nickname", $this->getNewsCategoryNickname());
        $sql->setRowData("news_category_name", $this->getNewsCategoryName());
        $sql->setRowData("news_category_date_update", $this->currentTime());
        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();

        $sql->setEntity('news_category');
        $criteria->add(New Filter('news_category_id', '=', "{$this->getNewsCategoryId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlSelect(Criteria $criteria = NULL)
    {
        $sql = new SqlSelect();
        $sql->setEntity("news_category");
        $sql->addColumn("*");
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($newsId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('news_category_id', '=', $newsId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setNewsCategoryId($res["news_category_id"]);
            $this->setNewsCategoryName($res["news_category_name"]);
            $this->setNewsCategoryNickname($res["news_category_nickname"]);

            $this->setNewsCategoryDateInsert($res["news_category_date_insert"]);
            $this->setNewsCategoryDateUpdate($res["news_category_date_update"]);
        endif;

        return $res;
    }


    public function sqlLoadNickname($newsCategoryNickname)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('news_category_nickname', '=', $newsCategoryNickname));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setNewsCategoryId($res["news_category_id"]);
            $this->setNewsCategoryName($res["news_category_name"]);
            $this->setNewsCategoryNickname($res["news_category_nickname"]);
           $this->setNewsCategoryDateInsert($res["news_category_date_insert"]);
            $this->setNewsCategoryDateUpdate($res["news_category_date_update"]);
        endif;

        return $res;
    }
}
