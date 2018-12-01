<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 31/08/16
 * Time: 20:00
 */

sysLoadClass("GeoRegionRelationshipParent");

class AdminServicesGeoParent
{


    public function loadTable()
    {
        $geoRegion = new GeoRegionRelationshipParent();

        $cri = new Criteria();
        $cri->add(new Filter("geo_region_id_parent", "=", DjRequest::get("geo_region_id")));

        $col[] = "geo_region.geo_region_id";
        $col[] = "geo_region_name";

        return $geoRegion->sqlSelect($cri, $col);


    }


}