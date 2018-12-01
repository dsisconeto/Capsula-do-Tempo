<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 11/07/2016
 * Time: 22:42
 */

sysLoadClass("ModelCompanyRelationshipGeoRegion");

class ActionCompanyRelationshipGeoRegion extends ModelCompanyRelationshipGeoRegion
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_relationship_geo_region");

        $sql->setRowData("company_id_fk", $this->getCompanyIdFk());
        $sql->setRowData("geo_region_id_fk", $this->getGeoRegionIdFk());


        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = New SqlDelete();
        $sql->setEntity("company_relationship_geo_region");
        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $this->getCompanyIdFk()));
        $cri->add(new Filter("geo_region_id_fk", "=", $this->getGeoRegionIdFk()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_relationship_geo_region");
        $sql->setJoin("company_relationship_geo_region", "geo_region", "geo_region_id_fk", "geo_region_id");

        $sql->addColumn($col);
        $sql->setCriteria($criteria);

        return $this->runSelect($sql);
    }


}