<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 01/09/16
 * Time: 14:51
 */


sysLoadClass("Ads");
sysLoadClass("GeoRegionUserPermission");

class AdminControllerAds extends DjView
{

    public function __construct()
    {

        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && ($login->getSystemUserPermissionAds() || $login->getSystemUserCompany())) {


        } else {

            $this->location("login/?continue=" . DjWork::currentUrl());
        }


    }


    public function displayTable()
    {

        return $this->view("admin.ads@displayTable");
    }

    public function register()
    {
        if (SystemLogin::getLogin()->getSystemUserPermissionAds()) {

            $regionPermission = new GeoRegionUserPermission();

            $this->setDate("geoRegionId", $regionPermission->selectOneRegion());
            $this->setDate("select2", true);
            $this->setDate("edit", false);
            $this->setDate("adsId", null);
            $this->setDate("adsLink", null);
            $this->setDate("adsStartDisplay", null);
            $this->setDate("adsAndDisplay", null);
            $adsLocal = new AdsLocal();
            $col[] = "ads_local_id";
            $col[] = "ads_local_name";


            $adsLocalRes = $adsLocal->selectOrderByName("ASC", $col);

            $this->setDate("adsLocalAll", $adsLocalRes);

            $this->view("admin.ads@manager");
        }
    }


    public function edit()
    {
        $ads = new Ads();
        $adsLocal = new AdsLocal();
        $company = new Company();
        $adsRelationRegion = New AdsRelationshipRegion();

        $this->setDate("select2", true);


        if ($ads->sqlLoad(DjRequest::get("ads_id"))):


            $regionPermission = new GeoRegionUserPermission();

            $this->setDate("geoRegionId", $regionPermission->selectOneRegion());

            $this->setDate("adsId", $ads->getAdsId());
            $this->setDate("adsLink", $ads->getAdsLink());
            $this->setDate("adsFile", $ads->getAdsFile());
            $this->setDate("adsStartDisplay", $ads->dateToBr($ads->getAdsStartDisplay(), false));
            $this->setDate("adsAndDisplay", $ads->dateToBr($ads->getAdsEndDisplay(), false));

            $company->sqlLoad($ads->getAdsCompanyId());
            $resRegionSelect = $adsRelationRegion->selectByAds($ads->getAdsId());

            if ($resRegionSelect):
                $this->setDate("regionAll", $resRegionSelect);
            endif;


            $this->setDate("companyName", $company->getCompanyCnpjOrCpf() . " - " . $company->getCompanyFantasyName());
            $this->setDate("companyId", $company->getCompanyId());

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

            $this->setDate("adsLocalAll", $adsLocalRes);
            $this->setDate("edit", true);

        else:

            $adsLocalRes = $adsLocal->selectOrderByName();

            $this->setDate("adsLocalAll", $adsLocalRes);
        endif;


        $this->view("admin.ads@manager");
    }


}