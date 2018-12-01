<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 27/08/16
 * Time: 17:22
 */
sysLoadClass("Event");

class ServicesEvent
{


    public function allPaginate()
    {

        $event = new Event();
        $return = array();

        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("event_status", "=", 3));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("limit", $event->paginate(DjRequest::get("page", "int"), 4));
        $cri3->setProperty("order", "event_date DESC");

        $res = $event->sqlSelect($cri3);
        if ($res) {
            $count = 0;
            foreach ($res as $key) {

                $return[$count]["event_name"] = $key["event_name"];
                $return[$count]["system_url_url"] = $event->getHost() . $key["system_url_url"];
                $return[$count]["event_date"] = $event->dateToViewBr($key["event_date"]);
                $return[$count]["event_cover"] = $key["event_cover"];
                $return[$count]["geo_region_name"] = $key["geo_region_name"];
                $count++;

            }

        }

        return $return;
    }


    public function selectByRegion()
    {


        $geoRegionId = DjRequest::get("geo_region_id", "int", 0);
        $date = DjRequest::get("date", "string", "next");
        $eventCategoryId = DjRequest::get("event_category_id", "int", null);

        $event = new Event();
        $eventRGeoRegion = new EventRelationshipGeoRegion();
        $geoRegionRelationParent = new GeoRegionRelationshipParent();
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

            $cri->add(new Filter("event_date", "<", $event->currentTime()));
        } elseif
        ($date == "today"
        ) {

            $cri->add(new Filter("event_date", "=", $event->currentTime()));
        } elseif ($date == "next") {

            $cri->add(new Filter("event_date", ">", $event->currentTime()));
        }


        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");

        $res = $eventRGeoRegion->sqlSelect($cri3);

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