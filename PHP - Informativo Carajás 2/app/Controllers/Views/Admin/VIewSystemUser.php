<?php



namespace App\Controllers\Views\Admin;

use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;


class VIewSystemUser extends View
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


    public function registerForm()
    {
        $login = Login::user();
        $resSystemUser = new User();
        $this->setData("systemUserName", $login->getName());
        $this->setData("systemUserProfilePhoto", $login->getProfilePhoto());


        $this->setData("loginPermissionNews", $login->getPermissionNews());
        $this->setData("loginPermissionNewsCategory", $login->getPermissionNewsCategory());
        $this->setData("loginPermissionNewsSuper", $login->getPermissionNewsSuper());
        $this->setData("loginPermissionEvent", $login->getPermissionEvent());
        $this->setData("loginPermissionEventCategory", $login->getPermissionNewsCategory());
        $this->setData("loginPermissionEventSuper", $login->getSystemUserPermissionEventSuper());
        $this->setData("loginPermissionGeo", $login->getPermissionGeo());
        $this->setData("loginPermissionCompany", $login->getUserCompany());
        $this->setData("loginPermissionUserRegister", $login->getUserRegister());
        $this->setData("loginPermissionAds", $login->getPermissionAds());
        $this->setData("loginPermissionPartner", $login->getPermissionPartner());
        $this->setData("loginPermissionNewspaper", $login->getPermissionNewspaper());


        $this->setData("edit", false);

        $this->view("admin.user@manager");


    }


    public function edit()
    {
        $user = New User();
        $login = Login::user();

        if ($user->load(Request::get("system_user_id"))) {

            $this->setData("userId", $user->getId());
            $this->setData("userName", $user->getName());
            $this->setData("userEmail", $user->getEmail());
            $this->setData("userDescription", $user->getDescription());
            $this->setData("userPhone", $user->getPhoneNumber());


            $this->setData("loginPermissionNews", $login->getPermissionNews());
            $this->setData("loginPermissionNewsCategory", $login->getPermissionNewsCategory());
            $this->setData("loginPermissionNewsSuper", $login->getPermissionNewsSuper());
            $this->setData("loginPermissionEvent", $login->getPermissionEvent());
            $this->setData("loginPermissionEventCategory", $login->getPermissionNewsCategory());
            $this->setData("loginPermissionEventSuper", $login->getSystemUserPermissionEventSuper());
            $this->setData("loginPermissionGeo", $login->getPermissionGeo());
            $this->setData("loginPermissionCompany", $login->getUserCompany());
            $this->setData("loginPermissionUserRegister", $login->getUserRegister());
            $this->setData("loginPermissionAds", $login->getPermissionAds());
            $this->setData("loginPermissionPartner", $login->getPermissionPartner());
            $this->setData("loginPermissionNewspaper", $login->getPermissionNewspaper());


            $this->setData("edit", true);

            $this->view("admin.user@manager");


        } else {

            $this->location("usuario/todos/");
        }

    }

    public function photo()
    {
        $user = New User();

        if ($user->load(Request::get("system_user_id"))) {

            $this->setData("userId", $user->getId());
            $this->setData("userName", $user->getName());
            $this->setData("userPhoto", $user->getProfilePhoto());


            $this->view("admin.user@photo");
        } else {

            $this->location("usuario/todos/");
        }

    }


    public function displayTable()
    {
        $systemUser = new User();
        $cri = new Criteria();
        $cri->add(new Filter("partner_id", " = ", Login::user()->getPartnerId()));
        $this->setData("usersAll", $systemUser->select($cri));
        $this->view("admin.user@displayTable");
    }


}