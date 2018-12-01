<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:42
 */
class ModelCompanyRelationshipSegment extends dbConnection
{
    private $companyIdFk;
    private $companySegmentIdFk;

    /**
     * @return mixed
     */
    public function getCompanyIdFk()
    {
        return $this->companyIdFk;
    }

    /**
     * @param mixed $companyIdFk
     */
    public function setCompanyIdFk($companyIdFk)
    {
        $this->companyIdFk = $companyIdFk;
    }

    /**
     * @return mixed
     */
    public function getCompanySegmentIdFk()
    {
        return $this->companySegmentIdFk;
    }

    /**
     * @param mixed $companySegmentIdFk
     */
    public function setCompanySegmentIdFk($companySegmentIdFk)
    {
        $this->companySegmentIdFk = $companySegmentIdFk;
    }

    
    

}