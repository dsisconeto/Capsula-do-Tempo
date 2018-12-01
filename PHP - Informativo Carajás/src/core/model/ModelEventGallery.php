<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 19:29
 */
class ModelEventGallery extends dbConnection
{
    private $id;
    private $eventId;
    private $event;
    private $file;
    private $order;
    private $dataInsert;


    /**
     * @return Event
     */
    public function event()
    {
        if (!$this->event) {
            $this->event = new Event();
        }
        return $this->event;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed string
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

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
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getDataInsert()
    {
        return $this->dataInsert;
    }

    /**
     * @param mixed $dataInsert
     */
    public function setDataInsert($dataInsert)
    {
        $this->dataInsert = $dataInsert;
    }


}