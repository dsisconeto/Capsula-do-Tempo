<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 04/04/16
 * Time: 01:54
 */

sysLoadClass("ModelAds");

class ActionAds extends ModelAds
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("ads");
        $sql->setRowData("ads_file", $this->getAdsFile());
        $sql->setRowData("ads_link", $this->getAdsLink());
        $sql->setRowData("ads_start_display", $this->getAdsStartDisplay());
        $sql->setRowData("ads_end_display", $this->getAdsEndDisplay());
        $sql->setRowData("ads_local_id", $this->local()->getId());
        $sql->setRowData("company_id", $this->getAdsCompanyId());
        $sql->setRowData("system_user_id", $this->getSystemUserId());
        $sql->setRowData("ads_status", $this->getAdsStatus());
        $sql->setRowData("ads_date_insert", $this->currentTime());
        $sql->setRowData("ads_date_update", $this->currentTime());


        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('ads');
        $criteria->add(New Filter('ads_id', '=', "{$this->getAdsId()}"));

        $sql->setRowData("ads_file", $this->getAdsFile());
        $sql->setRowData("ads_link", $this->getAdsLink());
        $sql->setRowData("ads_start_display", $this->getAdsStartDisplay());
        $sql->setRowData("ads_end_display", $this->getAdsEndDisplay());
        $sql->setRowData("ads_local_id", $this->local()->getId());
        $sql->setRowData('ads_date_update', $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlUpdateStatus()
    {

        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('ads');
        $criteria->add(New Filter('ads_id', '=', "{$this->getAdsId()}"));

        $sql->setRowData("ads_status", $this->getAdsStatus());
        $sql->setCriteria($criteria);


        return $this->runQuery($sql);


    }

    public function sqlUpdateTurnover()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('ads');
        $criteria->add(New Filter('ads_id', '=', "{$this->getAdsId()}"));
        $sql->setRowData("ads_turnover", $this->getAdsTurnover());
        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("ads");
        $cri = new Criteria();
        $cri->add(New Filter("ads_id", "=", $this->getAdsId()));
        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }

    public function sqlSelectBasic($criteria = null, $col = false)
    {

        $sql = new SqlSelect();
        $sql->setEntity("ads");
        $sql->addColumn($col);
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlSelect(Criteria $criteria = null, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("ads");
        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");
        $sql->addColumn($col);
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($AdsId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('ads_id', '=', $AdsId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];

            $this->setAdsId($res["ads_id"]);
            $this->setAdsFile($res["ads_file"]);
            $this->setAdsLink($res["ads_link"]);
            $this->setAdsStartDisplay($res["ads_start_display"]);
            $this->setAdsEndDisplay($res["ads_end_display"]);
            $this->local()->setId($res["ads_local_id"]);
            $this->setAdsCompanyId($res["company_id"]);
            $this->setSystemUserId($res["system_user_id"]);
            $this->setAdsDateInsert($res["ads_date_insert"]);
            $this->setAdsDateUpdate($res["ads_date_update"]);
            $this->setAdsStatus($res["ads_status"]);
            $this->setAdsTurnover($res["ads_turnover"]);

        endif;

        return $res;
    }


}