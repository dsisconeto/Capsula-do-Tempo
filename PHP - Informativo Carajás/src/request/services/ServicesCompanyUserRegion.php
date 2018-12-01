<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 20:09
 */
class ServicesCompanyUserRegion
{


    public function searchForSelect2()
    {
        $geo = new CompanyRelationshipUserRegion();
        $geoRegionName = DjRequest::get("q");
        $login = SystemLogin::getLogin();
        $cri = new Criteria();
        $cri->add(new Filter("geo_region_name", "LIKE", "%$geoRegionName%"));
        $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));
        $select2 = $geo->sqlSelect($cri);
        $count = 0;

        $json = array();
        if ($select2) {
            foreach ($select2 as $key):
                $json[$count]["id"] = $key["geo_region_id"];
                $json[$count]["text"] = $key["geo_region_name"];
                $count++;
            endforeach;
        }
        echo json_encode($json);
        exit();

    }


}