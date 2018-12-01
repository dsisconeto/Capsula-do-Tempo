<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 05/10/16
 * Time: 21:34
 */
class ModelGeoRegionUserPermission extends dbConnection
{
    private $systemUserIdFk;
    private $geoRegionIdFk;
    private $news;
    private $newspaper;
    private $event;
    private $company;
    private $ads;

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
    public function getGeoRegionIdFk()
    {
        return $this->geoRegionIdFk;
    }

    /**
     * @param mixed $geoRegionIdFk
     */
    public function setGeoRegionIdFk($geoRegionIdFk)
    {
        $this->geoRegionIdFk = $geoRegionIdFk;
    }

    /**
     * @return mixed
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @param mixed $news
     */
    public function setNews($news)
    {
        $this->news = $news;
    }

    /**
     * @return mixed
     */
    public function getNewspaper()
    {
        return $this->newspaper;
    }

    /**
     * @param mixed $newspaper
     */
    public function setNewspaper($newspaper)
    {
        $this->newspaper = $newspaper;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param mixed $ads
     */
    public function setAds($ads)
    {
        $this->ads = $ads;
    }


}