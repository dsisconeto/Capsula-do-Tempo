<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 17/05/2016
 * Time: 20:55
 */
sysLoadClass("dbConnection");

class ModelNewsContentImg extends dbConnection
{
    private $newsContentImgId;
    private $systemUserIdFk;
    private $newsContentImgFile;
    private $newsContentImgDateInsert;

    /**
     * @return mixed
     */
    public function getNewsContentImgId()
    {
        return $this->newsContentImgId;
    }

    /**
     * @param mixed $newsContentImgId
     */
    public function setNewsContentImgId($newsContentImgId)
    {
        $this->newsContentImgId = $newsContentImgId;
    }

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
    public function getNewsContentImgFile()
    {
        return $this->newsContentImgFile;
    }

    /**
     * @param mixed $newsContentImgFile
     */
    public function setNewsContentImgFile($newsContentImgFile)
    {
        $this->newsContentImgFile = $newsContentImgFile;
    }

    /**
     * @return mixed
     */
    public function getNewsContentImgDateInsert()
    {
        return $this->newsContentImgDateInsert;
    }

    /**
     * @param mixed $newsContentImgDateInsert
     */
    public function setNewsContentImgDateInsert($newsContentImgDateInsert)
    {
        $this->newsContentImgDateInsert = $newsContentImgDateInsert;
    }


}