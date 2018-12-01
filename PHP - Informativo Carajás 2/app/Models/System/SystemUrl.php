<?php

namespace App\Models\System;

use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;


class SystemUrl extends Model
{


    private $url;
    private $entity;
    private $dateInsert;
    private $dateUpdate;

    public function __construct()
    {
        $this->entity = new Entity();
        $this->setTable("system_url");
        $this->setPrimaryKey("system_url_id");
    }


    public function register()
    {
        $sql = $this->sqlInsert();
        $count = 0;
        // verifica se a url já existe
        do {
            if ($count > 0) {
                $this->setUrl($this->getUrl() . $count);
            } else {
                $this->setUrl($this->getUrl());
            }
            $count++;
            // só para quando a url não existir
        } while ($this->issetUrl($this->getUrl()));


        $sql->setRowData("system_url_url", $this->getUrl());
        $sql->setRowData("system_entity_id", $this->entity()->getId());
        $sql->setRowData("system_url_date_insert", GetData::getCurrentTime());
        $sql->setRowData("system_url_date_update", GetData::getCurrentTime());

        if ($sql->execute()) {

            $this->setId($this->lastId());

            return true;
        } else {
            return false;
        }
    }

    public function edit()
    {
        $url = New SystemUrl();

        $sql = $this->sqlUpdate();
        // cria o creterio de where
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));
        $count = 0;
        do {
            if ($count > 0) {
                $this->setUrl($this->getUrl() . $count);
            } else {
                $this->setUrl($this->getUrl());
            }
            $count++;

        } while (($url->loadUrl($this->getUrl())) && ($url->getId() != $this->getId()));

        $sql->setRowData("system_url_url", $this->getUrl());
        $sql->setRowData("system_url_date_update", GetData::getCurrentTime());
        $sql->setCriteria($criteria);

        return $sql->execute();
    }


    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];
            // carregar dados
            $this->setId($res["system_url_id"]);
            $this->setUrl($res["system_url_url"]);
            $this->entity()->setId($res["system_entity_id"]);
            $this->setDateInsert($res["system_date_insert"]);
            $this->setDateUpdate($res["system_date_update"]);
        }

        return $res;
    }

    public function loadUrl($url)
    {
        $criteria = $this->criteria();
        $criteria->add($this->filter("system_url_url", "=", $url));
        $res = $this->selectBasic($criteria);

        if ($res) {
            $res = $res[0];
            // carregar dados
            $this->setId($res["system_url_id"]);
            $this->setUrl($res["system_url_url"]);
            $this->entity()->setId($res["system_entity_id"]);
            $this->setDateInsert($res["system_url_date_insert"]);
            $this->setDateUpdate($res["system_url_date_update"]);
        }


        return 1;
    }


    public function getUrlEntity($entityId, $pageId)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("system_entity_id", "=", $entityId));
        $cri->add($this->filter("system_page_id", "=", $pageId));
        $res = $this->selectBasic($cri);
        if ($res):
            return $res[0]["system_url_url"];
        else:
            return false;
        endif;
    }


    public function issetUrl($url)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("system_url_url", "=", $url));
        $this->selectBasic($cri);
    }


    public function siteMapCreate()
    {
        $siteMap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $siteMap .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        $cri = $this->criteria();
        $cri->setProperty("order", "system_url_priority DESC");
        $resUrl = $this->select($cri);
        $date = date("Y-m-d");
        $host = GetData::getHostMain();
        foreach ($resUrl as $key):
            $siteMap .= "\t<url>\n";
            $siteMap .= "\t\t<loc>{$host}{$key["system_url_url"]}</loc>\n";
            $siteMap .= "\t\t<lastmod>$date</lastmod>\n";
            $siteMap .= "\t\t<changefreq>{$key["system_url_changefreq"]}</changefreq>\n";
            $priority = floatval($key["system_url_priority"]);
            $siteMap .= "\t\t<priority>{$priority}</priority>\n";
            $siteMap .= "\t</url>\n";
        endforeach;

        $siteMap .= "</urlset>\n";


        $handler = fopen("sitemap.xml", 'w');
        fwrite($handler, $siteMap);
        fclose($handler);


        return $siteMap;
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
        $this->url = DataFormat::standardizeUrl($url);
    }

    /**
     * @return Entity
     */
    public function entity()
    {
        return $this->entity;
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

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }

}