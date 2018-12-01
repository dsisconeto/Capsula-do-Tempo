<?php

namespace App\Controllers\Services\Site;


use App\Models\Company\Gallery;
use DSisconeto\Simple\Request;

class ServicesCompanyGallery
{

    public function selectBycCompany()
    {
        $gallery = new Gallery();
        $companyId = Request::get("company_id", "int", 0);

        return $gallery->selectBycCompany($companyId);
    }

}