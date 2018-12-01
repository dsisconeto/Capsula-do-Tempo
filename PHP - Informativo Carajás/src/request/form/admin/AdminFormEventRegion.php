<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 29/08/16
 * Time: 19:12
 */
sysLoadClass("EventRelationshipGeoRegion");
sysLoadClass("GeoRegionRelationshipParent");
sysLoadClass("Event");
sysLoadClass("GeoRegionUserPermission");

class AdminFormEventRegion extends DjReturnMsg
{


    public function register()
    {
        $relationRegion = new EventRelationshipGeoRegion();

        $geoRegion = new GeoRegionRelationshipParent();
        $regionUser = new GeoRegionUserPermission();


        $this->setMsg("Não tem permisão", false, 1);
        $this->setMsg("Região Invalidade", false, 2);
        $this->setMsg("Erro ao cadastrar algumas regiões", false, 3);
        $this->setMsg("Regiões cadastradas com sucesso", true, 4);
        $this->setMsg("Erro ao cadastrar regiões", false, 5);

        $return["success"] = 0;
        $return["error"] = 0;
        $geoRegionIdArray = $geoRegion->validateRegion(DjRequest::post("geo_region_id", "array"));
        $relationRegion->setEventIdFk(DjRequest::post("event_id", "int"));


        if ($geoRegionIdArray) {

            $relationRegion->deleteByEvent($relationRegion->getEventIdFk());

            try {

                foreach ($geoRegionIdArray as $key) {

                    $relationRegion->setGeoRegionIdFk($key["geo_region_id"]);

                    if (!$relationRegion->issetRelation($relationRegion->getEventIdFk(), $relationRegion->getGeoRegionIdFk()) && $regionUser->validatePermission($relationRegion->getGeoRegionIdFk(), "event")) {

                        $relationRegion->sqlInsert() ? $return["success"]++ : $return["error"]++;

                    } else {
                        $return["error"]++;
                    }
                }

                $return["success"] ? $this->setReturn(4, $return) : $this->setReturn(5, $return);

            } catch (Exception $e) {
                $this->setReturn(3);

            }

        } else {
            $this->setReturn(2);
        }


        return $this->getReturn();
    }


}