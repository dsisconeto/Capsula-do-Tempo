<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:55
 */

sysLoadClass("CompanyEmail");

class ServicesCompanyEmail
{


    public function selectByCompany()
    {

        $companyId = DjRequest::get("company_id", "int", 0);
        $email = new CompanyEmail();
        return $email->selectByCompany($companyId);

    }


}