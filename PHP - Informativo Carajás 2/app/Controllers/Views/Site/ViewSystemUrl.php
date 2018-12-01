<?php

namespace App\Controllers\Views\Site;

use App\Models\System\ConfigGeoRegion;
use App\Models\System\SystemUrl;
use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;

class ViewSystemUrl extends View
{

    public function __construct()
    {
        $configRegion = ConfigGeoRegion::getSystemConfig();
        $this->setData("systemEventView", $configRegion->getEventView());
        $this->setData("systemCompanyView", $configRegion->getCompanyView());
        $this->setData("systemNewspaperView", $configRegion->getNewspaperView());

    }

    public function defineUrl()
    {

        $systemUrl = new SystemUrl();


        if ($systemUrl->loadUrl(Request::get("url"))) {

            switch ($systemUrl->entity()->getId()) {

                case 1:

                    (new ViewNews())->single();
                    break;

                case 2:
                    // é uma empresa
                    (new ViewCompany())->single();
                    break;

                case 3:
                    // é um evento
                    (new ViewEvent())->displaySingle();

                    break;

            }


        }
    }

    public function siteMap()
    {


        $url = new SystemUrl();

        $url->siteMapCreate();
        exit();
    }


}