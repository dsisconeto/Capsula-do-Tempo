<?php
sysLoadClass("CompanyDepartment");

class ServicesCompanyDepartment
{

    public function selectByCompany()
    {
        $department = new CompanyDepartment();
        $companyId = DjRequest::get("company_id");

        $cri = new Criteria();

        $cri->add(new Filter("company_id_fk", "=", $companyId));


        $col[] = "company_department_id";
        $col[] = "company_department_name";

        return $department->sqlSelect($cri, $col);

    }
}