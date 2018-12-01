<?php
namespace App\Controllers\Services\Site;

use App\Models\Company\RelationshipSegment;
use DSisconeto\Simple\Request;

class ServicesCompanySegment
{


    public function selectByCompany()
    {
        $companyId = Request::get("company_id");
        $companySegment = new RelationshipSegment();

        return $companySegment->selectByCompany($companyId);


    }

}