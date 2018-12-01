<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:48
 */
class ModelCompanySocialNetwork extends dbConnection
{
    private $companySocialNetworkId;
    private $companyIdFk;
    private $systemSocialNetworkIdFk;
    private $companySocialNetworkLink;
    private $companySocialNetworkDateInsert;
    private $companySocialNetworkDateUpdate;

    /**
     * @return mixed
     */
    public function getCompanySocialNetworkId()
    {
        return $this->companySocialNetworkId;
    }

    /**
     * @param mixed $companySocialNetworkId
     */
    public function setCompanySocialNetworkId($companySocialNetworkId)
    {
        $this->companySocialNetworkId = $companySocialNetworkId;
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
    public function getSystemSocialNetworkIdFk()
    {
        return $this->systemSocialNetworkIdFk;
    }

    /**
     * @param mixed $systemSocialNetworkIdFk
     */
    public function setSystemSocialNetworkIdFk($systemSocialNetworkIdFk)
    {
        $this->systemSocialNetworkIdFk = $systemSocialNetworkIdFk;
    }

    /**
     * @return mixed
     */
    public function getCompanySocialNetworkLink()
    {
        return $this->companySocialNetworkLink;
    }

    /**
     * @param mixed $companySocialNetworkLink
     */
    public function setCompanySocialNetworkLink($companySocialNetworkLink)
    {
        $this->companySocialNetworkLink = $companySocialNetworkLink;
    }

    /**
     * @return mixed
     */
    public function getCompanySocialNetworkDateInsert()
    {
        return $this->companySocialNetworkDateInsert;
    }

    /**
     * @param mixed $companySocialNetworkDateInsert
     */
    public function setCompanySocialNetworkDateInsert($companySocialNetworkDateInsert)
    {
        $this->companySocialNetworkDateInsert = $companySocialNetworkDateInsert;
    }

    /**
     * @return mixed
     */
    public function getCompanySocialNetworkDateUpdate()
    {
        return $this->companySocialNetworkDateUpdate;
    }

    /**
     * @param mixed $companySocialNetworkDateUpdate
     */
    public function setCompanySocialNetworkDateUpdate($companySocialNetworkDateUpdate)
    {
        $this->companySocialNetworkDateUpdate = $companySocialNetworkDateUpdate;
    }
    

}