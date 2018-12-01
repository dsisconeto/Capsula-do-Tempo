<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 09/06/2016
 * Time: 02:39
 */

sysLoadClass("ActionEvent");
sysLoadClass("GeoRegionRelationshipParent");
sysLoadClass("TrafficView");
sysLoadClass("SystemUrl");
sysLoadClass("EventGallery");
sysLoadClass("GeoRegionUserPermission");

class Event extends ActionEvent
{

    public function __construct()
    {
        $this->setImgFolder("event_cover");
    }

    public function updateRoof($galleryId)
    {
        $gal = new EventGallery();
        $gal->sqlLoad($galleryId);

        $this->setId($gal->event()->getId());
        $this->setRoofCover($gal->getFile());

        return $this->sqlUpdateRoof();
    }


    public function lastId()
    {
        $login = SystemLogin::getLogin();
        $cri = new Criteria();
        $cri->add(new Filter("system_user_id", "=", $login->getSystemUserId()));
        $cri->add(new Filter("session", "=", session_id()));
        $cri->setProperty("order", "event_id DESC");
        $cri->setProperty("limit", "1");
        $col[] = "event_id";
        $res = $this->sqlSelectBasic($cri, $col);

        if (isset($res[0])) {

            return $res[0]["event_id"];

        } else {
            return false;
        }

    }


    public function validateUserByEvent($eventId)
    {
        $login = SystemLogin::getLogin();
        $permissionRegion = new GeoRegionUserPermission();
        $cri1 = new Criteria();
        $cri2 = $permissionRegion->createCriteria("event", "event_relationship_geo_region.geo_region_id_fk");
        $cri3 = new Criteria();

        $cri1->add(new Filter("event_id", "=", $eventId));
        $cri3->setProperty("limit", "1");
        $cri3->add($cri1);
        $cri3->add($cri2);


        $res = $this->searchAdmin($cri3);

        return ($login->validateLogIn() && $res);
    }


    public function updateCounter($systemUrl)
    {
        $trafficView = new TrafficView();
        $res = $this->sqlLoadUrl($systemUrl);
        $counterView = $trafficView->counterViewUrl($res["system_url_id_fk"]);
        $this->setCounterView($counterView);
        return $this->sqlUpdateCounterVIew();

    }


    public function search($arg)
    {
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();
        $geoRegion = new GeoRegionRelationshipParent();

        $cri4 = $geoRegion->createCriteriaByRegion(DjRequest::cookie("geo_region_id"), "event_relationship_geo_region.geo_region_id_fk");

        $cri->add(new Filter("event_status", "=", 3));
        $cri2->add(new Filter("event_category_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
        $cri2->add(new Filter("event_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);


        $cri3->add($cri);
        $cri3->add($cri2);
        $cri3->add($cri4);

        $cri3->setProperty("order", "event_date DESC");

        return $this->sqlSelect($cri3);
    }


    public function eventWeek()
    {
        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("event_status", "=", 3));
        $cri2->add(new Filter("event_date", "<=", $this->dateAdvanced($this->currentEndDay(), 7)));
        $cri2->add(new Filter("event_date", ">=", $this->dateAdvanced($this->currentStartDay(), 1)));
        $cri2->add(new Filter("event_status", "=", 3));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");


        return $this->sqlSelect($cri3);

    }

    public function eventDay()
    {

        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("event_status", "=", 3));
        $cri2->add(new Filter("event_date", ">=", $this->currentStartDay()));
        $cri2->add(new Filter("event_date", "<=", $this->currentEndDay()));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");


        return $this->sqlSelect($cri3);

    }

    public function eventRoof()
    {
        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("event_status", "=", 3));
        $cri2->add(new Filter("event_roof", "=", 1));
        $cri2->add(new Filter("event_date", "<=", $this->dateAdvanced($this->currentStartDay(), 1)));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");


        return $this->sqlSelect($cri3);

    }

    public function eventNext()
    {
        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("event_status", "=", 3));
        $cri2->add(new Filter("event_date", ">=", $this->dateAdvanced($this->currentStartDay(), 8)));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");

        return $this->sqlSelect($cri3);
    }


}