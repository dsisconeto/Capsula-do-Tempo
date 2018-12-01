<?php

namespace App\Controllers\Services\Site;

use App\Models\Ads\Ads;
use App\Models\Ads\RelationshipRegion;
use App\Models\Geo\Region;
use App\Models\Traffic\ViewAds;
use DSisconeto\Simple\Request;


class ServicesAds
{


    public function show()
    {
        // função para servir anucio para o usario

        $ads = new Ads();
        $traffic = new ViewAds();
        $adsRelationshipRegion = new RelationshipRegion();
        $res = array();
        $resAdsByRegion = $adsRelationshipRegion->selectAdsByRegion(Region::define(), Request::get("local"));

        $view = Request::get("view");
        $url = Request::get("url", "str", "");

        if ($resAdsByRegion):
            $resAdsByRegion = $resAdsByRegion[0];
            $traffic->ads()->setId($resAdsByRegion["ads_id"]);
            $traffic->register();

            $res["ads_link"] = "/anuncio/click/{$resAdsByRegion["ads_id"]}/?continue=" . $resAdsByRegion["ads_link"] . "&url=$url";
            $res["ads_file"] = $ads->getImgFolderLg($resAdsByRegion["ads_file"], 1, true);

            $ads->updateTurnover($resAdsByRegion["ads_id"], Region::define(), Request::get("local"));
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