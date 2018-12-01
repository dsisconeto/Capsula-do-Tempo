<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 27/08/16
 * Time: 05:17
 */

sysLoadClass("Event");
sysLoadClass("EventCategory");
sysLoadClass("EventRelationshipGeoRegion");
sysLoadClass("GeoRegionUserPermission");

class AdminControllerEvent extends DjView
{

    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionEvent()) {
        } else {
            $this->location("login/?continue=" . DjWork::currentUrl());
        }


    }

    public function register()
    {

        $geoRegion = new GeoRegionUserPermission();
        $this->setDate("geoRegionId", $geoRegion->selectOneRegion());

        $this->setDate("edit", false);
        $this->setDate("select2", true);
        $this->setDate("eventId", "");
        $this->setDate("eventName", "");
        $this->setDate("eventStatus", "");
        $this->setDate("eventDescription", "");
        $this->setDate("eventData", "");
        $this->setDate("eventLocal", "");
        $this->setDate("eventRoof", "");
        $this->setDate("eventAddress", "");
        $this->setDate("eventAddressMaps", "");
        $this->setDate("eventCategoryName", "");
        $this->setDate("eventCategoryId", "");


        $category = new EventCategory();


        $res = $category->selectOrderByName();

        $this->setDate("eventCategoryAll", $res);

        $this->view("admin.event@managerInfo");
    }


    public function edit()
    {

        $geoRegion = new GeoRegionUserPermission();
        $this->setDate("geoRegionId", $geoRegion->selectOneRegion());
        $this->setDate("edit", true);
        $this->setDate("select2", true);
        $event = new Event();
        $category = new EventCategory();
        $relationGeoRegion = new EventRelationshipGeoRegion();
        $res = $category->selectOrderByName();
        $this->setDate("eventCategoryAll", $res);


        if ($event->validateUserByEvent(DjRequest::get("event_id"))) {

            $event->sqlLoad(DjRequest::get("event_id"));
            $this->setDate("edit", true);

            $this->setDate("eventId", $event->getId());
            $this->setDate("eventName", $event->getName());
            $this->setDate("eventStatus", $event->getEventStatus());
            $this->setDate("eventDescription", $event->getDescription());
            $this->setDate("eventDate", $event->getDate(true));
            $this->setDate("eventLocal", $event->getEventLocal());

            $this->setDate("eventRoof", $event->getRoof());
            $this->setDate("eventAddress", $event->getAddress());
            $this->setDate("eventAddressMaps", $event->getAddressMaps());
            $this->setDate("eventCategoryName", $event->category()->getName());
            $this->setDate("eventCategoryId", $event->category()->getId());
            $this->setDate("geo_region_id_city", $event->region()->getId());
            $this->setDate("geo_region_name_city", $event->region()->getName());


            $this->setDate("geoRegionAll", $relationGeoRegion->selectByEvent($event->getId()));

            $this->view("admin.event@managerInfo");
        } else {

            $this->location("admin/evento/todos/");
        }


    }

    public function managerGallery()
    {
        $event = new Event();

        if ($event->sqlLoad(DjRequest::get("event_id"))) {

            $this->setDate("eventId", $event->getId());
            $this->setDate("eventName", $event->getName());
            $this->setDate("eventStatus", $event->getEventStatus());
            $this->view("admin.event@managerGallery");

        } else {
            $this->location("admin/evento/todos/");
        }

    }

    public function managerCover()
    {

        $event = new Event();

        if ($event->sqlLoad(DjRequest::get("event_id"))) {

            $this->setDate("eventId", $event->getId());
            $this->setDate("eventName", $event->getName());
            $this->setDate("eventRoof", $event->getRoof());
            $this->setDate("eventStatus", $event->getEventStatus());
            $this->setDate("eventCover", $event->getCover());


            $this->view("admin.event@managerCover");
        } else {

            $this->location("admin/evento/todos/");

        }
    }


    public function displayTable()
    {


        $this->view("admin.event@displayTable");
    }


}