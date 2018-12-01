<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:45
 */

namespace App\Controllers\Services\Site;
use App\Models\Company\Company;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;

class ServicesCompany
{


    public function search()
    {

        $arg = Request::get("company_search_arg");
        $company = new Company();

        return $company->search($arg);

    }


    public function select2()
    {
        $company = new Company();
        $json = NULL;

        $q = Request::get("q");
        $cri = new Criteria();
        $cri->add(new Filter("company_fantasy_name", "LIKE", "%{$q}%"));
        $cri->add(new Filter("company_nivel", ">=", 2));
        $res = $company->select($cri);
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

        if (($company->load(Request::get("company_id"))) && $company->getLogo()) {

            $res[0]["company_logo"] = $company->getLogo();

        } else {

            $res = array();
        }

        return $res;
    }

    public function cover()
    {

        $company = new Company();

        if (($company->load(Request::get("company_id"))) && $company->getCover()) {

            $res[0]["company_cover"] = $company->getCover();

        } else {

            $res = array();
        }

        return $res;

    }

}