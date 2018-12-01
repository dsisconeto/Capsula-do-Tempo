<?php


namespace App\Controllers\Views\Admin;

use App\Models\Event\Category;
use App\Models\Event\Event;
use App\Models\Event\RelationshipRegion;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;

class ViewEvent extends View
{

    public function __construct()
    {
        Login::validateView(Request::cookie("jwt"), 4);


        $this->setData("systemUserName", Request::cookie("user_name"));
        $this->setData("permissionNews", Login::user()->getPermission(1));
        $this->setData("permissionNewsCategory", Login::user()->getPermission(2));
        $this->setData("permissionNewspaper", Login::user()->getPermission(10));
        $this->setData("permissionEvent", Login::user()->getPermission(4));
        $this->setData("permissionEventCategory", Login::user()->getPermission(5));
        $this->setData("permissionAds", Login::user()->getPermission(8));
        $this->setData("permissionCompany", Login::user()->getPermission(7));
        $this->setData("permissionGeoRegion", Login::user()->getPermission(11));
        $this->setData("permissionUserRegister", Login::user()->getPermission(9));
        $this->setData("HOST_MAIN", GetData::getConfig("HOST_MAIN"));
        $this->setData("HOST_IMG", GetData::getConfig("HOST_MAIN"));

    }

    public function register()
    {

        $geoRegion = new RegionUserPermission();
        $this->setData("geoRegionId", $geoRegion->selectOneRegion());

        $this->setData("edit", false);
        $this->setData("select2", true);
        $this->setData("eventId", "");
        $this->setData("eventName", "");
        $this->setData("eventStatus", "");
        $this->setData("eventDescription", "");
        $this->setData("eventData", "");
        $this->setData("eventLocal", "");
        $this->setData("eventRoof", "");
        $this->setData("eventAddress", "");
        $this->setData("eventAddressMaps", "");
        $this->setData("eventCategoryName", "");
        $this->setData("eventCategoryId", "");


        $category = new Category();


        $res = $category->selectOrderByName();

        $this->setData("eventCategoryAll", $res);

        $this->view("admin.event@managerInfo");
    }


    public function edit()
    {

        $geoRegion = new RegionUserPermission();
        $this->setData("geoRegionId", $geoRegion->selectOneRegion());
        $this->setData("edit", true);
        $this->setData("select2", true);
        $event = new Event();
        $category = new Category();
        $relationGeoRegion = new RelationshipRegion();
        $res = $category->selectOrderByName();
        $this->setData("eventCategoryAll", $res);


        if ($event->validateByUser(Request::get("event_id"))) {

            $event->load(Request::get("event_id"));
            $this->setData("edit", true);

            $this->setData("eventId", $event->getId());
            $this->setData("eventName", $event->getName());
            $this->setData("eventStatus", $event->getStatus());
            $this->setData("eventDescription", $event->getDescription());
            $this->setData("eventDate", $event->getDate(true));
            $this->setData("eventLocal", $event->getLocal());

            $this->setData("eventRoof", $event->getRoof());
            $this->setData("eventAddress", $event->getAddress());
            $this->setData("eventAddressMaps", $event->getAddressMaps());
            $this->setData("eventCategoryName", $event->category()->getName());
            $this->setData("eventCategoryId", $event->category()->getId());
            $this->setData("geo_region_id_city", $event->region()->getId());
            $this->setData("geo_region_name_city", $event->region()->getName());


            $this->setData("geoRegionAll", $relationGeoRegion->selectByEvent($event->getId()));

            $this->view("admin.event@managerInfo");
        } else {

            $this->location("evento/todos/");
        }


    }

    public function managerGallery()
    {
        $event = new Event();

        if ($event->validateByUser(Request::get("event_id"))) {

            $this->setData("eventId", $event->getId());
            $this->setData("eventName", $event->getName());
            $this->setData("eventStatus", $event->getStatus());
            $this->view("admin.event@managerGallery");

        } else {
            $this->location("evento/todos/");
        }

    }

    public function managerCover()
    {

        $event = new Event();

        if ($event->load(Request::get("event_id"))) {

            $this->setData("eventId", $event->getId());
            $this->setData("eventName", $event->getName());
            $this->setData("eventRoof", $event->getRoof());
            $this->setData("eventStatus", $event->getStatus());
            $this->setData("eventCover", $event->getCover());


            $this->view("admin.event@managerCover");
        } else {

            $this->location("evento/todos/");

        }
    }


    public function displayTable()
    {


        $this->view("admin.event@displayTable");
    }


}