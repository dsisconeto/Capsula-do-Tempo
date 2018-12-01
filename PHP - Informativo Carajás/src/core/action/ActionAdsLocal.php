<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 14:24
 */
sysLoadClass("ModelAdsLocal");

class ActionAdsLocal extends ModelAdsLocal
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("ads_local");

        $sql->setRowData("ads_local_id", $this->getId());
        $sql->setRowData("ads_local_name", $this->getName());
        $sql->setRowData("ads_local_printscreen", $this->getPrintscreen());
        $sql->setRowData("ads_local_height", $this->getHeight());
        $sql->setRowData("ads_local_width", $this->getWidth());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();

        $sql->setEntity('ads_local');

        $criteria->add(New Filter('ads_local_id', '=', "{$this->getId()}"));
        $sql->setCriteria($criteria);

        $sql->setRowData("ads_local_name", $this->getName());
        $sql->setRowData("ads_local_printscreen", $this->getPrintscreen());
        $sql->setRowData('ads_local_date_update', $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlSelect(Criteria $criteria = null, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("ads_local");
        $sql->addColumn($col);
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($AdsLocalId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('ads_local_id', '=', $AdsLocalId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
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


}