<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 19:47
 */
class ModelGeoState extends dbConnection
{
    private $id;
    private $name;
    private $abbr;
    private $dateInsert;
    private $dataUpdate;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * @param mixed $abbr
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
    }

    /**
     * @return mixed
     */
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * @param mixed $dateInsert
     */
    public function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;
    }

    /**
     * @return mixed
     */
    public function getDataUpdate()
    {
        return $this->dataUpdate;
    }

    /**
     * @param mixed $dataUpdate
     */
    public function setDataUpdate($dataUpdate)
    {
        $this->dataUpdate = $dataUpdate;
    }



}