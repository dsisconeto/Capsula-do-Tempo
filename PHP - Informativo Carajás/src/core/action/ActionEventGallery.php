<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 17:13
 */
sysLoadClass("ModelEventGallery");

class ActionEventGallery extends ModelEventGallery
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("event_gallery");

        $sql->setRowData("event_id", $this->event()->getId());
        $sql->setRowData("event_gallery_file", $this->getFile());
        $sql->setRowData("event_gallery_order", $this->getOrder());
        $sql->setRowData("event_gallery_date_insert", $this->currentTime());


        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('event_gallery');

        $criteria->add(New Filter('event_gallery_id', '=', "{$this->getId()}"));

        $sql->setRowData("event_gallery_order", $this->getOrder());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("event_gallery");

        $cri = new Criteria();
        $cri->add(New Filter("event_gallery_id", "=", $this->getId()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }


    public function sqlSelect($criteria = false, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("event_gallery");
        $sql->addColumn($col);
        if ($criteria) {
            $sql->setCriteria($criteria);
        }
        return $this->runSelect($sql);
    }

    public function sqlLoad($eventGalleryId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('event_gallery_id', '=', $eventGalleryId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setId($res["event_gallery_id"]);
            $this->event()->setId($res["event_id"]);
            $this->setFile($res["event_gallery_file"]);
            $this->setOrder($res["event_gallery_order"]);
            $this->setDataInsert($res["event_gallery_date_insert"]);
        endif;

        return $res;
    }


}