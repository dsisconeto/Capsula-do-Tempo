<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 15/09/16
 * Time: 15:03
 */
class ModelNewspaperPage extends dbConnection
{


    private $newspaperPageId;
    private $newspaperIdFk;
    private $newspaperNumber;
    private $newspaperFile;
    private $newspaperPageDateInsert;
    private $newspaperPageDateUpdate;

    /**
     * @return mixed
     */
    public function getNewspaperPageDateUpdate()
    {
        return $this->newspaperPageDateUpdate;
    }

    /**
     * @param mixed $newspaperPageDateUpdate
     */
    public function setNewspaperPageDateUpdate($newspaperPageDateUpdate)
    {
        $this->newspaperPageDateUpdate = DjDataFilter::filter($newspaperPageDateUpdate, array("type" => "date"));
    }


    /**
     * @return mixed
     */
    public function getNewspaperPageId()
    {
        return $this->newspaperPageId;
    }

    /**
     * @param mixed $newspaperPageId
     */
    public function setNewspaperPageId($newspaperPageId)
    {
        $this->newspaperPageId = DjDataFilter::filter($newspaperPageId, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperIdFk()
    {
        return $this->newspaperIdFk;
    }

    /**
     * @param mixed $newspaperIdFk
     */
    public function setNewspaperIdFk($newspaperIdFk)
    {
        $this->newspaperIdFk = DjDataFilter::filter($newspaperIdFk, array("type" => "int"));;
    }

    /**
     * @return mixed
     */
    public function getNewspaperNumber()
    {
        return $this->newspaperNumber;
    }

    /**
     * @param mixed $newspaperNumber
     */
    public function setNewspaperNumber($newspaperNumber)
    {
        $this->newspaperNumber = DjDataFilter::filter($newspaperNumber, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getNewspaperFile()
    {
        return $this->newspaperFile;
    }

    /**
     * @param mixed $newspaperFile
     */
    public function setNewspaperFile($newspaperFile)
    {
        $this->newspaperFile = DjDataFilter::filter($newspaperFile, array("type" => "str"));

    }

    /**
     * @return mixed
     */
    public function getNewspaperPageDateInsert()
    {
        return $this->newspaperPageDateInsert;
    }

    /**
     * @param mixed $newspaperPageDateInsert
     */
    public function setNewspaperPageDateInsert($newspaperPageDateInsert)
    {
        $this->newspaperPageDateInsert = DjDataFilter::filter($newspaperPageDateInsert, array("type" => "str"));;
    }


}