<?php

namespace App\Controllers\Services\Site\Company;

use App\Models\Company\RelationshipFeatured;
use DSisconeto\Simple\Request;

class ServicesFeatured
{


    public function selectByRegion()
    {

        $region = Request::get("geo_region_id", "int", 0);
        $featured = Request::get("company_featured_id", "int", 0);

        return (new RelationshipFeatured())->selectRegion($region, $featured);;
    }


}