<?php

namespace App\Controllers\Services\Site;

use App\Models\Event\Event;
use App\Models\Event\RelationshipRegion;
use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Request;

class ServicesEvent
{

    public function allPaginate()
    {

        $event = new Event();
        $return = array();

        $geoRegionRelationParent = new RegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(Region::define(), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("event_status", "=", 3));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("limit", DataFormat::paginate(Request::get("page", "int"), 4));
        $cri3->setProperty("order", "event_date DESC");

        $res = $event->selectMix($cri3);
        if ($res) {
            $count = 0;
            foreach ($res as $key) {

                $return[$count]["event_name"] = $key["event_name"];
                $return[$count]["system_url_url"] = $key["system_url_url"];
                $return[$count]["event_date"] = DataFormat::dateToViewBr($key["event_date"]);
                $return[$count]["event_cover"] = $key["event_cover"];
                $return[$count]["geo_region_name"] = $key["geo_region_name"];
                $count++;

            }

        }

        return $return;
    }


    public function selectByRegion()
    {


        $geoRegionId = Request::get("geo_region_id", "int", 0);
        $date = Request::get("date", "string", "next");
        $eventCategoryId = Request::get("event_category_id", "int", null);

        $eventRGeoRegion = new RelationshipRegion();
        $geoRegionRelationParent = new RegionRelationshipParent();
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();


        $geoRegionId = array(0 => $geoRegionId);
        $resRegionValidate = $geoRegionRelationParent->selectRegions($geoRegionId);
        if ($resRegionValidate) {
            foreach ($resRegionValidate as $key) {
                $cri3->add(new Filter("event_relationship_geo_region.geo_region_id_fk", "=", $key["geo_region_id"]), Filter::OR_OPERATOR);

            }
        }
        if ($eventCategoryId) {

            $cri->add(new Filter("event.event_category_id", "=", $eventCategoryId));

        }

        $cri->add(new Filter("event_relationship_geo_region.geo_region_id_fk", "=", $geoRegionId));
        $cri->add(new Filter("event_status", "=", 3));

        if ($date == "prev") {

            $cri->add(new Filter("event_date", "<", GetData::getCurrentTime()));
        } elseif
        ($date == "today"
        ) {

            $cri->add(new Filter("event_date", "=", GetData::getCurrentTime()));
        } elseif ($date == "next") {

            $cri->add(new Filter("event_date", ">", GetData::getCurrentTime()));
        }


        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");

        $res = $eventRGeoRegion->select($cri3);

        if ($res) {
            $count = 0;
            $index = array();
            foreach ($res as $key) {
                if (!isset($index[$key["event_id"]])) {

                    $res[$count]["event_name"] = $key["event_name"];
                    $res[$count]["event_local"] = $key["event_local"];
                    $res[$count]["event_date"] = $key["event_date"];
                    $res[$count]["system_url_url"] = $key["system_url_url"];
                    $res[$count]["event_color"] = $key["event_color"];
                    $res[$count]["event_name"] = $key["event_name"];

                    $count++;
                    $index[$key["event_id"]] = true;
                }
            }

        }


        return $res;
    }


}