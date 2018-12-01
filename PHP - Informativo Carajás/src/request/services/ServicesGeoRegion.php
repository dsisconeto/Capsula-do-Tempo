<?php
sysLoadClass("GeoRegion");
sysLoadClass("GeoRegionRelationshipParent");

class ServicesGeoRegion
{

    public function select2()
    {
        $regionName = DjRequest::get("q");
        $filterRegionId = DjRequest::get("filger_geo_region_id");

        $geoRegion = new GeoRegion();

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

            DjWork::select2($geoRegion->sqlSelectConfig($cri3), array("id" => "geo_region_id", "text" => "geo_region_name"));

        else:
            $cri->setProperty("order", "geo_region_name ASC");

            DjWork::select2($geoRegion->sqlSelectConfig($cri), array("id" => "geo_region_id", "text" => "geo_region_name"));

        endif;

    }


    public function selectSubRegionByRegion()
    {
        $geoRegion = new GeoRegion();
        $parent = new GeoRegionRelationshipParent();

        $geoRegionId = DjRequest::get("geo_region_id");

        $cri = new Criteria();
        $cri->add(new Filter("geo_region_id_parent", "=", $geoRegionId));
        $cri->setProperty("order", "geo_region_name ASC");


        return $parent->sqlSelect($cri);

    }

    public function searchLevel()
    {
        $geoRegion = new GeoRegion();
        $cri = new Criteria();
        $name = DjRequest::get("geo_region_name", "str", "");
        $level = DjRequest::get("geo_region_level", "int", 1);

        if (strlen($name) >=2 ) {
            $cri->add(New Filter("geo_region_name", "LIKE", "%{$name}%"));
            $cri->add(new Filter("geo_region_level", "=", $level));
            $cri->setProperty("order", "geo_region_name ASC");

            $args["id"] = "geo_region_id";
            $args["text"] = "geo_region_name";

            DjWork::select2($geoRegion->sqlSelect($cri), $args);

        }

    }


}