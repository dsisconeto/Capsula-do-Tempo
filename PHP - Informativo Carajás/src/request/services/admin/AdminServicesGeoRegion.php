<?php

sysLoadClass("GeoRegion");


class AdminServicesGeoRegion
{

    public function select2()
    {
        $regionName = DjRequest::get("q");
        $filterRegionId = DjRequest::get("filger_geo_region_id");
        $level = DjRequest::get("geo_region_level");
        $geoRegion = new GeoRegion();

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

            DjWork::select2($geoRegion->sqlSelect($cri3), array("id" => "geo_region_id", "text" => "geo_region_name"));

        else:
            $cri->setProperty("order", "geo_region_name ASC");

            DjWork::select2($geoRegion->sqlSelect($cri), array("id" => "geo_region_id", "text" => "geo_region_name"));

        endif;

    }

    public function search()
    {

        $geoRegion = new GeoRegion();
        $cri = new Criteria();

        $geoRegionName = DjRequest::post("geo_region_name", "string");


        $cri->add(new Filter("geo_region_name", "LIKE", "%{$geoRegionName}%"));

        $cri->setProperty("order", "geo_region_name ASC");

        $col[] = "geo_region_id";
        $col[] = "geo_region_name";
        $col[] = "geo_region_level";

        return $geoRegion->sqlSelect($cri, null, $col);


    }





    public function searchLowLevel()
    {
        $name = DjRequest::get("q", "str", DjRequest::get("geo_region_name", "str", ""));
        $geoRegionId = DjRequest::get("geo_region_id", "int", 0);


        $cri = new Criteria();
        $geoRegion = new GeoRegion();
        if ($geoRegion->sqlLoad($geoRegionId) && strlen($name) > 1 ) {

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

            $args["id"] = "geo_region_id";
            $args["text"] = "geo_region_name";

            DjWork::select2($geoRegion->sqlSelect($cri), $args);


        } else {


            return array();
        }


    }


}