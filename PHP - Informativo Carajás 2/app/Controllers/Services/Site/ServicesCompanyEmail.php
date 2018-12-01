<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:55
 */

namespace App\Controllers\Services\Site;

use App\Models\Company\Email;
use DSisconeto\Simple\Request;

class ServicesCompanyEmail
{


    public function selectByCompany()
    {

        $companyId = Request::get("company_id", "int", 0);
        $email = new Email();
        return $email->selectByCompany($companyId);

    }


}