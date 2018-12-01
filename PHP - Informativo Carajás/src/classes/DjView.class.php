<?php
sysLoadClass("GeoRegion");
sysLoadClass("SystemConfigGeoRegion");

abstract class DjView
{
    private static $smarty;


    final private function constSmarty()
    {

        $login = SystemLogin::getLogin();
        $this->setDate("isMobile", $login->isMobileDevice());
        $this->setDate("metaUrl", DjWork::currentUrl());

        if ($login->validateLogIn()) {

            $this->setDate("systemUserName", $login->getSystemUserName());

            $this->setDate("loginNews", $login->getSystemUserPermissionNews());
            $this->setDate("loginNewsCategory", $login->getSystemUserPermissionEventCategory());
            $this->setDate("loginNewspaper", $login->getSystemUserPermissionNewspaper());
            $this->setDate("loginEvent", $login->getSystemUserPermissionEvent());
            $this->setDate("loginEventCategory", $login->getSystemUserPermissionEventCategory());

            $this->setDate("loginAds", $login->getSystemUserPermissionAds());

            $this->setDate("loginCompany", $login->getSystemUserPermissionCompany());
            $this->setDate("loginUserCompany", $login->getSystemUserCompany());
            if ($login->getSystemUserCompany()) {

                sysLoadClass("Company");
                $company = new Company();
                $company = $company->companyUser();
                $this->setDate("loginUserCompanyName", $company["company_name"]);
                $this->setDate("loginUserCompanyId", $company["company_id"]);
            }


            $this->setDate("loginGeoRegion", $login->getSystemUserPermissionGeo());
            $this->setDate("loginUserRegister", $login->getSystemUserPermissionUserRegister());
        }


        $configRegion = SystemConfigGeoRegion::getSystemConfig();
        $this->setDate("geo_region_id", DjRequest::cookie("geo_region_id", "int", 0));
        $this->setDate("systemEventView", $configRegion->getEventView());
        $this->setDate("systemCompanyView", $configRegion->getCompanyView());
        $this->setDate("systemNewspaperView", $configRegion->getNewspaperView());

    }


    final public function location($router, $config = array(), $location = true)
    {

        $host = DjWork::getHost();
        header("location:{$host}$router");
        exit();

    }

    final public function locationLogin()
    {
        $this->location("login/?continue=" . DjWork::currentUrl());

    }

    final public function view($display)
    {
        $this->constSmarty();

        $frame = new Framework();
        $templeDir = "../src/view/";
        $view = "";
        $displayExplode = explode(".", $display);
        $displayExplode2 = explode("@", $display);
        self::getSmarty()->compile_dir = '../template-compile/';


        self::setDate("getHost", DjWork::getHost());

        self::setDate("isMobile", $frame->isMobileDevice());

        self::setDate("countAds", 1);


        if (count($displayExplode) > 1) {

            $count = count($displayExplode) - 1;

            foreach ($displayExplode as $Key => $value) {

                if ($Key < $count) {

                    $templeDir .= "$value/";

                } else {

                    $res = explode("@", $value);

                    if (isset($res[0]) && isset($res[1])) {
                        $templeDir .= "{$res[0]}/";

                        $view .= "{$res[1]}.tpl";

                    }

                }

            }


        } elseif (isset($displayExplode2[0]) && isset($displayExplode2[1])) {
            $templeDir .= "{$displayExplode2[0]}/";
            $view .= "{$displayExplode2[1]}.tpl";

        } elseif (strlen($display) > 1) {

            $view .= "$display.tpl";

        }


        self::getSmarty()->template_dir = "$templeDir";
        self::getSmarty()->display($view);

    }

    final private static function getSmarty()
    {
        if (!self::$smarty) {

            self::$smarty = new Smarty();

        }

        return self::$smarty;

    }

    final public function setDate($name, $value)
    {

        self::getSmarty()->assign($name, $value);


    }


}