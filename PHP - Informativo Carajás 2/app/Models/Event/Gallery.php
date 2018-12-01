<?php

namespace App\Models\Event;

use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class Gallery extends Model
{

    private $id;
    private $event;
    private $file;
    private $order;
    private $dataInsert;


    public function __construct()
    {
        $this->setTable("event_gallery");
        $this->setImgFolder("event_gallery");
        $this->setPrimaryKey("event_gallery_id");
    }


    public function register()
    {
        $sql = $this->sqlInsert();


        $sql->setRowData("event_id", $this->event()->getId());
        $sql->setRowData("event_gallery_file", $this->getFile());
        $sql->setRowData("event_gallery_order", $this->getOrder());
        $sql->setRowData("event_gallery_date_insert", GetData::getCurrentTime());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('event_gallery_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_gallery_order", $this->getOrder());
        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function deleteAll()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('event_id', '=', "{$this->event()->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");


        return $sql->execute();
    }

    public function selectByEvent($eventId, $col = "*")
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri->add($this->filter("event_id", "=", $eventId));
        $cri->setProperty("order", "event_gallery_order ASC");
        $sql->setCriteria($cri);
        $sql->addColumn($col);

        return $sql->execute();
    }





    public function lastOrder($eventId)
    {

        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->add($this->filter("event_id", "=", $eventId));
        $cri->setProperty("order", "event_gallery_order DESC");
        $cri->setProperty("limit", 1);

        $sql->addColumn("event_gallery_order");
        $sql->setCriteria($cri);

        $res = $sql->execute();

        if (isset($res[0])) {

            return $res[0]["event_gallery_order"];

        } else {
            return 0;
        }

    }


    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('event_gallery_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();

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


    public function validateByUser($eventGalleryId)
    {
        $this->load($eventGalleryId);

        return $this->event()->validateByUser($this->event()->getId());
    }


    public function deleteByEvent($eventId)
    {
        if ($this->event()->validateByUser($eventId)) {


            $res = $this->selectByEvent($eventId);
            if ($res) {
                foreach ($res as $key) {
                    $this->imgDelete($key["event_gallery_file"]);
                }
            }

            $sql = $this->sqlDelete();
            $criteria = $this->criteria();

            $criteria->add($this->filter('event_id', '=', "{$this->event()->getId()}"));

            $sql->setCriteria($criteria);
            return $sql->execute();
        }


        return false;
    }


    /**
     * @return Event
     */
    public function event()
    {
        if (!$this->event) {
            $this->event = new Event();
        }
        return $this->event;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed string
     */
    public function setFile($file)
    {
        $this->file = $file;
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
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
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