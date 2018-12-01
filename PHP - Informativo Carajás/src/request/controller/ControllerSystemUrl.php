<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 28/08/16
 * Time: 18:15
 */
class ControllerSystemUrl extends DjView
{


    public function defineUrl()
    {

        $systemUrl = new SystemUrl();

        if ($systemUrl->sqlLoadByUrl(DjRequest::get("url"))) {

            switch ($systemUrl->getEntityId()) {

                case 1:
                    DjRouter::callController("ControllerNews@single");
                    break;

                case 2:
                    // é uma empresa
                    DjRouter::callController("ControllerCompany@single");
                    break;

                case 3:
                    // é um evento
                    DjRouter::callController("ControllerEvent@displaySingle");

                    break;

            }


        } else {


        }
    }

    public function siteMap(){


        $url = new SystemUrl();

        $url->siteMapCreate();
        exit();
    }


}