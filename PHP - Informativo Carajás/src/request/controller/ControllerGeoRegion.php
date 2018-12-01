<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 09/09/2016
 * Time: 03:35
 */
class ControllerGeoRegion extends DjView
{

    public function index()
    {


        $this->setDate("continue", DjRequest::get("continue", "str", ""));
        $this->setDate("selectRegion", false);

        $this->view("selectRegion");

    }

}