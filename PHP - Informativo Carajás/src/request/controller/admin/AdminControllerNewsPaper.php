<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 15/09/16
 * Time: 22:37
 */
sysLoadClass("Newspaper");
sysLoadClass("GeoRegionUserPermission");

class AdminControllerNewsPaper extends DjView
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionNewspaper()) {

            $this->setDate("systemUserName", $login->getSystemUserName());
            $this->setDate("systemUserProfilePhoto", $login->getSystemUserProfilePhoto(true));

        } else {

            $this->locationLogin();
        }


    }


    public function register()
    {
        $this->setDate("edit", false);
        $this->setDate("select2", true);

        $this->view("admin.newspaper@manager");
    }

    public function edit()
    {

        $id = DjRequest::get("newspaper_id", "int", 0);
        $newspaper = new Newspaper();

        if ($newspaper->validateByUser($id)) {

            $load = $newspaper->sqlLoad($id);

            $this->setDate("newspaperId", $newspaper->getNewspaperId());
            $this->setDate("newspaperDescription", $newspaper->getNewspaperDescription());
            $this->setDate("newspaperPublicationDate", $newspaper->getNewspaperPublicationDate());
            $this->setDate("newspaperNumberOfPages", $newspaper->getNewspaperNumberOfPages());
            $this->setDate("newspaperDrawing", $newspaper->getNewspaperDrawing());
            $this->setDate("newspaperEdition", $newspaper->getNewspaperEdition());

            $this->setDate("geoRegionId", $load["geo_region_id"]);
            $this->setDate("geoRegionName", $load["geo_region_name"]);

            $this->setDate("edit", true);
            $this->setDate("select2", true);

            $this->view("admin.newspaper@manager");

        } else {
            $this->locationLogin();
        }


    }

    public function displayTable()
    {
        $userRegion = new GeoRegionUserPermission();


        $this->setDate("geoRegionId", $userRegion->selectOneRegion());
        $this->setDate("select2", true);

        $this->view("admin.newspaper@displayTable");
    }

    public function pages()
    {

        $newspaper = new Newspaper();
        $newspaper->setNewspaperId(DjRequest::get("newspaper_id", "int", 0));

        if ($newspaper->validateByUser($newspaper->getNewspaperId())) {
            $load = $newspaper->sqlLoad($newspaper->getNewspaperId());

            $this->setDate("geoRegionName", $load["geo_region_name"]);
            $this->setDate("newspaperEdition", $load["newspaper_edition"]);
            $this->setDate("newspaperId", $load["newspaper_id"]);

            $this->view("admin.newspaper@page");
        } else {


            $this->location("admin/impresso/todos/");
        }


    }


}