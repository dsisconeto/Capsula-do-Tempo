<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:19
 */
sysLoadClass("Ads");

class AdminServicesAds extends DjRouter
{
    public function search()
    {
        $ads = new Ads();
        $filterStatus = DjRequest::get("filter", "int", 1);
        $orderBy = DjRequest::get("order_by", "int", 1);
        $order = DjRequest::get("order", "int", 1);

        $login = SystemLogin::getLogin();
        $company = new Company();
        $adsLocal = new AdsLocal();
        $adsRelationRegion = new AdsRelationshipRegion();
        $res = NULL;

        $countActive = 0;
        $countDisable = 0;
        $count = 0;

        if ($login->validateLogIn() && $login->getSystemUserPermissionAds()):

            $criAds = new Criteria();
            $criCompany = new Criteria();
            $resLocal = $adsLocal->sqlSelect();


            // definindoo a order
            if ($order == 1):
                $order = " DESC";
            else:
                $order = " ASC";
            endif;
            /// order por
            if ($orderBy == 1):
                $criAds->setProperty("order", "ads_date_insert" . $order);
            elseif ($orderBy == 2):
                $criCompany->setProperty("order", "company_fantasy_name" . $order);
            endif;
            $resCompany = $company->sqlSelect($criCompany);

            $criAds->add(new Filter("system_user_id", "=", $login->getSystemUserId()));
            $resAds = $ads->sqlSelect($criAds);
            $resRegion = $adsRelationRegion->selectOrderByNameRegion();


            if ($orderBy == 2):
                /// caso tenha ordernado por empresa
                foreach ($resCompany as $keyCompany):

                    foreach ($resAds as $keyAds):

                        if ($keyAds["company_id"] == $keyCompany["company_id"]):

                            /// catando status
                            if ($keyAds["ads_status"]):
                                $countActive++;
                            else:
                                $countDisable++;
                            endif;
                            /// filtrando por status
                            if ($filterStatus == $keyAds["ads_status"]):

                                $res[$count]["company_id"] = $keyCompany["company_id"];
                                $res[$count]["company_fantasy_name"] = $keyCompany["company_fantasy_name"];
                                $res[$count]["ads_id"] = $keyAds["ads_id"];
                                $res[$count]["ads_file"] = $keyAds["ads_file"];
                                $res[$count]["ads_link"] = $keyAds["ads_link"];
                                $res[$count]["ads_status"] = $keyAds["ads_status"];
                                $res[$count]["ads_start_display"] = $ads->dateToBr($keyAds["ads_start_display"]);
                                $res[$count]["ads_end_display"] = $ads->dateToBr($keyAds["ads_end_display"]);
                                $res[$count]["ads_date_insert"] = $ads->dateToBr($keyAds["ads_date_insert"], true);
                                $res[$count]["ads_date_update"] = $ads->dateToBr($keyAds["ads_date_update"], true);

                                foreach ($resLocal as $keyLocal):
                                    if ($keyAds["ads_local_id"] == $keyLocal["ads_local_id"]):
                                        $res[$count]["ads_local_id"] = $keyLocal["ads_local_id"];
                                        $res[$count]["ads_local_name"] = $keyLocal["ads_local_name"];
                                        $res[$count]["ads_local_height"] = $keyLocal["ads_local_height"];
                                        $res[$count]["ads_local_width"] = $keyLocal["ads_local_width"];
                                    endif;
                                endforeach;
                                if ($resRegion):
                                    foreach ($resRegion as $keyRegion):
                                        if ($keyAds["ads_id"] == $keyRegion["ads_id"]):

                                            if (isset($res[$count]["geo_region"])):

                                                $res[$count]["geo_region"] .= " " . $keyRegion["geo_region_name"];

                                            else:
                                                $res[$count]["geo_region"] = $keyRegion["geo_region_name"];

                                            endif;

                                        endif;
                                    endforeach;
                                endif;

                                $count++;
                            endif;
                        endif;
                    endforeach;
                endforeach;
            else:
                /// caso não tenha orderando por empresa
                foreach ($resAds as $keyAds):
                    /// catando status
                    if ($keyAds["ads_status"]):
                        $countActive++;
                    else:
                        $countDisable++;
                    endif;
                    /// filtrando por status
                    if ($filterStatus == $keyAds["ads_status"]):

                        $res[$count]["ads_id"] = $keyAds["ads_id"];
                        $res[$count]["ads_file"] = $keyAds["ads_file"];
                        $res[$count]["ads_link"] = $keyAds["ads_link"];
                        $res[$count]["ads_status"] = $keyAds["ads_status"];
                        $res[$count]["ads_start_display"] = $ads->dateToBr($keyAds["ads_start_display"]);
                        $res[$count]["ads_end_display"] = $ads->dateToBr($keyAds["ads_end_display"]);
                        $res[$count]["ads_date_insert"] = $ads->dateToBr($keyAds["ads_date_insert"], true);
                        $res[$count]["ads_date_update"] = $ads->dateToBr($keyAds["ads_date_update"], true);

                        foreach ($resCompany as $keyCompany):
                            if ($keyAds["company_id"] == $keyCompany["company_id"]):
                                $res[$count]["company_id"] = $keyCompany["company_id"];
                                $res[$count]["company_fantasy_name"] = $keyCompany["company_fantasy_name"];
                            endif;
                        endforeach;

                        foreach ($resLocal as $keyLocal):
                            if ($keyAds["ads_local_id"] == $keyLocal["ads_local_id"]):
                                $res[$count]["ads_local_id"] = $keyLocal["ads_local_id"];
                                $res[$count]["ads_local_name"] = $keyLocal["ads_local_name"];
                                $res[$count]["ads_local_height"] = $keyLocal["ads_local_height"];
                                $res[$count]["ads_local_width"] = $keyLocal["ads_local_width"];
                            endif;
                        endforeach;

                        if ($resRegion):
                            foreach ($resRegion as $keyRegion):
                                if ($keyAds["ads_id"] == $keyRegion["ads_id"]):

                                    if (isset($res[$count]["geo_region"])):

                                        $res[$count]["geo_region"] .= " " . $keyRegion["geo_region_name"];

                                    else:
                                        $res[$count]["geo_region"] = $keyRegion["geo_region_name"];

                                    endif;

                                endif;
                            endforeach;
                        endif;

                        $count++;
                    endif;
                endforeach;

            endif;
        endif;

        $return["items"] = $res;
        $return["active"] = ($countActive);
        $return["disable"] = ($countDisable);
        $return["total"] = count($resAds);


        return $return;


    }

}