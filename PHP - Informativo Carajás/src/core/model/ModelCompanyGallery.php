<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:31
 */
class ModelCompanyGallery extends dbConnection
{

    private $companyGalleryId;
    private $companyGalleryFile;
    private $companyIdFk;
    private $companyGalleryDateInsert;
    private $companyGalleryOrder;

    /**
     * @return mixed
     */
    public function getCompanyGalleryId()
    {
        return $this->companyGalleryId;
    }

    /**
     * @param mixed $companyGalleryId
     */
    public function setCompanyGalleryId($companyGalleryId)
    {
        $this->companyGalleryId = $companyGalleryId;
    }

    /**
     * @return mixed
     */
    public function getCompanyGalleryFile()
    {
        return $this->companyGalleryFile;
    }

    /**
     * @param mixed $companyGalleryFile
     */
    public function setCompanyGalleryFile($companyGalleryFile)
    {
        $this->companyGalleryFile = $companyGalleryFile;
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
    public function getCompanyGalleryDateInsert()
    {
        return $this->companyGalleryDateInsert;
    }

    /**
     * @param mixed $companyGalleryDateInsert
     */
    public function setCompanyGalleryDateInsert($companyGalleryDateInsert)
    {
        $this->companyGalleryDateInsert = $companyGalleryDateInsert;
    }

    /**
     * @return mixed
     */
    public function getCompanyGalleryOrder()
    {
        return $this->companyGalleryOrder;
    }

    /**
     * @param mixed $companyGalleryOrder
     */
    public function setCompanyGalleryOrder($companyGalleryOrder)
    {
        $this->companyGalleryOrder = $companyGalleryOrder;
    }


}