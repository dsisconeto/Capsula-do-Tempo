<?php

sysLoadClass("Ads");
sysLoadClass("TrafficViewAds");
sysLoadClass("AdsRelationshipRegion");

class ServicesAds extends DjRouter
{


    public function show()
    {
        $ads = new Ads();
        $traffic = new TrafficViewAds();
        $adsRelationshipRegion = new AdsRelationshipRegion();
        $res = array();
        $resAdsByRegion = $adsRelationshipRegion->selectAdsByRegion(DjRequest::cookie("geo_region_id", "int", 0), DjRequest::get("local"));
        $view = DjRequest::get("view");
        $url = DjRequest::get("url", "str", "");

        if ($resAdsByRegion):
            $resAdsByRegion = $resAdsByRegion[0];
            $traffic->register($resAdsByRegion["ads_id"]);

            $res["ads_link"] = DjWork::getHost() . "anuncio/click/{$resAdsByRegion["ads_id"]}/?continue=" . $resAdsByRegion["ads_link"] . "&url=$url";
            $res["ads_file"] = $ads->getImgFolderLg($resAdsByRegion["ads_file"], 1, true);

            $ads->updateTurnover($resAdsByRegion["ads_id"], DjRequest::cookie("geo_region_id", "int", 0), DjRequest::get("local"));
        endif;


        if ($res):

            if ($view == "json"):

                $json["ads_content"] = "<a  target='_blank'  href='{$res["ads_link"]}' rel='nofollow'><img style='display:block;margin-right:auto;margin-left:auto; max-width: 100%; height: auto; border: 1px solid #d5d5d5;' src='{$res["ads_file"]}'></a>";
                echo json_encode($json);

            elseif ($view == "html"):

                echo "<style>*{padding: 0;margin:0;}</style><a  target='_blank'  href='{$res["ads_link"]}' rel='nofollow'><img style='display:block;margin-right:auto;margin-left:auto; max-width: 100%; height: auto; border: 1px solid #d5d5d5;' src='{$res["ads_file"]}'></a>";

            elseif ($view == "js"):

                echo "document.write(\"<a  target='_blank'  href='{$res["ads_link"]}' rel='nofollow'><img style='display:block;margin-right:auto;margin-left:auto; max-width: 100%; height: auto; border: 1px solid #d5d5d5;' src='{$res["ads_file"]}'></a>\")";

            endif;


        endif;
        exit();

    }

}