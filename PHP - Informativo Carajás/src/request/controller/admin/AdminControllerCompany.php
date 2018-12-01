<?php

sysLoadClass("Company");
sysLoadClass("CompanyFeatured");
sysLoadClass("GeoRegionUserPermission");
sysLoadClass("CompanySegment");

class AdminControllerCompany extends DjView
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && ($login->getSystemUserPermissionCompany() || $login->getSystemUserCompany())) {

        } else {
            $this->location("login/?continue=" . DjWork::currentUrl());
        }


    }

    public function edit()
    {

        $company = new Company();
        $login = SystemLogin::getLogin();

        $this->setDate("select2", true);
        $this->setDate("edit", false);
        $this->setDate("companyId", "");
        $this->setDate("companyName", "");
        $this->setDate("companyFantasyName", "");
        $this->setDate("systemUrlUrl", "");
        $this->setDate("companyCnpjOrCpf", "");
        $this->setDate("companyAddress", "");
        $this->setDate("companyAddressEmbed", "");
        $this->setDate("companyDescription", "");
        $this->setDate("companyNivel", 2);

        if ($company->validateByUser(DjRequest::get("company_id"))) {

            $resCompany = $company->sqlLoad(DjRequest::get("company_id"));


            $this->setDate("companyId", $company->getCompanyId());
            $this->setDate("companyName", $company->getCompanyName());
            $this->setDate("companyFantasyName", $company->getCompanyFantasyName());
            $this->setDate("systemUrlUrl", $resCompany["system_url_url"]);
            $this->setDate("companyCnpjOrCpf", $company->getCompanyCnpjOrCpf());
            $this->setDate("companyAddress", $company->getCompanyAddress());
            $this->setDate("companyAddressEmbed", $company->getCompanyAddressEmbed());
            $this->setDate("companyDescription", $company->getCompanyDescription());
            $this->setDate("companyNivel", $company->getCompanyNivel());
            $this->setDate("companyStatus", $company->getCompanyStatus());

            $this->setDate("edit", true);

            $this->view("admin.company@manager");

        } else {

            $this->location("admin/empresa/todas/");

        }


    }

    public function featured()
    {

        $login = SystemLogin::getLogin();
        if ($login->getSystemUserPermissionCompany()) {


            $userPermission = new GeoRegionUserPermission();

            $this->setDate("geoRegionId", $userPermission->selectOneRegion());
            $companyFeatured = new CompanyFeatured();
            $res = $companyFeatured->selectAll();
            $this->setDate("companyFeaturedAll", $res);

            $this->setDate("select2", true);

            $this->view("admin.company@featured");

        } else {

            $this->location("admin/");
        }
    }

    public function register()
    {

        $login = SystemLogin::getLogin();
        if ($login->getSystemUserPermissionCompany()) {


            $company = new Company();
            $this->setDate("select2", true);


            $this->setDate("companyId", "");
            $this->setDate("companyName", "");
            $this->setDate("companyFantasyName", "");
            $this->setDate("systemUrlUrl", "");
            $this->setDate("companyCnpjOrCpf", "");
            $this->setDate("companyAddress", "");
            $this->setDate("companyAddressEmbed", "");
            $this->setDate("companyDescription", "");
            $this->setDate("companyNivel", 2);


            $this->setDate("edit", false);
            $this->view("admin.company@manager");
        } else {

            $this->location("admin/");
        }
    }

    public function displayTable()
    {
        $login = SystemLogin::getLogin();
        if ($login->getSystemUserPermissionCompany()) {


            $this->view("admin.company@displayTable");

        } else {

            $this->location("admin/");
        }

    }

    public function relationship()
    {
        $company = new Company();
        $companySegment = new CompanySegment();
        $this->setDate("select2", true);

        $companyId = DjRequest::get("company_id", "int", 0);

        if ($company->validateByUser($companyId)) {


            if ($company->getCompanyNivel() >= 2) {

                $this->setDate("premium", true);

            } else {

                $this->setDate("premium", false);
            }


            $this->setDate("companyId", $company->getCompanyId());
            $this->setDate("companyFantasyName", $company->getCompanyFantasyName() . "-" . $company->getCompanyAddress());
            $this->setDate("companySegmentAll", $companySegment->selectAllOrderByName());


            $this->view("admin.company@relationship");
        } else {


            $this->location("admin/empresa/todas/");
        }


    }

}