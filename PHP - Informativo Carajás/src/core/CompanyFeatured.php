<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 29/05/2016
 * Time: 16:03
 */
sysLoadClass("ActionCompanyFeatured");

class CompanyFeatured extends ActionCompanyFeatured
{


    public function selectAll()
    {
        $cri = new Criteria();
        $cri->setProperty("order", "company_featured_name ASC");

        return $this->sqlSelect($cri);

    }


}