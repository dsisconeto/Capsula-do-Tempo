<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:21
 */
class ModelCompanyEmail extends dbConnection
{
    private $companyEmailId;
    private $companyEmail;
    private $companyDepartmentIdFk;
    
    private $companyEmailDateInsert;
    private $companyEmailDateUpdate;

    /**
     * @return mixed
     */
    public function getCompanyEmailId()
    {
        return $this->companyEmailId;
    }

    /**
     * @param mixed $companyEmailId
     */
    public function setCompanyEmailId($companyEmailId)
    {
        $this->companyEmailId = $companyEmailId;
    }

    /**
     * @return mixed
     */
    public function getCompanyEmail()
    {
        return $this->companyEmail;
    }

    /**
     * @param mixed $companyEmail
     */
    public function setCompanyEmail($companyEmail)
    {
        $this->companyEmail = $companyEmail;
    }

    /**
     * @return mixed
     */
    public function getCompanyDepartmentIdFk()
    {
        return $this->companyDepartmentIdFk;
    }

    /**
     * @param mixed $companyDepartmentIdFk
     */
    public function setCompanyDepartmentIdFk($companyDepartmentIdFk)
    {
        $this->companyDepartmentIdFk = $companyDepartmentIdFk;
    }
    
    /**
     * @return mixed
     */
    public function getCompanyEmailDateInsert()
    {
        return $this->companyEmailDateInsert;
    }

    /**
     * @param mixed $companyEmailDateInsert
     */
    public function setCompanyEmailDateInsert($companyEmailDateInsert)
    {
        $this->companyEmailDateInsert = $companyEmailDateInsert;
    }

    /**
     * @return mixed
     */
    public function getCompanyEmailDateUpdate()
    {
        return $this->companyEmailDateUpdate;
    }

    /**
     * @param mixed $companyEmailDateUpdate
     */
    public function setCompanyEmailDateUpdate($companyEmailDateUpdate)
    {
        $this->companyEmailDateUpdate = $companyEmailDateUpdate;
    }

   


}