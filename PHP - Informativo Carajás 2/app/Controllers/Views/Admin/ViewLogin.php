<?php


namespace App\Controllers\Views\Admin;

use DSisconeto\Simple\Request;
use DSisconeto\Simple\View;


class ViewLogin extends View
{


    public function displayLogin()
    {

        if (Request::issetGet("logout")) {
            Request::unsetCookie("jwt");
        }


        if (!Request::issetCookie("jwt")) {

            $this->setData("continue", Request::get("continue", "str", ""));

            $this->view("admin@login");

        } else {

            $this->location("admin");
        }

    }

}