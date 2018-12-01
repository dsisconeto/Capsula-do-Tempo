<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 20:05
 */


sysLoadClass("CompanyPhone");

class ServicesCompanyPhone
{


    public function selectByCompany()
    {


        $phone = new CompanyPhone();

        return $phone->selectByCompany(DjRequest::get("company_id"));
    }


}