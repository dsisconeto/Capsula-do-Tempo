<?php

namespace App\Models\Traffic;

use App\Models\System\SystemUrl;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Request;

class View extends Model
{
    private $id;
    private $source;
    private $userIp;
    private $os;
    private $url;
    private $dateInsert;


    public function __construct()
    {
        $this->setTable("traffic_view");
        $this->setPrimaryKey("traffic_view_id");

    }


    public function edit()
    {
    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        return $sql->execute();
    }

    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];
            $this->setId($res["traffic_view_id"]);
            $this->source()->setId($res["traffic_source_id_fk"]);
            $this->setUserip($res["traffic_user_ip"]);
            $this->setOs($res["traffic_os"]);
            $this->url()->setId($res["system_url_id_fk"]);
            $this->setDateInsert($res["traffic_view_date_insert"]);

        }

        return $res;
    }


    public function register($url, $source = 0)
    {
        $this->url()->setUrl($url);
        $this->source()->setId($source);
        if (Request::issetCookie($this->url()->getUrl())) {

            return true;
        } else {
            $sql = $this->sqlInsert();

            // verificando se url existe
            if (!$this->url()->issetUrl($this->url()->getId())):
                // setando o id da url
                return false;
            endif;

            // verificando se existe uma fonte
            if ($this->source()->getId() && $this->source()->load($this->source()->getId())):
            else:
                $this->source()->setId(1);
            endif;
            // capturando ip
            $this->setUserip(GetData::getIp());
            // capturando sistema operacional
            $this->setOs(GetData::getOs());
            $sql->setRowData("traffic_source_id_fk", $this->source()->getId());
            $sql->setRowData("traffic_user_ip", $this->getUserip());
            $sql->setRowData("traffic_os", $this->getOs());
            $sql->setRowData("system_url_id_fk", $this->url()->getId());
            $sql->setRowData("traffic_view_date_insert", GetData::getCurrentTime());

            // inserindo novo registro
            if ($sql->execute()):
                // criando cookie para não dublicar a visita
                Request::setCookie($this->url()->getUrl(), "url", time() + 120);
                return true;
            else:
                return false;
            endif;

        }
    }


    public function counterViewUrl($systemUrlId)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("system_url_id_fk", "=", $systemUrlId));
        $col[] = "system_url_id_fk";
        return count($this->select($cri, $col));
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
     * @return Source
     */
    public function source()
    {
        $this->source = $this->source ? $this->source : new Source();


        return $this->source;
    }


    /**
     * @return mixed
     */
    public function getUserip()
    {
        return $this->userIp;
    }

    /**
     * @param mixed $userIp
     */
    public function setUserip($userIp)
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
     * @return SystemUrl
     */
    public function url()
    {
        $this->url = $this->url ? $this->url : new SystemUrl();


        return $this->url;
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
}