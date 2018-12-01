<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:57
 */
sysLoadClass("CompanyRelationshipFeatured");

class ServicesCompanyFeatured
{


    public function select()
    {
        $companyFeatured = new CompanyRelationshipFeatured();
        return $companyFeatured->select(DjRequest::get("geo_region_id"), DjRequest::get("company_featured_id"));
    }


}