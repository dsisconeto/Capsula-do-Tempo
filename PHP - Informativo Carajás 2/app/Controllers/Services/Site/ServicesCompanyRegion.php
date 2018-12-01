<?php
namespace App\Controllers\Services\Site;

use App\Models\Company\RelationshipRegion;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;

class ServicesCompanyRegion
{


    public function selectByCompany()
    {

        $companyId = Request::get("company_id");
        $relationship = new RelationshipRegion();
        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $col[] = "geo_region_id";
        $col[] = "geo_region_name";

        return $relationship->select($cri, $col);
    }




}