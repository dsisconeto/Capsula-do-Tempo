<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 20:12
 */
class ModelSystemSocialNetwork extends dbConnection
{

    private $systemSocialNetworkId;
    private $systemSocialNetworkName;
    private $systemSocialNetworkColor;
    private $systemSocialNetworkIcon;
    private $systemSocialNetworkDateInsert;
    private $systemSocialNetworkDateUpdate;

    /**
     * @return mixed
     */
    public function getSystemSocialNetworkColor()
    {
        return $this->systemSocialNetworkColor;
    }

    /**
     * @param mixed $systemSocialNetworkColor
     */
    public function setSystemSocialNetworkColor($systemSocialNetworkColor)
    {
        $this->systemSocialNetworkColor = $systemSocialNetworkColor;
    }

    
    
    /**
     * @return mixed
     */
    public function getSystemSocialNetworkId()
    {
        return $this->systemSocialNetworkId;
    }

    /**
     * @param mixed $systemSocialNetworkId
     */
    public function setSystemSocialNetworkId($systemSocialNetworkId)
    {
        $this->systemSocialNetworkId = $systemSocialNetworkId;
    }

    /**
     * @return mixed
     */
    public function getSystemSocialNetworkName()
    {
        return $this->systemSocialNetworkName;
    }

    /**
     * @param mixed $systemSocialNetworkName
     */
    public function setSystemSocialNetworkName($systemSocialNetworkName)
    {
        $this->systemSocialNetworkName = $systemSocialNetworkName;
    }

    /**
     * @return mixed
     */
    public function getSystemSocialNetworkIcon()
    {
        return $this->systemSocialNetworkIcon;
    }

    /**
     * @param mixed $systemSocialNetworkIcon
     */
    public function setSystemSocialNetworkIcon($systemSocialNetworkIcon)
    {
        $this->systemSocialNetworkIcon = $systemSocialNetworkIcon;
    }

    /**
     * @return mixed
     */
    public function getSystemSocialNetworkDateInsert()
    {
        return $this->systemSocialNetworkDateInsert;
    }

    /**
     * @param mixed $systemSocialNetworkDateInsert
     */
    public function setSystemSocialNetworkDateInsert($systemSocialNetworkDateInsert)
    {
        $this->systemSocialNetworkDateInsert = $systemSocialNetworkDateInsert;
    }

    /**
     * @return mixed
     */
    public function getSystemSocialNetworkDateUpdate()
    {
        return $this->systemSocialNetworkDateUpdate;
    }

    /**
     * @param mixed $systemSocialNetworkDateUpdate
     */
    public function setSystemSocialNetworkDateUpdate($systemSocialNetworkDateUpdate)
    {
        $this->systemSocialNetworkDateUpdate = $systemSocialNetworkDateUpdate;
    }
    
    
    
    
}