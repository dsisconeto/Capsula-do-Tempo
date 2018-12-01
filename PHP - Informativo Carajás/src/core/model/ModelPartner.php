<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 19:51
 */
class ModelPartner extends dbConnection
{

    private $partnerId;
    private $partnerName;
    private $partnerCpfOrCnpj;
    private $systemUserId;
    private $systemUserIdRegister;
    private $partnerDateInsert;
    private $partnerDateUpdate;

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @param mixed $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = $partnerId;
    }

    /**
     * @return mixed
     */
    public function getPartnerName()
    {
        return $this->partnerName;
    }

    /**
     * @param mixed $partnerName
     */
    public function setPartnerName($partnerName)
    {
        $this->partnerName = $partnerName;
    }

    /**
     * @return mixed
     */
    public function getPartnerCpfOrCnpj()
    {
        return $this->partnerCpfOrCnpj;
    }

    /**
     * @param mixed $partnerCpfOrCnpj
     */
    public function setPartnerCpfOrCnpj($partnerCpfOrCnpj)
    {
        $this->partnerCpfOrCnpj = $partnerCpfOrCnpj;
    }

    /**
     * @return mixed
     */
    public function getSystemUserId()
    {
        return $this->systemUserId;
    }

    /**
     * @param mixed $systemUserId
     */
    public function setSystemUserId($systemUserId)
    {
        $this->systemUserId = $systemUserId;
    }

    /**
     * @return mixed
     */
    public function getSystemUserIdRegister()
    {
        return $this->systemUserIdRegister;
    }

    /**
     * @param mixed $systemUserIdRegister
     */
    public function setSystemUserIdRegister($systemUserIdRegister)
    {
        $this->systemUserIdRegister = $systemUserIdRegister;
    }

    /**
     * @return mixed
     */
    public function getPartnerDateInsert()
    {
        return $this->partnerDateInsert;
    }

    /**
     * @param mixed $partnerDateInsert
     */
    public function setPartnerDateInsert($partnerDateInsert)
    {
        $this->partnerDateInsert = $partnerDateInsert;
    }

    /**
     * @return mixed
     */
    public function getPartnerDateUpdate()
    {
        return $this->partnerDateUpdate;
    }

    /**
     * @param mixed $partnerDateUpdate
     */
    public function setPartnerDateUpdate($partnerDateUpdate)
    {
        $this->partnerDateUpdate = $partnerDateUpdate;
    }
    
    
    
    
}