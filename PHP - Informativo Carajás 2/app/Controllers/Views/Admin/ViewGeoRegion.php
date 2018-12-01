<?php


namespace App\Controllers\Views\Admin;

use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;

class ViewGeoRegion extends View
{
    public function __construct()
    {

        Login::validateView(Request::cookie("jwt"), 11);

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

    public function config()
    {


        $geoRegion = new Region();
        $system = new ConfigGeoRegion();

        if (($geoRegion->load(Request::get("geo_region_id", "int")))) {

            $this->setData("geoRegionId", $geoRegion->getId());
            $this->setData("geoRegionName", $geoRegion->getName());

            if ($system->load($geoRegion->getId())) {

                $this->setData("companyView", $system->getCompanyView());
                $this->setData("eventView", $system->getEventView());
                $this->setData("newspaperView", $system->getNewspaperView());

            } else {

                $this->setData("companyView", 0);
                $this->setData("eventView", 0);
                $this->setData("newspaperView", 0);
            }

            $this->view("admin.geoRegion@config");

        } else {
            $this->location("/");
        }

    }


    public
    function addRelationship()
    {
        $geoRegion = new Region();
        if (($geoRegion->load(Request::get("geo_region_id"))) && $geoRegion->getLevel() >= 2) {

            $this->setData("geoRegionId", $geoRegion->getId());
            $this->setData("geoRegionName", $geoRegion->getName());
            $this->setData("select2", true);

            $this->view("admin.geoRegion@relationshipParentAdd");

        } else {

            $this->location("regiao/todas/");

        }


    }

    public
    function displayTable()
    {


        $this->view("admin.geoRegion@displayTable");

    }
}