<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 14/09/16
 * Time: 15:20
 */
class ModelNewsPaper extends dbConnection
{
    private $newspaperId;
    private $newspaperDescription;
    private $newspaperPublicationDate;
    private $newspaperNumberOfPages;
    private $newspaperDrawing;
    private $newspaperEdition;
    private $geoRegionIdFk;
    private $newspaperDateInsert;
    private $newspaperDateUpdate;
    private $newsPaperStatus;
    private $systemUserIdFk;

    /**
     * @return mixed
     */
    public function getSystemUserIdFk()
    {
        return $this->systemUserIdFk;
    }

    /**
     * @param mixed $systemUserIdFk
     */
    public function setSystemUserIdFk($systemUserIdFk)
    {
        $this->systemUserIdFk = $systemUserIdFk;
    }


    /**
     * @return mixed
     */
    public function getNewsPaperStatus()
    {
        return $this->newsPaperStatus;
    }

    /**
     * @param mixed $newsPaperStatus
     */
    public function setNewsPaperStatus($newsPaperStatus)
    {
        $this->newsPaperStatus = DjDataFilter::filter($newsPaperStatus, array("type" => "int"));
    }


    /**
     * @return mixed
     */
    public function getNewspaperId()
    {
        return $this->newspaperId;
    }

    /**
     * @param mixed $newspaperId
     */
    public function setNewspaperId($newspaperId)
    {
        $this->newspaperId = DjDataFilter::filter($newspaperId, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperDescription()
    {
        return $this->newspaperDescription;
    }

    /**
     * @param mixed $newspaperDescription
     */
    public function setNewspaperDescription($newspaperDescription)
    {
        $this->newspaperDescription = DjDataFilter::filter($newspaperDescription, array("type" => "str", "tags" => true));
    }

    /**
     * @return mixed
     */
    public function getNewspaperPublicationDate()
    {
        return $this->newspaperPublicationDate;
    }

    /**
     * @param mixed $newspaperPublicationDate
     */
    public function setNewspaperPublicationDate($newspaperPublicationDate)
    {
        $this->newspaperPublicationDate = DjDataFilter::filter($newspaperPublicationDate, array("type" => "date"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperNumberOfPages()
    {
        return $this->newspaperNumberOfPages;
    }

    /**
     * @param mixed $newspaperNumberOfPages
     */
    public function setNewspaperNumberOfPages($newspaperNumberOfPages)
    {
        $this->newspaperNumberOfPages = DjDataFilter::filter($newspaperNumberOfPages, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperDrawing()
    {

        return $this->newspaperDrawing;
    }

    /**
     * @param mixed $newspaperDrawing
     */
    public function setNewspaperDrawing($newspaperDrawing)
    {
        $this->newspaperDrawing = DjDataFilter::filter($newspaperDrawing, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperEdition()
    {
        return $this->newspaperEdition;
    }

    /**
     * @param mixed $newspaperEdition
     */
    public function setNewspaperEdition($newspaperEdition)
    {
        $this->newspaperEdition = DjDataFilter::filter($newspaperEdition, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getGeoRegionIdFk()
    {
        return $this->geoRegionIdFk;
    }

    /**
     * @param mixed $geoRegionIdFk
     */
    public function setGeoRegionIdFk($geoRegionIdFk)
    {
        $this->geoRegionIdFk = DjDataFilter::filter($geoRegionIdFk, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperDateInsert()
    {
        return $this->newspaperDateInsert;
    }

    /**
     * @param mixed $newspaperDateInsert
     */
    public function setNewspaperDateInsert($newspaperDateInsert)
    {
        $this->newspaperDateInsert = DjDataFilter::filter($newspaperDateInsert, array("type" => "date"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperDateUpdate()
    {
        return $this->newspaperDateUpdate;
    }

    /**
     * @param mixed $newspaperDateUpdate
     */
    public function setNewspaperDateUpdate($newspaperDateUpdate)
    {
        $this->newspaperDateUpdate = DjDataFilter::filter($newspaperDateUpdate, array("type" => "date"));
    }


}