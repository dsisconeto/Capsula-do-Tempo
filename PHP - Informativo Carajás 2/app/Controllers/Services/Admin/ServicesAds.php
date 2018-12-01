<?php
namespace App\Controllers\Services\Admin;

use App\Models\Ads\Ads;
use App\Models\Ads\RelationshipRegion;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;
use App\Models\User\Login;
use DSisconeto\Simple\DataFormat;


class ServicesAds
{


    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"), array(1));

        $adsId = Request::get("ads_id", "int", 0);
        if ($adsId) {
            $ads = new Ads();
            Login::exitServices(!$ads->validateByUser($adsId));
        }


    }

    public function company()
    {

        $ads = new Ads();
        $adsRegion = new RelationshipRegion();
        $return = null;

        $ads->company()->setId(Request::get("company_id", "int", 0));

        if ($ads->company()->validateByUser($ads->company()->getId())) {

            $col = array('ads_id',
                'ads_link',
                'ads_file',
                "ads_start_display",
                "ads_end_display",
                "ads_date_insert",
                "ads_date_insert",
                "ads_date_update",
                "ads_status",
                "ads_local_name",
            );
            $resultAds = $ads->selectAllByCompany(null, $col);

            $resultRegion = $adsRegion->selectByCompany($ads->company()->getId());

            if ($resultAds && $resultRegion) {
                $i = 0;
                foreach ($resultAds as $keyAds) {

                    $resultAds[$i]["ads_start_display"] = DataFormat::dateToBr($resultAds[$i]["ads_start_display"]);
                    $resultAds[$i]["ads_end_display"] = DataFormat::dateToBr($resultAds[$i]["ads_end_display"]);

                    $resultAds[$i]["ads_date_insert"] = DataFormat::dateToBr($resultAds[$i]["ads_date_insert"], true);
                    $resultAds[$i]["ads_date_update"] = DataFormat::dateToBr($resultAds[$i]["ads_date_update"], true);

                    foreach ($resultRegion as $keyRegion) {

                        if ($keyAds["ads_id"] == $keyRegion["ads_id"]) {

                            if (isset($resultAds[$i]["geo_region"])) {
                                $resultAds[$i]["geo_region"] .= ", " . $keyRegion["geo_region_name"];
                            } else {
                                $resultAds[$i]["geo_region"] = $keyRegion["geo_region_name"];
                            }
                        }
                    }
                    $i++;
                }
                $return = $resultAds;
            }


        }

        return $return;
    }



}