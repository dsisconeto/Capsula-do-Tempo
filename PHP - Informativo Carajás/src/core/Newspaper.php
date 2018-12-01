<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 15/09/16
 * Time: 22:14
 */
sysLoadClass("ActionNewspaper");
sysLoadClass("NewspaperPage");
sysLoadClass("GeoRegionUserPermission");
sysLoadClass("GeoRegionRelationshipParent");


class Newspaper extends ActionNewspaper
{


    public function validateByUser($newspaperId)
    {
        $relationUserRegion = new GeoRegionUserPermission();
        $this->sqlLoad($newspaperId);

        return ($relationUserRegion->validatePermission($this->getGeoRegionIdFk(), "newspaper"));
    }

    public function lastId()
    {
        $cri = new Criteria();
        $cri->setProperty("order", "newspaper_id DESC");
        $cri->setProperty("limit", 1);
        $col[] = "newspaper_id";
        $res = $this->sqlSelect($cri, $col);
        if ($res) {

            return $res[0]["newspaper_id"];

        } else {

            return false;

        }
    }

    public function search($geoRegionId)
    {
        $parent = new GeoRegionRelationshipParent();

        $page = new NewspaperPage();
        $pages = $page->selectCovers($geoRegionId);
        $cri = new Criteria();
        $cri2 = $parent->createCriteriaByRegion($geoRegionId,"geo_region_id_fk" );
        $cri3 = new Criteria();

        $cri->add(new Filter("newspaper_status", "=", 3));
        $cri->setProperty("order", "newspaper_publication_date ASC");

        $cri3->add($cri);
        $cri3->add($cri2);

        $res = $this->sqlSelect($cri3);
        $result = array();
        $count = 0;

        if ($res) {

            foreach ($res as $item) {
                $result[$count]["newspaper_id"] = $item["newspaper_id"];
                $result[$count]["newspaper_publication_date"] = DjWork::dateToBr($item["newspaper_publication_date"], false);
                $result[$count]["newspaper_number_of_pages"] = $item["newspaper_number_of_pages"];
                $result[$count]["newspaper_drawing"] = $item["newspaper_drawing"];
                $result[$count]["newspaper_edition"] = $item["newspaper_edition"];
                $result[$count]["newspaper_description"] = $item["newspaper_description"];
                $result[$count]["newspaper_cover"] = $pages[$item["newspaper_id"]];
                $count++;
            }


        }

        return $result;
    }


}