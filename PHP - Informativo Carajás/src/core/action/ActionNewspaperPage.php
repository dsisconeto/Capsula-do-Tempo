<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 15/09/16
 * Time: 21:47
 */
sysLoadClass("ModelNewspaperPage");

class ActionNewspaperPage extends ModelNewspaperPage
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("newspaper_page");

        $sql->setRowData("newspaper_id_fk", $this->getNewspaperIdFk());
        $sql->setRowData("newspaper_page_number", $this->getNewspaperNumber());
        $sql->setRowData("newspaper_page_file", $this->getNewspaperFile());
        $sql->setRowData("newspaper_page_date_insert", $this->currentTime());


        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('newspaper_page');
        $criteria->add(New Filter('newspaper_page_id', '=', $this->getNewspaperPageId()));
        $sql->setRowData("newspaper_page_number", $this->getNewspaperNumber());
        $sql->setRowData("newspaper_page_date_update", $this->getNewspaperPageDateUpdate());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }


    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();

        $sql->setEntity('newspaper_page');
        $criteria->add(New Filter('newspaper_page_id', '=', "{$this->getNewspaperPageId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlSelect($criteria = false, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("newspaper_page");
        $sql->addColumn($col);
        $sql->setJoin("newspaper_page", "newspaper", "newspaper_id_fk", "newspaper_id");

        if ($criteria):
            $sql->setCriteria($criteria);
        endif;



        return $this->runSelect($sql);
    }


    public function sqlLoad($newsId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('newspaper_page_id', '=', $newsId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):

            $res = $res[0];
            $this->setNewspaperPageId($res["newspaper_page_id"]);
            $this->setNewspaperIdFk($res["newspaper_id_fk"]);
            $this->setNewspaperNumber($res["newspaper_page_number"]);
            $this->setNewspaperFile($res["newspaper_page_file"]);
            $this->setNewspaperPageDateInsert($res["newspaper_page_date_insert"]);
            $this->setNewspaperPageDateUpdate($res["newspaper_page_date_update"]);

        endif;

        return $res;
    }


}