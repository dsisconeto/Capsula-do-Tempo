<?php
namespace App\Controllers\Services\Site;

use App\Models\Company\Department;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;

class ServicesCompanyDepartment
{

    public function selectByCompany()
    {
        $department = new Department();
        $companyId = Request::get("company_id");

        $cri = new Criteria();

        $cri->add(new Filter("company_id_fk", "=", $companyId));


        $col[] = "company_department_id";
        $col[] = "company_department_name";

        return $department->select($cri, $col);

    }
}