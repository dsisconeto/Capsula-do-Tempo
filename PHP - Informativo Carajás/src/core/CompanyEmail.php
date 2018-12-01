<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 24/05/2016
 * Time: 14:17
 */

sysLoadClass("Company");
sysLoadClass("ActionCompanyEmail");
use Respect\Validation\Validator as respect;

class CompanyEmail extends ActionCompanyEmail
{


    public function __construct()
    {

    }


    public function validateByUser($emailId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_email_id', '=', $emailId));
        $criteria->setProperty("limit", 1);
        $col[] = "company_id_fk";
        $res = $this->sqlSelect($criteria, $col);

        $company = new Company();

        return $res ? $company->validateByUser($res[0]["company_id_fk"]) : false;


    }


    public function selectByCompany($companyId)
    {


        $email = new CompanyEmail();

        $cri = new Criteria();
        $result = array();
        $count = 0;
        $cri->add(New Filter("company_department.company_id_fk", "=", $companyId));

        $col[] = "company_email_id";
        $col[] = "company_email";
        $col[] = "company_department_name";

        $res = $email->sqlSelect($cri, $col);

        if ($res) {

            foreach ($res as $key) {
                $result[$count]["company_email_id"] = $key["company_email_id"];
                $result[$count]["company_email"] = "{$key["company_department_name"]}: " . $key["company_email"];
                $count++;
            }
        }


        return $result;


    }


}