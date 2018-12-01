<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 20:07
 */
sysLoadClass("CompanyRelationshipGeoRegion");

class ServicesCompanyRegion
{


    public function selectByCompany()
    {

        $companyId = DjRequest::get("company_id");
        $relationship = new CompanyRelationshipGeoRegion();
        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $col[] = "geo_region_id";
        $col[] = "geo_region_name";

        return $relationship->sqlSelect($cri, $col);
    }




}