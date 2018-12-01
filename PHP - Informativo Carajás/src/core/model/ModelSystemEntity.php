<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 20:09
 */
class ModelSystemEntity extends dbConnection
{
    private $systemEntityId;
    private $systemEntityName;
    private $systemEntityDateInsert;
    
    /**
     * @return mixed
     */
    public function getSystemEntityId()
    {
        return $this->systemEntityId;
    }

    /**
     * @param mixed $systemEntityId
     */
    public function setSystemEntityId($systemEntityId)
    {
        $this->systemEntityId = $systemEntityId;
    }

    /**
     * @return mixed
     */
    public function getSystemEntityName()
    {
        return $this->systemEntityName;
    }

    /**
     * @param mixed $systemEntityName
     */
    public function setSystemEntityName($systemEntityName)
    {
        $this->systemEntityName = $systemEntityName;
    }

    /**
     * @return mixed
     */
    public function getSystemEntityDateInsert()
    {
        return $this->systemEntityDateInsert;
    }

    /**
     * @param mixed $systemEntityDateInsert
     */
    public function setSystemEntityDateInsert($systemEntityDateInsert)
    {
        $this->systemEntityDateInsert = $systemEntityDateInsert;
    }

}