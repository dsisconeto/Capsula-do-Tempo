<?php

sysLoadClass("CompanySocialNetwork");

class ServicesCompanySocialNetwork
{


    public function selectByView()
    {

        $companyId = DjRequest::get("company_id");
        $social = new CompanySocialNetwork();
        return $social->selectByView($companyId);


    }

}