<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:36
 */
class ModelCompanyPhone extends dbConnection
{
    private $companyPhoneId;
    private $companyDepartmentIdFk;
    private $companyPhone;
    private $companyPhoneDd;
    private $companyPhoneType;
    private $companyPhoneDateInsert;
    private $companyPhoneDateUpdate;

    /**
     * @return mixed
     */
    public function getCompanyPhoneDd()
    {
        return $this->companyPhoneDd;
    }

    /**
     * @param mixed $companyPhoneDd
     */
    public function setCompanyPhoneDd($companyPhoneDd)
    {
        $this->companyPhoneDd = $companyPhoneDd;
    }

    /**
     * @return mixed
     */
    public function getCompanyPhoneType()
    {
        return $this->companyPhoneType;
    }

    /**
     * @param mixed $companyPhoneType
     */
    public function setCompanyPhoneType($companyPhoneType)
    {

        if ($companyPhoneType == 1) {
            
            $this->companyPhoneType = 1;
            
        } else {
            $this->companyPhoneType = 2;
        }

    }


    /**
     * @return mixed
     */
    public function getCompanyPhoneId()
    {
        return $this->companyPhoneId;
    }

    /**
     * @param mixed $companyPhoneId
     */
    public function setCompanyPhoneId($companyPhoneId)
    {
        $this->companyPhoneId = $companyPhoneId;
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
    public function getCompanyPhone()
    {
        return $this->companyPhone;
    }

    /**
     * @param mixed $companyPhone
     */
    public function setCompanyPhone($companyPhone)
    {
        $this->companyPhone = $companyPhone;
    }

    /**
     * @return mixed
     */
    public function getCompanyPhoneDateInsert()
    {
        return $this->companyPhoneDateInsert;
    }

    /**
     * @param mixed $companyPhoneDateInsert
     */
    public function setCompanyPhoneDateInsert($companyPhoneDateInsert)
    {
        $this->companyPhoneDateInsert = $companyPhoneDateInsert;
    }

    /**
     * @return mixed
     */
    public function getCompanyPhoneDateUpdate()
    {
        return $this->companyPhoneDateUpdate;
    }

    /**
     * @param mixed $companyPhoneDateUpdate
     */
    public function setCompanyPhoneDateUpdate($companyPhoneDateUpdate)
    {
        $this->companyPhoneDateUpdate = $companyPhoneDateUpdate;
    }


}