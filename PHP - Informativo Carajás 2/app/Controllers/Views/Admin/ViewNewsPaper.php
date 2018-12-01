<?php


namespace App\Controllers\Views\Admin;
use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;

class ViewNewsPaper extends View
{


    public function __construct()
    {

        Login::validateView(Request::cookie("jwt"), 10);

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
        $this->setData("edit", false);
        $this->setData("select2", true);

        $this->view("admin.newspaper@manager");
    }

    public function edit()
    {

        $id = Request::get("newspaper_id", "int", 0);
        $newspaper = new Newspaper();

        if ($newspaper->validateByUser($id)) {

            $load = $newspaper->load($id);

            $this->setData("newspaperId", $newspaper->getId());
            $this->setData("newspaperDescription", $newspaper->getDescription());
            $this->setData("newspaperPublicationDate", $newspaper->getPublicationDate());
            $this->setData("newspaperNumberOfPages", $newspaper->getNumberOfPages());
            $this->setData("newspaperDrawing", $newspaper->getDrawing());
            $this->setData("newspaperEdition", $newspaper->getEdition());

            $this->setData("geoRegionId", $load["geo_region_id"]);
            $this->setData("geoRegionName", $load["geo_region_name"]);

            $this->setData("edit", true);
            $this->setData("select2", true);

            $this->view("admin.newspaper@manager");

        } else {
            $this->locationLogin();
        }


    }

    public function displayTable()
    {
        $userRegion = new RegionUserPermission();


        $this->setData("geoRegionId", $userRegion->selectOneRegion());
        $this->setData("select2", true);

        $this->view("admin.newspaper@displayTable");
    }

    public function pages()
    {

        $newspaper = new Newspaper();
        $newspaper->setId(Request::get("newspaper_id", "int", 0));

        if ($newspaper->validateByUser($newspaper->getId())) {
            $load = $newspaper->load($newspaper->getId());

            $this->setData("geoRegionName", $load["geo_region_name"]);
            $this->setData("newspaperEdition", $load["newspaper_edition"]);
            $this->setData("newspaperId", $load["newspaper_id"]);

            $this->view("admin.newspaper@page");
        } else {


            $this->location("impresso/todos/");
        }


    }


}