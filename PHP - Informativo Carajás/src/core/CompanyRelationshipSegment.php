<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 24/05/2016
 * Time: 15:07
 */
sysLoadClass("ActionCompanyRelationshipSegment");
sysLoadClass("Company");

class CompanyRelationshipSegment extends ActionCompanyRelationshipSegment
{


    public function __construct()
    {

    }



    public function selectByCompany($companyId)
    {

        $companySegment = new CompanyRelationshipSegment();
        $cri = new Criteria();

        $cri->add(new Filter("company_id_fk", "=", $companyId));

        $col[] = "company_segment_name";
        $col[] = "company_segment_id";
        $col[] = "company_id_fk";

        return $companySegment->sqlSelect($cri, $col);

    }



    public function issetRelation($companySegmentId, $companyId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $cri->add(new Filter("company_segment_id_fk", "=", $companySegmentId));
        $cri->setProperty("limit", "1");

        return $this->sqlSelect($cri);
    }


    public function validateByUser($companyId)
    {
        $company = new Company();
        return $company->validateByUser($companyId);

    }




}