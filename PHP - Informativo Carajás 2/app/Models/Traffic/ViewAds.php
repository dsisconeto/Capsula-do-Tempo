<?php

namespace App\Models\Traffic;

use App\Models\Ads\Ads;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;
class ViewAds extends Model
{
    private $id;
    private $ads;
    private $userIp;
    private $os;
    private $dataInsert;

    public function __construct()
    {
        $this->setTable("traffic_view_ads");
        $this->setPrimaryKey("");
        $this->setImgFolder("");

    }


    public function edit()
    {
    }


    public function register()
    {
        $sql = $this->sqlInsert();
        $this->setUserIp(GetData::getIp());
        $this->setOs(GetData::getOs());

        if (!isset($_COOKIE["ads_{$this->ads()->getId()}"])):

            $sql->setRowData("ads_id", $this->ads()->getId());
            $sql->setRowData("user_ip", $this->getUserIp());
            $sql->setRowData("os", $this->getOs());
            $sql->setRowData("traffic_view_ads_date_insert", GetData::getCurrentTime());
            if ($sql->execute()):
                setcookie("ads_{$this->ads()->getId()}", "url", time() + 10);
                return true;
            endif;
        endif;

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
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * @param mixed $userIp
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;
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