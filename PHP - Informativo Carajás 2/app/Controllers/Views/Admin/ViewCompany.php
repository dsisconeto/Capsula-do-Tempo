<?php

namespace App\Controllers\Views\Admin;

use App\Models\Company\Company;
use App\Models\Company\Featured;
use App\Models\Company\Segment;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;

class ViewCompany extends View
{


    public function __construct()
    {
        Login::validateView(Request::cookie("jwt"), 7);

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


    public function register()
    {

        $this->setData("select2", true);
        $this->setData("companyId", "");
        $this->setData("companyName", "");
        $this->setData("companyFantasyName", "");
        $this->setData("systemUrlUrl", "");
        $this->setData("companyCnpjOrCpf", "");
        $this->setData("companyAddress", "");
        $this->setData("companyAddressEmbed", "");
        $this->setData("companyDescription", "");
        $this->setData("companyNivel", 2);


        $this->setData("edit", false);
        $this->view("admin.company@manager");
    }

    public function edit()
    {
        $company = new Company();
        $company->load(Request::get("company_id", "int", 0));


        $this->setData("companyId", $company->getId());
        $this->setData("companyName", $company->getName());
        $this->setData("companyFantasyName", $company->getFantasyName());
        $this->setData("systemUrlUrl", $company->url()->getUrl());
        $this->setData("companyCnpjOrCpf", $company->getCnpjOrCpf());
        $this->setData("companyAddress", $company->getAddress());
        $this->setData("companyAddressEmbed", $company->getEmbed());
        $this->setData("companyDescription", $company->getDescription());
        $this->setData("companyNivel", $company->getLevel());
        $this->setData("companyStatus", $company->getStatus());
        $this->setData("edit", true);

        $this->view("admin.company@manager");


    }

    public function featured()
    {


        $userPermission = new RegionUserPermission();

        $this->setData("geoRegionId", $userPermission->selectOneRegion());
        $companyFeatured = new Featured();
        $res = $companyFeatured->selectAll();
        $this->setData("companyFeaturedAll", $res);

        $this->setData("select2", true);

        $this->view("admin.company@featured");


    }


    public function displayTable()
    {
        $this->view("admin.company@displayTable");
    }

    public function relationship()
    {
        $company = new Company();
        $companySegment = new Segment();
        $this->setData("select2", true);

        $companyId = Request::get("company_id", "int", 0);

        if ($company->validateByUser($companyId)) {


            if ($company->getLevel() >= 2) {

                $this->setData("premium", true);

            } else {

                $this->setData("premium", false);
            }


            $this->setData("companyId", $company->getId());
            $this->setData("companyFantasyName", $company->getFantasyName() . "-" . $company->getEmbed());
            $this->setData("companySegmentAll", $companySegment->selectAllOrderByName());


            $this->view("admin.company@relationship");
        } else {


            $this->location("empresa/todas/");
        }


    }

}