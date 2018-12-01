<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 29/05/2016
 * Time: 16:27
 */

sysLoadClass("ModelCompanyRelationshipFeatured");

class ActionCompanyRelationshipFeatured extends ModelCompanyRelationshipFeatured
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_relationship_featured");

        $sql->setRowData("company_id_fk", $this->getCompanyIdFk());
        $sql->setRowData("company_featured_id_fk", $this->getCompanyFeaturedIdFk());
        $sql->setRowData("geo_region_id_fk", $this->getGeoRegionIdFk());
        $sql->setRowData("company_relationship_featured_order", $this->getCompanyRelationshipFeaturedOrder());

        return $this->runQuery($sql);

    }

    public function sqlSerialize()
    {
        $sql = new SqlUpdate();
        $sql->setEntity("company_relationship_featured");

        $cri = new Criteria();
        $cri->add(new Filter("company_relationship_featured_id", "=", $this->getCompanyRelationshipFeaturedId()));

        $sql->setRowData("company_relationship_featured_order", $this->getCompanyRelationshipFeaturedOrder());

        $sql->setCriteria($cri);

        $this->runQuery($sql);

    }


    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $cri = new Criteria();
        $sql->setEntity("company_relationship_featured");
        $cri->add(new Filter("company_relationship_featured_id", "=", $this->getCompanyRelationshipFeaturedId()));
        $sql->setCriteria($cri);
        return $this->runQuery($sql);
    }

    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_relationship_featured");

        $sql->setJoin("company_relationship_featured", "company", "company_id_fk", "company_id");
        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
        $sql->addColumn("*");


        $sql->setCriteria($criteria);

        return $this->runSelect($sql);
    }


}