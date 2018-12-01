<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 10/05/16
 * Time: 01:26
 */
sysLoadClass("ModelGeoRegionRelationshipParent");

class ActionGeoRegionRelationshipParent extends ModelGeoRegionRelationshipParent
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("geo_region_relationship_parent");

        $sql->setRowData("geo_region_id", $this->getGeoRegionId());
        $sql->setRowData("geo_region_id_parent", $this->getGeoRegionIdParent());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("geo_region_relationship_parent");
        $cri = new Criteria();

        $cri->add(New Filter('geo_region_id', '=', $this->getGeoRegionId()));
        $cri->add(New Filter('geo_region_id_parent', '=', $this->getGeoRegionIdParent()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);


    }

    public function sqlSelect(Criteria $criteria = NULL, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("geo_region_relationship_parent");
        $sql->setJoin("geo_region_relationship_parent", "geo_region", "geo_region_id", "geo_region_id");
        $sql->addColumn($col);
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;


        return $this->runSelect($sql);
    }


}