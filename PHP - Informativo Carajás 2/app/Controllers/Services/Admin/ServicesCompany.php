<?php

namespace App\Controllers\Services\Admin;

use App\Models\Company\Company;

use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;
use Respect\Validation\Validator as respect;

class ServicesCompany
{


    public function __construct()
    {

        Login::validateServices(Request::cookie("jwt"), array(7));

        $companyId = Request::get("company_id", "int", 0);

        if ($companyId) {
            $comapany = new Company();
            $comapany->validateByUser($companyId);
        }
    }

    public function search()
    {

        $arg = Request::get("company_search_arg", "str", "");
        $companyStatus = Request::get("company_status", "int", 3);
        $orderBy = Request::get("order_by", "int", 0);
        $order = Request::get("order", "str", "desc");
        $page = Request::get("page", "int", 1);
        $limitByPage = Request::get("limit_by_page", "int", 10);

        $company = new Company();
        $regionUser = new RegionUserPermission();
        $return["items"] = NULL;
        $return["pageNumber"] = 0;
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();
        $cri4 = $regionUser->createCriteria("company", "geo_region_id_fk");

        // pesquisar pelo nome, e pelo nome do segmento
        if (respect::length(1)->validate($arg)) {
            $cri->add(new Filter("company_fantasy_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
            $cri->add(new Filter("company_segment_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
            $cri3->add($cri);
        }
        // filtrar por status
        if ($companyStatus == 0 || $companyStatus == 1) {
            $cri2->add(new Filter("company_status", "=", $companyStatus));
            $cri3->add($cri2);
        }

        $cri3->add($cri4);

        if ($orderBy) {
            $orderBy = "company_fantasy_name";
        } else {
            $orderBy = "company_date_insert";
        }

        // definindo a ordem
        $order = strtolower($order);


        if ($order != "asc") {

            $order = " DESC ";
        } else {

            $order = " ASC ";
        }

        $cri3->setProperty("order", "$orderBy $order");


        // definindo dados a serem retornandos
        $col[] = "company_id";
        $col[] = "company_fantasy_name";
        $col[] = "company_logo";
        $col[] = "company_nivel";
        $col[] = "system_url_url";
        $col[] = "company_status";

        // sistema de pagaginacao
        $resultCompany = $company->searchAdmin($cri3, "COUNT(DISTINCT company_id) as count");
        $pageNumber = ceil($resultCompany[0]["count"] / $limitByPage);


        $cri3->setProperty("limit", DataFormat::paginate($page, $limitByPage));

        $return["items"] = $company->searchAdmin($cri3, $col);
        $return["pageNumber"] = $pageNumber;

        return $return;
    }


}