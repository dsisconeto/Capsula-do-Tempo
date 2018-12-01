<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 27/08/16
 * Time: 02:52
 */
class AdminControllerSystemUser extends DjView
{

    public function __construct()
    {
        $login = SystemLogin::getLogin();;

        if ($login->validateLogIn() && $login->getSystemUserPermissionUserRegister()) {

            $this->setDate("systemUserName", $login->getSystemUserName());
            $this->setDate("systemUserProfilePhoto", $login->getSystemUserProfilePhoto(true));


        } else {

            $this->location("admin/");
        }


    }


    public function registerForm()
    {
        $login = SystemLogin::getLogin();
        $resSystemUser = new SystemUser();
        $this->setDate("systemUserName", $login->getSystemUserName());
        $this->setDate("systemUserProfilePhoto", $login->getSystemUserProfilePhoto(true));

// verificar se tem permissão para cadatrar usuario
        if ($login->getSystemUserPermissionUserRegister()) {

            $this->setDate("loginPermissionNews", $login->getSystemUserPermissionNews());
            $this->setDate("loginPermissionNewsCategory", $login->getSystemUserPermissionNewsCategory());
            $this->setDate("loginPermissionNewsSuper", $login->getSystemUserPermissionNewsSuper());

            $this->setDate("loginPermissionEvent", $login->getSystemUserPermissionEvent());
            $this->setDate("loginPermissionEventCategory", $login->getSystemUserPermissionEventCategory());
            $this->setDate("loginPermissionEventSuper", $login->getSystemUserPermissionEventSuper());


            $this->setDate("loginPermissionGeo", $login->getSystemUserPermissionGeo());

            $this->setDate("loginPermissionCompany", $login->getSystemUserPermissionGeo());
            $this->setDate("loginPermissionUserRegister", $login->getSystemUserPermissionUserRegister());
            $this->setDate("loginPermissionAds", $login->getSystemUserPermissionAds());
            $this->setDate("loginPermissionPartner", $login->getSystemUserPermissionPartner());

            $this->setDate("loginPermissionNewspaper", $login->getSystemUserPermissionNewspaper());


            $this->setDate("edit", false);

            $this->view("admin.user@manager");

        } else {


            $this->location("admin/");

        }


    }


    public function edit()
    {
        $user = New SystemUser();
        $login = SystemLogin::getLogin();

        if ($user->sqlLoad(DjRequest::get("system_user_id"))) {

            $this->setDate("userId", $user->getSystemUserId());
            $this->setDate("userName", $user->getSystemUserName());
            $this->setDate("userEmail", $user->getSystemUserEmail());
            $this->setDate("userDescription", $user->getSystemUserDescription());
            $this->setDate("userPhone", $user->getSystemUserPhoneNumber());

            $this->setDate("loginPermissionNews", $login->getSystemUserPermissionNews());
            $this->setDate("loginPermissionNewsCategory", $login->getSystemUserPermissionNewsCategory());
            $this->setDate("loginPermissionNewsSuper", $login->getSystemUserPermissionNewsSuper());
            $this->setDate("loginPermissionEvent", $login->getSystemUserPermissionEvent());
            $this->setDate("loginPermissionEventCategory", $login->getSystemUserPermissionEventCategory());
            $this->setDate("loginPermissionEventSuper", $login->getSystemUserPermissionEventSuper());
            $this->setDate("loginPermissionGeo", $login->getSystemUserPermissionGeo());
            $this->setDate("loginPermissionCompany", $login->getSystemUserPermissionGeo());
            $this->setDate("loginPermissionUserRegister", $login->getSystemUserPermissionUserRegister());
            $this->setDate("loginPermissionAds", $login->getSystemUserPermissionAds());
            $this->setDate("loginPermissionPartner", $login->getSystemUserPermissionPartner());

            $this->setDate("loginPermissionNewspaper", $login->getSystemUserPermissionNewspaper());


            $this->setDate("userPermissionNews", $user->getSystemUserPermissionNews());
            $this->setDate("userPermissionNewsCategory", $user->getSystemUserPermissionNewsCategory());
            $this->setDate("userPermissionNewsSuper", $user->getSystemUserPermissionNewsSuper());
            $this->setDate("userPermissionEvent", $user->getSystemUserPermissionEvent());
            $this->setDate("userPermissionEventCategory", $user->getSystemUserPermissionEventCategory());
            $this->setDate("userPermissionEventSuper", $user->getSystemUserPermissionEventSuper());
            $this->setDate("userPermissionGeo", $user->getSystemUserPermissionGeo());
            $this->setDate("userPermissionCompany", $user->getSystemUserPermissionGeo());
            $this->setDate("userPermissionUserRegister", $user->getSystemUserPermissionUserRegister());
            $this->setDate("userPermissionAds", $user->getSystemUserPermissionAds());
            $this->setDate("userPermissionPartner", $user->getSystemUserPermissionPartner());
            $this->setDate("userPermissionNewspaper", $user->getSystemUserPermissionNewspaper());


            $this->setDate("edit", true);

            $this->view("admin.user@manager");


        } else {

            $this->location("admin/usuario/todos/");
        }

    }

    public function photo()
    {
        $user = New SystemUser();
        $login = SystemLogin::getLogin();

        if ($user->sqlLoad(DjRequest::get("system_user_id"))) {

            $this->setDate("userId", $user->getSystemUserId());
            $this->setDate("userName", $user->getSystemUserName());
            $this->setDate("userPhoto", $user->getSystemUserProfilePhoto());


            $this->view("admin.user@photo");
        } else {

            $this->location("admin/usuario/todos/");
        }

    }


    public function displayTable()
    {
        $login = SystemLogin::getLogin();
        $systemUser = new SystemUser();

        if ($login->validateLogIn() && $login->getSystemUserPermissionUserRegister()) {

            $cri = new Criteria();
            $cri->add(new Filter("partner_id", " = ", $login->getPartnerId()));

            $this->setDate("usersAll", $systemUser->sqlSelect($cri));

            $this->view("admin.user@displayTable");
        }


    }






}