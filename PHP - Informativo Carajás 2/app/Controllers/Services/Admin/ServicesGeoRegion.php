<?php

namespace App\Controllers\Services\Admin;

use App\Models\Geo\Region;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;
use App\Models\User\Login;


class ServicesGeoRegion
{
    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"));
    }


    public function select2()
    {
        $regionName = Request::get("q");
        $filterRegionId = Request::get("filger_geo_region_id");
        $level = Request::get("geo_region_level");
        $geoRegion = new Region();

        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri->add(New Filter("geo_region_name", "LIKE", "%{$regionName}%"));

        if ($level) {
            $cri->add(New Filter("geo_region_level", "=", $level));
        }

        if ($filterRegionId):

            foreach ($filterRegionId as $keyRegion):

                $cri2->add(New Filter("geo_region_id", "=", "{$keyRegion["geo_region_id"]}"), $cri2::OR_OPERATOR);

            endforeach;

            $cri3->add($cri);
            $cri3->add($cri2);
            $cri3->setProperty("order", "geo_region_name ASC");
            $cri3->setProperty("limit", "20");

            DataFormat::select2($geoRegion->selectConfig($cri3), array("id" => "geo_region_id", "text" => "geo_region_name"));

        else:
            $cri->setProperty("order", "geo_region_name ASC");

            DataFormat::select2($geoRegion->selectConfig($cri), array("id" => "geo_region_id", "text" => "geo_region_name"));

        endif;

    }

    public function search()
    {

        $geoRegion = new Region();
        $cri = new Criteria();

        $geoRegionName = Request::post("geo_region_name", "string");


        $cri->add(new Filter("geo_region_name", "LIKE", "%{$geoRegionName}%"));

        $cri->setProperty("order", "geo_region_name ASC");

        $col[] = "geo_region_id";
        $col[] = "geo_region_name";
        $col[] = "geo_region_level";

        return $geoRegion->select($cri, $col);


    }


    public function searchLowLevel()
    {
        $name = Request::get("q", "str", Request::get("geo_region_name", "str", ""));
        $geoRegionId = Request::get("geo_region_id", "int", 0);


        $cri = new Criteria();
        $geoRegion = new Region();
        if ($geoRegion->load($geoRegionId) && strlen($name) > 1) {

            switch ($geoRegion->getLevel()) {

                case 2:
                    $cri->add(new Filter("geo_region_level", "=", "1"));

                    break;
                case 4:

                    $cri->add(new Filter("geo_region_level", "=", "2"));

                    break;

                case 5:

                    $cri->add(new Filter("geo_region_level", "=", "2"));

                    break;


            }

            $cri->add(new Filter("geo_region_name", "LIKE", "%{$name}%"));
            $cri->setProperty("limit", 20);
            $args["id"] = "geo_region_id";
            $args["text"] = "geo_region_name";

            DataFormat::select2($geoRegion->select($cri), $args);


        }


        return array();


    }


}