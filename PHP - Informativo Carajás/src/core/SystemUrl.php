<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 13/04/16
 * Time: 11:53
 */

sysLoadClass("ActionSystemUrl");

class SystemUrl extends ActionSystemUrl
{


    public function register($systemUrl, $entityId)
    {
        $systemUrl = $this->standardizeUrl($systemUrl);
        $login = SystemLogin::getLogin();

        $this->setEntityId($entityId);

        if ($login->validateLogIn()):

            $count = 0;

            do {
                if ($count > 0):
                    $this->setUrl($systemUrl . "-" . $count);
                else:

                    $this->setUrl($systemUrl);
                endif;
                $count++;
            } while ($this->issetUrl($this->getUrl()));


            if ($this->sqlInsert()):
                return $this->lastId();
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }


    public function delete($urlId)
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn()) {

            $this->setId($urlId);
            return $this->sqlDelete();

        }
    }

    public function edit($systemUrlId, $systemUrlUrl)
    {
        $this->setId($systemUrlId);
        $systemUrl = $this->standardizeUrl($systemUrlUrl);
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn()):
            $count = 0;
            do {
                if ($count > 0):
                    $this->setUrl($systemUrl . "-" . $count);
                else:
                    $this->setUrl($systemUrl);
                endif;
                $count++;
            } while ($this->issetUrl($this->getUrl(), $this->getId()));


            return $this->sqlUpdate();
        else:
            return false;
        endif;


    }


    public function getUrlEntity($entityId, $pageId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("system_entity_id", "=", $entityId));
        $cri->add(new Filter("system_page_id", "=", $pageId));
        $res = $this->sqlSelect($cri);
        if ($res):
            return $res[0]["system_url_url"];
        else:
            return false;
        endif;


    }


    public function issetUrl($url, $id = false)
    {
        return $this->sqlSelectIssetUrl($url, $id);
    }


    public function lastId()
    {

        $cri = new Criteria();
        $cri->setProperty("order", "system_url_id DESC");
        $cri->setProperty("limit", "1");
        $res = $this->sqlSelect($cri);

        return $res[0]["system_url_id"];
    }


    public function siteMapCreate()
    {
        $siteMap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $siteMap .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        $cri = new Criteria();
        $cri->setProperty("order", "system_url_priority DESC");
        $resUrl = $this->sqlSelect($cri);
        $date = date("Y-m-d");

        foreach ($resUrl as $key):
            $siteMap .= "\t<url>\n";
            $siteMap .= "\t\t<loc>{$this->getHost()}{$key["system_url_url"]}</loc>\n";
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

}