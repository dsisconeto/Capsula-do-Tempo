<?php


namespace App\Controllers\Views\Admin;

use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Request;

use DSisconeto\Simple\View;


class ViewHome extends View
{


    public function __construct()
    {

        Login::validateView(Request::cookie("jwt"));

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

    public function index()
    {

        $this->view("admin@home");

    }
}