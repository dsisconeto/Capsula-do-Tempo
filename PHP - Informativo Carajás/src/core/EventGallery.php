<?php
sysLoadClass("ActionEventGallery");
sysLoadClass("Event");

class EventGallery extends ActionEventGallery
{

    public function __construct()
    {
        $this->setImgFolder("event_gallery");
        $this->setMsg("Não tem permissão", false, 1);
    }

    public function selectByEvent($eventId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("event_id", "=", $eventId));
        $cri->setProperty("order", "event_gallery_order ASC");
        return $this->sqlSelect($cri);
    }

    public function validateByUser($eventGalleryId)
    {
        $this->sqlLoad($eventGalleryId);
        $event = new Event();
        return $event->validateUserByEvent($this->event()->getId());
    }

    public function lastOrder($eventId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("event_id", "=", $eventId));
        $cri->setProperty("order", "event_gallery_order DESC");
        $cri->setProperty("limit", 1);

        $col[] = "event_gallery_order";

        $res = $this->sqlSelect($cri, $col);

        if (isset($res[0])) {

            return $res[0]["event_gallery_order"];

        } else {
            return 0;
        }

    }


    public function deleteByEvent($eventId)
    {
        $event = new Event();

        if ($event->validateUserByEvent($eventId)) {

            $cri = new Criteria();
            $cri->add(new Filter("event_id", "=", $eventId));
            $res = $this->sqlSelect($cri);

            if ($res) {

                foreach ($res as $key) {

                    $this->imgDelete($key["event_gallery_file"]);

                }
            }

        }
    }


}