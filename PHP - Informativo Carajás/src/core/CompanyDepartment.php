<?php


sysLoadClass("ActionCompanyDepartment");
sysLoadClass("Company");
use Respect\Validation\Validator as respect;

class CompanyDepartment extends ActionCompanyDepartment
{

    public function __construct()
    {


    }


    public function validateByUser($companyDepartmentId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_department_id', '=', $companyDepartmentId));
        $criteria->setProperty("limit", 1);
        $col[] = "company_id_fk";
        $res = $this->sqlSelect($criteria, $col);

        $company = new Company();

        return $res ? $company->validateByUser($res[0]["company_id_fk"]) : false;


    }


}