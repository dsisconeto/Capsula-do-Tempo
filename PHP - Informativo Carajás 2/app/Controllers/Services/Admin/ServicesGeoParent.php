<?php
namespace App\Controllers\Services\Admin;

use DSisconeto\Simple\Request;
use App\Models\Geo\RegionRelationshipParent;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use App\Models\User\Login;

class ServicesGeoParent
{

    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"));
    }


    public function loadTable()
    {
        $geoRegion = new RegionRelationshipParent();

        $cri = new Criteria();
        $cri->add(new Filter("geo_region_id_parent", "=", Request::get("geo_region_id")));

        $col[] = "geo_region.geo_region_id";
        $col[] = "geo_region_name";

        return $geoRegion->select($cri, $col);


    }


}