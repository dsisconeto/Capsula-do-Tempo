<?php
sysLoadClass("CompanyRelationshipSegment");

class ServicesCompanySegment
{


    public function selectByCompany()
    {
        $companyId = DjRequest::get("company_id");
        $companySegment = new CompanyRelationshipSegment();

        return $companySegment->selectByCompany($companyId);


    }

}