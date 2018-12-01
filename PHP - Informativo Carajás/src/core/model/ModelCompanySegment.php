<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:43
 */
class ModelCompanySegment extends dbConnection
{
    private $companySegmentId;
    private $companySegmentName;
    private $companySegmentDateInsert;
    private $companySegmentDateUpdate;

    /**
     * @return mixed
     */
    public function getCompanySegmentId()
    {
        return $this->companySegmentId;
    }

    /**
     * @param mixed $companySegmentId
     */
    public function setCompanySegmentId($companySegmentId)
    {
        $this->companySegmentId = $companySegmentId;
    }

    /**
     * @return mixed
     */
    public function getCompanySegmentName()
    {
        return $this->companySegmentName;
    }

    /**
     * @param mixed $companySegmentName
     */
    public function setCompanySegmentName($companySegmentName)
    {
        $this->companySegmentName = $companySegmentName;
    }

    /**
     * @return mixed
     */
    public function getCompanySegmentDateInsert()
    {
        return $this->companySegmentDateInsert;
    }

    /**
     * @param mixed $companySegmentDateInsert
     */
    public function setCompanySegmentDateInsert($companySegmentDateInsert)
    {
        $this->companySegmentDateInsert = $companySegmentDateInsert;
    }

    /**
     * @return mixed
     */
    public function getCompanySegmentDateUpdate()
    {
        return $this->companySegmentDateUpdate;
    }

    /**
     * @param mixed $companySegmentDateUpdate
     */
    public function setCompanySegmentDateUpdate($companySegmentDateUpdate)
    {
        $this->companySegmentDateUpdate = $companySegmentDateUpdate;
    }
    

}