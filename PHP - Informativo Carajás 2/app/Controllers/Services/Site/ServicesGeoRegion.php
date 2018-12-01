<?php

namespace App\Controllers\Services\Site;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;

class ServicesGeoRegion
{

    public function select2()
    {
        $regionName = Request::get("q");
        $filterRegionId = Request::get("filger_geo_region_id");

        $geoRegion = new Region();

        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri->add(New Filter("geo_region_name", "LIKE", "%{$regionName}%"));


        if ($filterRegionId):

            foreach ($filterRegionId as $keyRegion):

                $cri2->add(New Filter("geo_region_id", "=", "{$keyRegion["geo_region_id"]}"), $cri2::OR_OPERATOR);

            endforeach;

            $cri3->add($cri);
            $cri3->add($cri2);
            $cri3->setProperty("order", "geo_region_name ASC");

            DataFormat::select2($geoRegion->selectConfig($cri3), array("id" => "geo_region_id", "text" => "geo_region_name"));

        else:
            $cri->setProperty("order", "geo_region_name ASC");

            DataFormat::select2($geoRegion->selectConfig($cri), array("id" => "geo_region_id", "text" => "geo_region_name"));

        endif;

    }


    public function selectSubRegionByRegion()
    {

        $parent = new RegionRelationshipParent();

        $geoRegionId = Request::get("geo_region_id");

        $cri = new Criteria();
        $cri->add(new Filter("geo_region_id_parent", "=", $geoRegionId));
        $cri->setProperty("order", "geo_region_name ASC");
        $col = array("geo_region.geo_region_id", "geo_region.geo_region_name");


        return $parent->select($cri, $col);
    }

    public function searchLevel()
    {
        $geoRegion = new Region();
        $cri = new Criteria();
        $name = Request::get("geo_region_name", "str", "");
        $level = Request::get("geo_region_level", "int", 1);

        if (strlen($name) >= 2) {
            $cri->add(New Filter("geo_region_name", "LIKE", "%{$name}%"));
            $cri->add(new Filter("geo_region_level", "=", $level));
            $cri->setProperty("order", "geo_region_name ASC");

            $args["id"] = "geo_region_id";
            $args["text"] = "geo_region_name";

            DataFormat::select2($geoRegion->select($cri), $args);

        }

    }


}