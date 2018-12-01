<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 24/05/2016
 * Time: 14:40
 */
sysLoadClass("ActionCompanyGallery");
sysLoadClass("Company");


class CompanyGallery extends ActionCompanyGallery
{

    public function __construct()
    {

        $this->setImgFolder("company_gallery");

    }



    public function selectBycCompany($companyId)
    {
        $gallery = new CompanyGallery();


        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $cri->setProperty("order", "company_gallery_order ASC");
        $col[] = "company_gallery_id";
        $col[] = "company_gallery_file";

        return $gallery->sqlSelect($cri, $col);
    }



    public function validateByUser($companyGalleryId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_gallery_id', '=', $companyGalleryId));
        $criteria->setProperty("limit", 1);
        $col[] = "company_id_fk";
        $res = $this->sqlSelect($criteria, $col);

        $company = new Company();

        return $res ? $company->validateByUser($res[0]["company_id_fk"]) : false;
    }

    public function lastOrder($companyId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $companyId));
        $cri->setProperty("order", "company_gallery_order");
        $cri->setProperty("limit", "1");
        $res = $this->sqlSelect($cri);
        if (isset($res[0])) {

            return ($res[0]["company_gallery_order"]++);

        } else {
            return 1;
        }

    }





}