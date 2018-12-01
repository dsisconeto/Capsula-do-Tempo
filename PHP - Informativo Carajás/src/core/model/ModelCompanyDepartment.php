<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:20
 */
class ModelCompanyDepartment extends dbConnection
{

    private $companyDepartmentId;
    private $companyIdFk;
    private $companyDepartmentName;
    private $companyDepartmentDateInsert;
    private $companyDepartmentDateUpdate;

    /**
     * @return mixed
     */
    public function getCompanyDepartmentId()
    {
        return $this->companyDepartmentId;
    }

    /**
     * @param mixed $companyDepartmentId
     */
    public function setCompanyDepartmentId($companyDepartmentId)
    {
        $this->companyDepartmentId = $companyDepartmentId;
    }

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
    public function getCompanyDepartmentName()
    {
        return $this->companyDepartmentName;
    }

    /**
     * @param mixed $companyDepartmentName
     */
    public function setCompanyDepartmentName($companyDepartmentName)
    {
        $this->companyDepartmentName = $companyDepartmentName;
    }

    /**
     * @return mixed
     */
    public function getCompanyDepartmentDateInsert()
    {
        return $this->companyDepartmentDateInsert;
    }

    /**
     * @param mixed $companyDepartmentDateInsert
     */
    public function setCompanyDepartmentDateInsert($companyDepartmentDateInsert)
    {
        $this->companyDepartmentDateInsert = $companyDepartmentDateInsert;
    }

    /**
     * @return mixed
     */
    public function getCompanyDepartmentDateUpdate()
    {
        return $this->companyDepartmentDateUpdate;
    }

    /**
     * @param mixed $companyDepartmentDateUpdate
     */
    public function setCompanyDepartmentDateUpdate($companyDepartmentDateUpdate)
    {
        $this->companyDepartmentDateUpdate = $companyDepartmentDateUpdate;
    }




}