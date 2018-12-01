<?php
sysLoadClass("CompanyGallery");

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 20:03
 */
class ServicesCompanyGallery
{

    public function selectBycCompany()
    {
        $gallery = new CompanyGallery();
        $companyId = DjRequest::get("company_id");

        return $gallery->selectBycCompany($companyId);
    }

}