<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 11/10/16
 * Time: 19:57
 */
sysLoadClass("GeoRegionUserPermission");
sysLoadClass("SystemUser");

class AdminControllerGeoRegionUserPermission extends DjView
{

    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionUserRegister()) {

            $this->setDate("systemUserName", $login->getSystemUserName());
        } else {

            $this->locationLogin();
        }

    }


    public function manager()
    {
        // instaciando classes
        $login = SystemLogin::getLogin();
        $user = new SystemUser();
        $permission = new GeoRegionUserPermission();

        // pegando id do usuario passado pelo $_GET
        $userId = DjRequest::get("system_user_id", 'int', 0);
        $this->setDate("select2", 1);
        if ($user->validateUserManager($userId)) {
            $user->sqlLoad($userId);
            // carregando array de permissões


            // carregando dados para view
            $this->setDate("userName", $user->getSystemUserName());
            $this->setDate("userId", $user->getSystemUserId());


            $this->view("admin.user@permissionRegion");
        } else {
           // $this->location("admin/");
        }
    }


}