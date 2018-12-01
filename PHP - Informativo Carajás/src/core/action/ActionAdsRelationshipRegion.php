<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/05/16
 * Time: 21:18
 */
sysLoadClass("ModelAdsRelationshipRegion");

class ActionAdsRelationshipRegion extends ModelAdsRelationshipRegion
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("ads_relationship_region");
        $sql->setRowData("ads_id_fk", $this->getAdsId());
        $sql->setRowData("geo_region_id_fk", $this->getGeoRegionId());
        $sql->setRowData("system_user_id", $this->getSystemUserId());
        $sql->setRowData("ads_relationship_region_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("ads_relationship_region");
        $cri = new Criteria();

        $cri->add(New Filter('ads_id_fk', '=', $this->getAdsId()));
        $cri->add(New Filter('geo_region_id_fk', '=', $this->getGeoRegionId()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);


    }

    public function sqlDeleteAds()
    {

        $sql = new SqlDelete();
        $sql->setEntity("ads_relationship_region");
        $cri = new Criteria();
        $cri->add(New Filter('ads_id_fk', '=', $this->getAdsId()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);


    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("ads_relationship_region");
        $sql->addColumn($col);
        $sql->setJoin("ads_relationship_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("ads_relationship_region", "ads", "ads_id_fk", "ads_id");
        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");

        if ($criteria):
            $sql->setCriteria($criteria);
        endif;


        return $this->runSelect($sql);
    }

}