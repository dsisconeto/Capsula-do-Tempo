<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:06
 */
class ModelAdsLocal extends dbConnection
{

    private $id;
    private $name;
    private $printscreen;
    private $height;
    private $width;
    private $dateInsert;
    private $dateUpdate;

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
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    
    /**
     * @return mixed
     */
    public function getPrintscreen()
    {
        return $this->printscreen;
    }

    /**
     * @param mixed $printscreen
     */
    public function setPrintscreen($printscreen)
    {
        $this->printscreen = $printscreen;
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
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }

 
}