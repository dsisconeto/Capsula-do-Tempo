<?php

namespace App\Controllers\Services\Site;

use App\Models\Company\SocialNetwork;
use DSisconeto\Simple\Request;

class ServicesCompanySocialNetwork
{


    public function selectByView()
    {

        $companyId = Request::get("company_id", "int", 0);
        $social = new SocialNetwork();

        return $social->selectByView($companyId);


    }

}