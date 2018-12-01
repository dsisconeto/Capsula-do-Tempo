<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 24/05/2016
 * Time: 18:28
 */
sysLoadClass("ActionCompanySegment");

class CompanySegment extends ActionCompanySegment
{


    public function selectAllOrderByName()
    {

        $cri = new Criteria();
        $cri->setProperty("order", "company_segment_name ASC");

        return $this->sqlSelect($cri);
    }

}