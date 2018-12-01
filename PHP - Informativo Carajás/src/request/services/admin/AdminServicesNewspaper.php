<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 21/09/16
 * Time: 17:00
 */
sysLoadClass("Newspaper");
sysLoadClass("NewspaperPage");

class AdminServicesNewspaper
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionNewspaper()) {


        } else {
            exit();
        }


    }


    public function search()
    {

        $newspaper = new Newspaper();
        $page = new NewspaperPage();
        $geoRegionId = DjRequest::get("geo_region_id", "int", 0);
        $pages = $page->selectCovers($geoRegionId);
        $cri = new Criteria();

        $cri->add(new Filter("geo_region_id_fk", "=", $geoRegionId));


        $cri->setProperty("order", "newspaper_date_insert DESC");

        $res = $newspaper->sqlSelect($cri);
        $result = array();
        $count = 0;

        if ($res) {

            foreach ($res as $item) {

                $result[$count]["newspaper_id"] = $item["newspaper_id"];
                $result[$count]["newspaper_publication_date"] = DjWork::dateToBr($item["newspaper_publication_date"], false);
                $result[$count]["newspaper_number_of_pages"] = $item["newspaper_number_of_pages"];
                $result[$count]["newspaper_drawing"] = $item["newspaper_drawing"];
                $result[$count]["newspaper_edition"] = $item["newspaper_edition"];
                $result[$count]["newspaper_status"] = $item["newspaper_status"];
                $result[$count]["newspaper_description"] = $item["newspaper_description"];

                $result[$count]["newspaper_cover"] = $pages[$item["newspaper_id"]];
                $count++;
            }


        }

        return $result;

    }


}