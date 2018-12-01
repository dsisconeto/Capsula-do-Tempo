<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 25/07/2016
 * Time: 21:45
 */
sysLoadClass("ActionCompanySocialNetwork");
sysLoadClass("Company");
use Respect\Validation\Validator as respect;

class CompanySocialNetwork extends ActionCompanySocialNetwork
{


    public function __construct()
    {



    }


    public function selectByView($companyId)
    {


        $social = new CompanySocialNetwork();
        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $cri->setProperty("order", "system_social_network_name ASC");
        $col[] = "company_social_network_id";
        $col[] = "system_social_network_name";
        $col[] = "company_social_network_link";
        $col[] = "system_social_network_icon";
        $col[] = "system_social_network_color";

        return $social->sqlSelect($cri, $col);

    }




    public function validateByUser($companySocialNetworkId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_social_network_id', '=', $companySocialNetworkId));
        $criteria->setProperty("limit", 1);
        $col[] = "company_id_fk";
        $res = $this->sqlSelect($criteria, $col);

        $company = new Company();

        return $res ? $company->validateByUser($res[0]["company_id_fk"]) : false;
    }



}