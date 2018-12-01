<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 20/05/2016
 * Time: 09:42
 */
sysLoadClass("ModelNewsLocal");

class ActionNewsLocal extends ModelNewsLocal
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("news_local");
        $sql->setRowData("news_local_name", $this->getName());
        $sql->setRowData("news_local_count_max", $this->getCountMax());
        $sql->setRowData("news_local_count_width", $this->getWidth());
        $sql->setRowData("news_local_count_height", $this->getHeight());


        return $this->runQuery($sql);

    }


    public function sqlSelect(Criteria $criteria = null)
    {
        $sql = new SqlSelect();
        $sql->setEntity("news_local");
        $sql->addColumn("*");
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($newsLocalId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('news_local_id', '=', $newsLocalId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["news_local_id"]);
            $this->setName($res["news_local_name"]);
            $this->setCountMax($res["news_local_count_max"]);
            $this->setWidth($res["news_local_width"]);
            $this->setHeight($res["news_local_height"]);
        endif;

        return $res;
    }


}