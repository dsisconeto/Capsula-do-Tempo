<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 29/10/16
 * Time: 15:49
 */
sysLoadClass("GeoRegionUserPermission");

class AdminGeoRegionUserPermission
{


    public function search()
    {

        $regionName = DjRequest::get("geo_region_name");
        $permission = DjRequest::get("permission");
        $permissionUser = New GeoRegionUserPermission();

        DjWork::select2($permissionUser->searchRegion($regionName, $permission), array("id" => "geo_region_id", "text" => "geo_region_name"));
    }


}