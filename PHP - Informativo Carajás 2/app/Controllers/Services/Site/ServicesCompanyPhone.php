<?php
namespace App\Controllers\Services\Site;

use App\Models\Company\Phone;
use DSisconeto\Simple\Request;



class ServicesCompanyPhone
{


    public function selectByCompany()
    {
        $phone = new Phone();

        return $phone->selectByCompany(Request::get("company_id"));
    }


}