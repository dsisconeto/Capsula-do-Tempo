<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 24/05/2016
 * Time: 14:45
 */

sysLoadClass("ActionCompanyPhone");
sysLoadClass("CompanyDepartment");


class CompanyPhone extends ActionCompanyPhone
{

    public function __construct()
    {

    }


    public function validateByUser($companyPhoneId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_phone_id', '=', $companyPhoneId));
        $criteria->setProperty("limit", 1);
        $col[] = "company_id_fk";
        $res = $this->sqlSelect($criteria, $col);

        $company = new Company();

        return $res ? $company->validateByUser($res[0]["company_id_fk"]) : false;
    }

    public function selectByCompany($companyId)
    {
        $phone = new CompanyPhone();
        $cri = new Criteria();
        $result = array();
        $count = 0;
        $cri->add(new Filter("company_department.company_id_fk", "=", $companyId));

        $col[] = "company_phone_id";
        $col[] = "company_phone";
        $col[] = "company_department_name";
        $col[] = "company_phone_dd";
        $col[] = "company_phone";
        $col[] = "company_phone_type";

        $res = $phone->sqlSelect($cri, $col);

        if ($res) {
            foreach ($res as $key) {
                $result[$count]["company_phone_id"] = $key["company_phone_id"];
                $result[$count]["company_phone"] = $key["company_department_name"] . ": " . $phone->formatPhone($key["company_phone_dd"], $key["company_phone"], $key["company_phone_type"]);
                $count++;
            }


        }


        return $result;


    }


}