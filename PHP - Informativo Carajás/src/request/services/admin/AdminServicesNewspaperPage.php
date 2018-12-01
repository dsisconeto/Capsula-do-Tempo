<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 21/09/16
 * Time: 17:01
 */
sysLoadClass("NewspaperPage");

class AdminServicesNewspaperPage
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();
        if (!$login->validateLogIn() || !$login->getSystemUserPermissionNewspaper()) {

            exit();
        }
    }

    public function selectAllPagesByNewspaper()
    {
        $page = new NewspaperPage();
        $newspaper = new Newspaper();
        $id = DjRequest::get("newspaper_id", "int", 0);

        if($newspaper->validateByUser($id)) {


            $col[] = "newspaper_page_id";
            $col[] = "newspaper_page_file";
            $col[] = "newspaper_page_number";


            return $page->selectByNewspaper($id);

        } else {

            return array();
        }
    }


}