<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:45
 */


sysLoadClass("Company");

class ServicesCompany
{


    public function search()
    {

        $arg = DjRequest::get("company_search_arg");
        $company = new Company();

        return $company->search($arg);

    }


    public function select2()
    {
        $company = new Company();

        $q = DjRequest::get("q");
        $cri = new Criteria();
        $cri->add(new Filter("company_fantasy_name", "LIKE", "%{$q}%"));
        $cri->add(new Filter("company_nivel", ">=", 2));
        $res = $company->sqlSelect($cri);
        $count = 0;

        if ($res):

            foreach ($res as $key):
                $json[$count]["id"] = $key["company_id"];
                $json[$count]["text"] = $key["company_cnpj_or_cpf"] . " - " . $key["company_fantasy_name"];
                $count++;
            endforeach;

            echo json_encode($json);
            exit();
        endif;


    }

    public function logo()
    {
        $company = new Company();

        if (($company->sqlLoad(DjRequest::get("company_id"))) && $company->getCompanyLogo()) {

            $res[0]["company_logo"] = $company->getCompanyLogo();

        } else {

            $res = array();
        }

        return $res;
    }

    public function cover()
    {

        $company = new Company();

        if (($company->sqlLoad(DjRequest::get("company_id"))) && $company->getCompanyCover()) {

            $res[0]["company_cover"] = $company->getCompanyCover();

        } else {

            $res = array();
        }

        return $res;

    }

}