<?php

namespace App\Controllers\Views\Admin;

use App\Models\Ads\Ads;
use App\Models\Ads\Local;
use App\Models\Ads\RelationshipRegion;
use App\Models\Company\Company;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\DataFormat;
use Dsisconeto\Simple\Request;
use DSisconeto\Simple\View;


class ViewAds extends View
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


    public function company()
    {

        $company = new Company();
        $company->load(Request::get("company_id", "int", 0));

        $this->setData("companyName", $company->getName());
        $this->setData("companyId", $company->getId());
        $this->view("admin.ads@company");
    }

    public function register()
    {

        $company = new Company();
        $regionPermission = new RegionUserPermission();

        $companyId = Request::get("company_id", "int", 0);
        if (($companyId) && $company->load($companyId)) {

            $this->setData("companyId", $company->getId());
            $this->setData("companyName", $company->getFantasyName());

            $this->setData("geoRegionId", $regionPermission->selectOneRegion());
            $this->setData("select2", true);
            $this->setData("edit", false);
            $this->setData("adsId", null);
            $this->setData("adsLink", null);
            $this->setData("adsStartDisplay", null);
            $this->setData("adsAndDisplay", null);
            $adsLocal = new Local();
            $col[] = "ads_local_id";
            $col[] = "ads_local_name";


            $adsLocalRes = $adsLocal->selectOrderByName("ASC", $col);

            $this->setData("adsLocalAll", $adsLocalRes);

            $this->view("admin.ads@manager");

        } else {
            $this->location("/");

        }

    }


    public function edit()
    {
        $ads = new Ads();
        $adsLocal = new Local();
        $company = new Company();
        $adsRelationRegion = New RelationshipRegion();

        $this->setData("select2", true);


        if ($ads->load(Request::get("ads_id"))):


            $regionPermission = new RegionUserPermission();

            $this->setData("geoRegionId", $regionPermission->selectOneRegion());

            $this->setData("adsId", $ads->getId());
            $this->setData("adsLink", $ads->getLink());
            $this->setData("adsFile", $ads->getFile());
            $this->setData("adsStartDisplay", DataFormat::dateToBr($ads->getStartDisplay(), false));
            $this->setData("adsAndDisplay", DataFormat::dateToBr($ads->getEndDisplay(), false));

            $company->load($ads->company()->getId());
            $resRegionSelect = $adsRelationRegion->selectRegionsByAds($ads->getId());

            if ($resRegionSelect):
                $this->setData("regionAll", $resRegionSelect);
            endif;


            $this->setData("companyName", $company->getCnpjOrCpf() . " - " . $company->getFantasyName());
            $this->setData("companyId", $company->getId());

            $adsLocalRes = $adsLocal->selectOrderByName();

            $count = 1;

            foreach ($adsLocalRes as $keyLocal):

                if ($ads->local()->getId() == $keyLocal["ads_local_id"]):
                    $adsLocalRes[0]["ads_local_id"] = $keyLocal["ads_local_id"];
                    $adsLocalRes[0]["ads_local_name"] = $keyLocal["ads_local_name"];

                else:
                    $adsLocalRes[$count]["ads_local_id"] = $keyLocal["ads_local_id"];
                    $adsLocalRes[$count]["ads_local_name"] = $keyLocal["ads_local_name"];
                    $count++;
                endif;

            endforeach;

            $this->setData("adsLocalAll", $adsLocalRes);
            $this->setData("edit", true);

        else:

            $adsLocalRes = $adsLocal->selectOrderByName();

            $this->setData("adsLocalAll", $adsLocalRes);
        endif;


        $this->view("admin.ads@manager");
    }



}