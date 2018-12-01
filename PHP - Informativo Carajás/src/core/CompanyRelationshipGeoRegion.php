<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 11/07/2016
 * Time: 22:55
 */

sysLoadClass("ActionCompanyRelationshipGeoRegion");
sysLoadClass("Company");


class CompanyRelationshipGeoRegion extends ActionCompanyRelationshipGeoRegion
{





    public function issetRelationship($geoRegionId, $companyId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $cri->add(new Filter("geo_region_Id_fk", "=", $geoRegionId));


        return $this->sqlSelect($cri) ? true : false;
    }





}