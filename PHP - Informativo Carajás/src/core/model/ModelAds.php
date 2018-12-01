<?php
sysLoadClass("AdsLocal");

class ModelAds extends dbConnection
{
    private $adsId;
    private $adsFile;
    private $adsLink;
    private $adsStartDisplay;
    private $adsEndDisplay;
    private $local;
    private $adsCompanyId;
    private $systemUserId;
    private $adsDateInsert;
    private $adsDateUpdate;
    private $adsStatus;
    private $adsTurnover;


    /**
     * @return mixed
     */
    public function getAdsTurnover()
    {
        return $this->adsTurnover;
    }

    /**
     * @param mixed $adsTurnover
     */
    public function setAdsTurnover($adsTurnover)
    {
        $this->adsTurnover = $adsTurnover;
    }

    /**
     * @return mixed
     */
    public function getAdsStatus()
    {
        return $this->adsStatus;
    }

    /**
     * @param mixed $adsStatus
     */
    public function setAdsStatus($adsStatus)
    {
        $this->adsStatus = $adsStatus;
    }


    /**
     * @return mixed
     */
    public function getAdsId()
    {
        return $this->adsId;
    }

    /**
     * @param mixed $adsId
     */
    public function setAdsId($adsId)
    {
        $this->adsId = $adsId;
    }

    /**
     * @return mixed
     */
    public function getAdsFile()
    {
        return $this->adsFile;
    }

    /**
     * @param mixed $adsFile
     */
    public function setAdsFile($adsFile)
    {
        $this->adsFile = $adsFile;
    }

    /**
     * @return mixed
     */
    public function getAdsLink()
    {
        return $this->adsLink;
    }

    /**
     * @param mixed $adsLink
     */
    public function setAdsLink($adsLink)
    {
        $this->adsLink = $adsLink;
    }

    /**
     * @return mixed
     */
    public function getAdsStartDisplay()
    {
        return $this->adsStartDisplay;
    }

    /**
     * @param mixed $adsStartDisplay
     */
    public function setAdsStartDisplay($adsStartDisplay)
    {
        $this->adsStartDisplay = $adsStartDisplay;
    }

    /**
     * @return mixed
     */
    public function getAdsEndDisplay()
    {
        return $this->adsEndDisplay;
    }

    /**
     * @param mixed $adsEndDisplay
     */
    public function setAdsEndDisplay($adsEndDisplay)
    {
        $this->adsEndDisplay = $adsEndDisplay;
    }

    /**
     * @return AdsLocal
     */
    public function local()
    {
        if (!$this->local) {
            $this->local = new AdsLocal();
        }
        return $this->local;
    }

    /**
     * @return mixed
     */
    public function getAdsCompanyId()
    {
        return $this->adsCompanyId;
    }

    /**
     * @param mixed $adsCompanyId
     */
    public function setAdsCompanyId($adsCompanyId)
    {
        $this->adsCompanyId = $adsCompanyId;
    }

    /**
     * @return mixed
     */
    public function getSystemUserId()
    {
        return $this->systemUserId;
    }

    /**
     * @param mixed $systemUserId
     */
    public function setSystemUserId($systemUserId)
    {
        $this->systemUserId = $systemUserId;
    }

    /**
     * @return mixed
     */
    public function getAdsDateInsert()
    {
        return $this->adsDateInsert;
    }

    /**
     * @param mixed $adsDateInsert
     */
    public function setAdsDateInsert($adsDateInsert)
    {
        $this->adsDateInsert = $adsDateInsert;
    }

    /**
     * @return mixed
     */
    public function getAdsDateUpdate()
    {
        return $this->adsDateUpdate;
    }

    /**
     * @param mixed $adsDateUpdate
     */
    public function setAdsDateUpdate($adsDateUpdate)
    {
        $this->adsDateUpdate = $adsDateUpdate;
    }


}