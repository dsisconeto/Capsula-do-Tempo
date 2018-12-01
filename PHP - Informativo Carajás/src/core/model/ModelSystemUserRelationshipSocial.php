<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 21:59
 */
class ModelSystemUserRelationshipSocial extends dbConnection
{
    private $systemUserId;
    private $systemSocialNetworkId;

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
    

}