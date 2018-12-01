<?php

namespace App\Models\Traffic;

use App\Models\Ads\Ads;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\Request;

class ClickAds extends Model
{

    private $id;
    private $ads;
    private $url;
    private $os;
    private $ip;
    private $dataInsert;


    public function __construct()
    {
        $this->setTable("traffic_click_ads");
        $this->setPrimaryKey("traffic_click_ads_id");
        $this->setImgFolder("");

    }


    public function edit()
    {
    }


    public function register()
    {
        $sql = $this->sqlInsert();

        if (!Request::issetCookie("ads_click_{$this->ads()->getId()}")) {

            $sql->setRowData("ads_id", $this->ads()->getId());
            $sql->setRowData("traffic_click_ads_url", $this->getUrl());
            $sql->setRowData("traffic_click_ads_os", GetData::getOs());
            $sql->setRowData("traffic_click_ads_ip", $this->getIp());
            $sql->setRowData("traffic_click_ads_date_Insert", GetData::getCurrentTime());

            if ($sql->execute()) {
                Request::setCookie("ads_click_{$this->ads()->getId()}", "url", time() + 3600);
                return true;
            }
        }

        return false;
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
     * @return Ads
     */
    public function ads()
    {
        $this->ads = $this->ads ? $this->ads : new Ads();

        return $this->ads;
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
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
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