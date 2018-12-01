<?php

namespace App\Controllers\Views\Admin;

use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;

class ViewGeoRegionUserPermission extends View
{

    public function __construct()
    {

        if (Request::cookie("jwt", "str", "")) {

            $this->setData("systemUserName", Request::cookie("user_name"));
            $this->setData("loginNews", Request::cookie("permission_1"));
            $this->setData("loginNewsCategory", Request::cookie("permission_2"));
            $this->setData("loginNewspaper", Request::cookie("permission_10"));
            $this->setData("loginEvent", Request::cookie("permission_4"));
            $this->setData("loginEventCategory", Request::cookie("permission_5"));
            $this->setData("loginAds", Request::cookie("permission_8"));
            $this->setData("loginCompany", Request::cookie("permission_7"));
            $this->setData("loginGeoRegion", Request::cookie("permission_11"));
            $this->setData("loginUserRegister", Request::cookie("permission_9"));
            $this->setData("token", Request::cookie("token"));
            $this->setData("HOST_MAIN", GetData::getConfig("HOST_MAIN"));
            $this->setData("HOST_IMG", GetData::getConfig("HOST_IMG"));
            $this->setData("HOST_IMG", GetData::getConfig("HOST_IMG"));
            $this->setData("HOST_FORM", GetData::getConfig("HOST_FORM"));
            $this->setData("HOST_SERVICES", GetData::getConfig("HOST_SERVICES"));

        } else {
            $this->location("logout");
        }

    }


    public function manager()
    {

        $user = new User();
        $permission = new RegionUserPermission();

        // pegando id do usuario passado pelo $_GET
        $userId = Request::get("system_user_id", 'int', 0);
        $this->setData("select2", 1);

        Login::validateController(!$user->validateUserManager($userId));

        $user->load($userId);
        // carregando array de permissões


        // carregando dados para view
        $this->setData("userName", $user->getName());
        $this->setData("userId", $user->getId());


        $this->view("admin.user@permissionRegion");

    }


}