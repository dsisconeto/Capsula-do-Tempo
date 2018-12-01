<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 09/06/2016
 * Time: 04:11
 */
sysLoadClass("ActionEventRelationshipGeoRegion");
sysLoadClass("Event");

class EventRelationshipGeoRegion extends ActionEventRelationshipGeoRegion
{


    public function __construct()
    {

        $this->setMsg("Não tem permisão", false, 1);
        $this->setMsg("Região Invalidade", false, 2);
        $this->setMsg("Erro ao cadastrar algumas regiões", false, 3);
        $this->setMsg("Região Cadastrada com sucesso", true, 4);
        $this->setMsg("Erro Cadastrar Região ", false, 5);

    }


    public function deleteByEvent($eventId)
    {
        $event = new Event();
        if ($event->validateUserByEvent($eventId)) {

            $this->setEventIdFk($eventId);

            return $this->sqlDeleteByEvent();

        } else {
            return false;
        }

    }


    public function issetRelation($eventId, $geoRegionId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("event_id_fk", "=", $eventId));
        $cri->add(new Filter("geo_region_id_fk", "=", $geoRegionId));


        return $this->sqlSelect($cri) ? true : false;
    }




    public function selectByEvent($eventId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("event_id_fk", "=", $eventId));
        $cri->setProperty("order", "geo_region_name ASC");

        $col[] = "geo_region_id";
        $col[] = "geo_region_name";

        return $this->sqlSelect($cri, $col);
    }


}