<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 15/09/16
 * Time: 15:10
 */
sysLoadClass("ModelNewsPaper");

class ActionNewspaper extends ModelNewsPaper
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("newspaper");

        $sql->setRowData("newspaper_id", $this->getNewspaperId());
        $sql->setRowData("newspaper_description", $this->getNewspaperDescription());
        $sql->setRowData("newspaper_publication_date", $this->getNewspaperPublicationDate());
        $sql->setRowData("newspaper_number_of_pages", $this->getNewspaperNumberOfPages());
        $sql->setRowData("newspaper_drawing", $this->getNewspaperDrawing());
        $sql->setRowData("newspaper_edition", $this->getNewspaperEdition());
        $sql->setRowData("newspaper_date_insert", $this->currentTime());
        $sql->setRowData("geo_region_id_fk", $this->getGeoRegionIdFk());
        $sql->setRowData("system_user_id_fk", $this->getSystemUserIdFk());
        $sql->setRowData("newspaper_status", 1);
        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('newspaper');
        $criteria->add(New Filter('newspaper_id', '=', "{$this->getNewspaperId()}"));

        $sql->setRowData("newspaper_description", $this->getNewspaperDescription());
        $sql->setRowData("newspaper_number_of_pages", $this->getNewspaperNumberOfPages());
        $sql->setRowData("newspaper_publication_date", $this->getNewspaperPublicationDate());
        $sql->setRowData("newspaper_number_of_pages", $this->getNewspaperNumberOfPages());
        $sql->setRowData("newspaper_drawing", $this->getNewspaperDrawing());
        $sql->setRowData("newspaper_edition", $this->getNewspaperEdition());
        $sql->setRowData("newspaper_date_update", $this->currentTime());


        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }


    public function sqlPublication()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('newspaper');
        $criteria->add(New Filter('newspaper_id', '=', "{$this->getNewspaperId()}"));
        $sql->setRowData("newspaper_status", $this->getNewsPaperStatus());
        $sql->setCriteria($criteria);
        return $this->runQuery($sql);
    }


    public function sqlStatus()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('newspaper');
        $criteria->add(New Filter('newspaper_id', '=', "{$this->getNewspaperId()}"));
        $sql->setRowData("newspaper_status", $this->getNewsPaperStatus());
        $sql->setCriteria($criteria);
        return $this->runQuery($sql);
    }


    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();

        $sql->setEntity('newspaper');
        $criteria->add(New Filter('newspaper_id', '=', "{$this->getNewspaperId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlSelect($criteria = false, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("newspaper");
        $sql->addColumn($col);
        $sql->setJoin("newspaper", "geo_region", "geo_region_id_fk", "geo_region_id");

        if ($criteria):
            $sql->setCriteria($criteria);
        endif;


        return $this->runSelect($sql);
    }


    public function sqlLoad($newsId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('newspaper_id', '=', $newsId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):

            $res = $res[0];
            $this->setNewspaperId($res["newspaper_id"]);
            $this->setNewspaperDescription($res["newspaper_description"]);
            $this->setNewspaperPublicationDate($res["newspaper_publication_date"]);
            $this->setNewspaperNumberOfPages($res["newspaper_number_of_pages"]);
            $this->setNewspaperDrawing($res["newspaper_drawing"]);
            $this->setNewspaperEdition($res["newspaper_edition"]);
            $this->setGeoRegionIdFk($res["geo_region_id_fk"]);
            $this->setNewspaperDateInsert($res["newspaper_date_insert"]);
            $this->setNewspaperDateUpdate($res["newspaper_date_update"]);
            $this->setNewsPaperStatus($res["newspaper_status"]);
            $this->setSystemUserIdFk($res["system_user_id_fk"]);

        endif;

        return $res;
    }


}