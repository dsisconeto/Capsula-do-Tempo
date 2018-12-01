<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 05/04/16
 * Time: 23:03
 */
sysLoadClass("ModelSystemUrl");

class ActionSystemUrl extends ModelSystemUrl
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("system_url");
        $sql->setRowData("system_url_url", $this->getUrl());
        $sql->setRowData("system_entity_id", $this->getEntityId());

        $sql->setRowData("system_url_date_insert", $this->currentTime());
        $sql->setRowData("system_url_date_update", $this->currentTime());

        return $this->runQuery($sql);
    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('system_url');

        $criteria->add(New Filter('system_url_id', '=', "{$this->getId()}"));

        $sql->setRowData("system_url_url", $this->getUrl());

        $sql->setRowData("system_url_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();

        $sql->setEntity('system_url');

        $criteria->add(New Filter('system_url_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlSelect($criteria = null)
    {
        $sql = new SqlSelect();
        $sql->setEntity("system_url");
        $sql->addColumn("*");
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlSelectIssetUrl($systemUrl, $id = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("system_url");
        $sql->addColumn("system_url_id");
        $sql->addColumn("system_url_url");
        $sql->addColumn("system_entity_id");

        $criteria = new Criteria();
        $criteria->add(New Filter('system_url_url', '=', $systemUrl));
        if ($id) {
            $criteria->add(new Filter("system_url_id", "<>", $id));
        }
        $criteria->setProperty("limit", 1);

        $sql->setCriteria($criteria);
        $res = $this->runSelect($sql);

        if ($res):
            $res = $res[0];
            $this->setId($res["system_url_id"]);
            $this->setUrl($res["system_url_url"]);
            $this->setEntityId($res["system_entity_id"]);
        endif;

        return $res;
    }

    public function sqlLoad($systemUrlId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('system_url_id', '=', $systemUrlId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["system_url_id"]);
            $this->setUrl($res["system_url_url"]);
            $this->setEntityId($res["system_entity_id"]);
            $this->setSystemUrlDateInsert($res["system_date_insert"]);
            $this->setSystemUrlDateUpdate($res["system_date_update"]);

        endif;

        return $res;
    }

    public function sqlLoadByUrl($systemUrl)
    {


        $criteria = new Criteria();
        $criteria->add(New Filter('system_url_url', '=', $systemUrl));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["system_url_id"]);
            $this->setUrl($res["system_url_url"]);
            $this->setEntityId($res["system_entity_id"]);
            $this->setSystemUrlDateInsert($res["system_url_date_insert"]);
            $this->setSystemUrlDateUpdate($res["system_url_date_update"]);

        endif;

        return $res;


    }

}