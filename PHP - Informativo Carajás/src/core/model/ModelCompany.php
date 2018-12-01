<?php

class ModelCompany extends dbConnection
{
    private $companyId;
    private $companyName;
    private $companyFantasyName;
    private $companyLogo;
    private $companyCover;
    private $companyCnpjOrCpf;
    private $companyNivel;
    private $companyAddress;
    private $companyAddressEmbed;
    private $systemUrlIdFk;
    private $companyDescription;
    private $companySystemUserIdFk;
    private $companySystemUserIdRegisterFk;
    private $companyStatus;
    private $companyDateInsert;
    private $companyDateUpdate;

    /**

    /**
     * @return mixed
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * @param mixed $companyAddress
     */
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;
    }

    /**
     * @return mixed
     */
    public function getCompanyAddressEmbed()
    {
        return $this->companyAddressEmbed;
    }

    /**
     * @param mixed $companyAddressEmbed
     */
    public function setCompanyAddressEmbed($companyAddressEmbed)
    {
        $this->companyAddressEmbed = $companyAddressEmbed;
    }
    
    /**
     * @return mixed
     */
    public function getSystemUrlIdFk()
    {
        return $this->systemUrlIdFk;
    }

    /**
     * @param mixed $systemUrlIdFk
     */
    public function setSystemUrlIdFk($systemUrlIdFk)
    {
        $this->systemUrlIdFk = $systemUrlIdFk;
    }


    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param mixed $companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyFantasyName()
    {
        return $this->companyFantasyName;
    }

    /**
     * @param mixed $companyFantasyName
     */
    public function setCompanyFantasyName($companyFantasyName)
    {
        $this->companyFantasyName = $companyFantasyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     * @param mixed $companyLogo
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo;
    }

    /**
     * @return mixed
     */
    public function getCompanyCover()
    {
        return $this->companyCover;
    }

    /**
     * @param mixed $companyCover
     */
    public function setCompanyCover($companyCover)
    {
        $this->companyCover = $companyCover;
    }

    /**
     * @return mixed
     */
    public function getCompanyCnpjOrCpf()
    {
        return $this->companyCnpjOrCpf;
    }

    /**
     * @param mixed $companyCnpjOrCpf
     */
    public function setCompanyCnpjOrCpf($companyCnpjOrCpf)
    {
        $this->companyCnpjOrCpf = $companyCnpjOrCpf;
    }

    /**
     * @return mixed
     */
    public function getCompanyNivel()
    {
        return $this->companyNivel;
    }

    /**
     * @param mixed $companyNivel
     */
    public function setCompanyNivel($companyNivel)
    {
        $this->companyNivel = $companyNivel;
    }

    /**
     * @return mixed
     */
    public function getCompanyDescription()
    {
        return $this->companyDescription;
    }

    /**
     * @param mixed $companyDescription
     */
    public function setCompanyDescription($companyDescription)
    {
        $this->companyDescription = $companyDescription;
    }

    /**
     * @return mixed
     */
    public function getCompanySystemUserIdFk()
    {
        return $this->companySystemUserIdFk;
    }

    /**
     * @param mixed $companySystemUserIdFk
     */
    public function setCompanySystemUserIdFk($companySystemUserIdFk)
    {
        $this->companySystemUserIdFk = $companySystemUserIdFk;
    }

    /**
     * @return mixed
     */
    public function getCompanySystemUserIdRegisterFk()
    {
        return $this->companySystemUserIdRegisterFk;
    }

    /**
     * @param mixed $companySystemUserIdRegisterFk
     */
    public function setCompanySystemUserIdRegisterFk($companySystemUserIdRegisterFk)
    {
        $this->companySystemUserIdRegisterFk = $companySystemUserIdRegisterFk;
    }


    /**
     * @return mixed
     */
    public function getCompanyStatus()
    {
        return $this->companyStatus;
    }

    /**
     * @param mixed $companyStatus
     */
    public function setCompanyStatus($companyStatus)
    {
        $this->companyStatus = $companyStatus;
    }

    /**
     * @return mixed
     */
    public function getCompanyDateInsert()
    {
        return $this->companyDateInsert;
    }

    /**
     * @param mixed $companyDateInsert
     */
    public function setCompanyDateInsert($companyDateInsert)
    {
        $this->companyDateInsert = $companyDateInsert;
    }

    /**
     * @return mixed
     */
    public function getCompanyDateUpdate()
    {
        return $this->companyDateUpdate;
    }

    /**
     * @param mixed $companyDateUpdate
     */
    public function setCompanyDateUpdate($companyDateUpdate)
    {
        $this->companyDateUpdate = $companyDateUpdate;
    }


}