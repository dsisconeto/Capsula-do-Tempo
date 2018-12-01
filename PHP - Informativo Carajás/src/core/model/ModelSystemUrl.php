<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 20:15
 */
class ModelSystemUrl extends dbConnection
{
    private $id;
    private $url;
    private $EntityId;

    private $systemUrlDateInsert;
    private $systemUrlDateUpdate;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $this->standardizeUrl($url);
    }

    /**
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->EntityId;
    }

    /**
     * @param mixed $EntityId
     */
    public function setEntityId($EntityId)
    {
        $this->EntityId = $EntityId;
    }



    /**
     * @return mixed
     */
    public function getSystemUrlDateInsert()
    {
        return $this->systemUrlDateInsert;
    }

    /**
     * @param mixed $systemUrlDateInsert
     */
    public function setSystemUrlDateInsert($systemUrlDateInsert)
    {
        $this->systemUrlDateInsert = $systemUrlDateInsert;
    }

    /**
     * @return mixed
     */
    public function getSystemUrlDateUpdate()
    {
        return $this->systemUrlDateUpdate;
    }

    /**
     * @param mixed $systemUrlDateUpdate
     */
    public function setSystemUrlDateUpdate($systemUrlDateUpdate)
    {
        $this->systemUrlDateUpdate = $systemUrlDateUpdate;
    }

}