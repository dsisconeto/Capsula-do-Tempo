<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 15:27
 */
sysLoadClass("ModelCompanyFeatured");

class ActionCompanyFeatured extends ModelCompanyFeatured
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_featured");

        $sql->setRowData("company_segment_id_fk", $this->getCompanyId());
        $sql->setRowData("geo_city_id_fk", $this->getGeoCityId());
        $sql->setRowData("company_id_fk", $this->getCompanyId());
        $sql->setRowData("company_featured_order", $this->getCompanyFeaturedOrder());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('company_featured');
        $criteria->add(New Filter('company_featured_id', '=', "{$this->getCompanyFeaturedId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_featured_order", $this->getCompanyFeaturedOrder());


        return $this->runQuery($sql);

    }

    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_featured");
        $sql->addColumn("*");


        $sql->setCriteria($criteria);

        return $this->runSelect($sql);
    }

    public function sqlLoad($companyFeaturedId)
    {

        $criteria = new Criteria();
        $criteria->add(New Filter('company_featured_id', '=', $companyFeaturedId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        if ($res):
            $res = $res[0];
            $this->setCompanyFeaturedId($res["company_featured_id"]);
            $this->setCompanySegmentId($res["company_segment_id"]);
            $this->setGeoCityId($res["geo_city_id"]);
            $this->setCompanyId($res["company_id"]);
            $this->setCompanyFeaturedOrder($res["company_featured_order"]);
        endif;

        return $res;
    }


}