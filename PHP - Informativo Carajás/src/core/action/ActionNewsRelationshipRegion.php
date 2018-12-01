<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 13/05/2016
 * Time: 17:48
 */
sysLoadClass("ModelNewsRelationshipRegion");

class ActionNewsRelationshipRegion extends ModelNewsRelationshipRegion
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("news_relationship_region");
        $sql->setRowData("news_id_fk", $this->getNewsIdFk());
        $sql->setRowData("geo_region_id", $this->getGeoRegionId());


        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("news_relationship_region");
        $cri = new Criteria();

        $cri->add(New Filter('news_id_fk', '=', $this->getNewsIdFk()));
        $cri->add(New Filter('geo_region_id', '=', $this->getGeoRegionId()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);


    }

    public function sqlDeleteNews()
    {

        $sql = new SqlDelete();
        $sql->setEntity("news_relationship_region");
        $cri = new Criteria();
        $cri->add(New Filter('news_id_fk', '=', $this->getNewsIdFk()));
        $sql->setCriteria($cri);

        return $this->runQuery($sql);


    }

    public function sqlSelect(Criteria $criteria = null)
    {
        $sql = new SqlSelect();
        $sql->setEntity("news_relationship_region");
        $sql->addColumn("*");

        if ($criteria):
            $sql->setCriteria($criteria);
        endif;


        $sql->setJoin("news_relationship_region", "geo_region", "geo_region_id", "geo_region_id");

        return $this->runSelect($sql);
    }

}