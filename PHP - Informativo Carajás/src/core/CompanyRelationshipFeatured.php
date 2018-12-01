<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 05/07/2016
 * Time: 12:32
 */
sysLoadClass("ActionCompanyRelationshipFeatured");

sysLoadClass("CompanyPhone");

class CompanyRelationshipFeatured extends ActionCompanyRelationshipFeatured
{

    public function __construct()
    {


    }


    public function select($geoRegion, $companyFeaturedIdFk)
    {
        $companyFeatured = new CompanyRelationshipFeatured();

        $cri = new Criteria();
        $result = array();
        $count = 0;
        $cri->add(new Filter("company_relationship_featured.geo_region_id_fk", "=", $geoRegion));
        $cri->add(New Filter("company_featured_id_fk", "=", $companyFeaturedIdFk));
        $cri->add(new Filter("company_status", "=", "1"));
        $cri->add(new Filter("company_nivel", ">=", "2"));

        $cri->setProperty("order", "company_relationship_featured_order	ASC");

        $res = $companyFeatured->sqlSelect($cri);
        $phone = new CompanyPhone();
        $resPhones = $phone->sqlSelect();


        if ($res) {

            foreach ($res as $key) {
                $result[$count]["company_relationship_featured_id"] = $key["company_relationship_featured_id"];
                $result[$count]["company_id"] = $key["company_id"];
                $result[$count]["system_url_url"] = $key["system_url_url"];
                $result[$count]["company_fantasy_name"] = $key["company_fantasy_name"];
                $result[$count]["company_address"] = $key["company_address"];
                $result[$count]["company_logo"] = $key["company_logo"];
                foreach ($resPhones as $keyPhone) {

                    if ($keyPhone["company_id_fk"] == $key["company_id"]) {
                        $result[$count]["company_phone"] = $companyFeatured->formatPhone($keyPhone["company_phone_dd"], $keyPhone["company_phone"]);
                        break;
                    }

                }


                $count++;
            }

        }

        return $result;
    }


    public function issetRelation($geoRegionId, $companyId, $companyFeatured)
    {

        $cri = new Criteria();
        $cri->add(new Filter("geo_region_id_fk", "=", $geoRegionId));
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $cri->add(new Filter("	company_featured_id_fk", "=", $companyFeatured));

        $cri->setProperty("order", "company_relationship_featured_order DESC");
        $cri->setProperty("limit", "1");
        return $this->sqlSelect($cri);
    }


    public function lastOrder($geoRegionId, $companyFeatured)
    {
        $cri = new Criteria();
        $cri->add(new Filter("geo_region_id_fk", "=", $geoRegionId));
        $cri->add(new Filter("	company_featured_id_fk", "=", $companyFeatured));

        $cri->setProperty("order", "company_relationship_featured_order DESC");
        $cri->setProperty("limit", "1");
        $rs = $this->sqlSelect($cri);

        if ($rs) {
            return ($rs[0]["company_relationship_featured_order"] + 1);
        } else {
            return 1;
        }

    }

}