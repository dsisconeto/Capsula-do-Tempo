<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:15
 */

sysLoadClass("GeoRegionRelationshipParent");

class AdminFormGeoRegionParent extends DjReturnMsg
{

    public function register()
    {
        $this->setMsg("Relação já existe entre as duas regiões", false, 2);
        $this->setMsg("Relação cadastrada com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar relação ", false, 4);

        $geoRegion = new GeoRegionRelationshipParent();
        $geoRegion->setGeoRegionId(DjRequest::post("geo_region_id", "int"));
        $geoRegion->setGeoRegionIdParent(DjRequest::post("geo_region_id_parent", "int"));

        if ($geoRegion->issetRelation()) {

            $this->setReturn(2);

        }


        if ($this->noError()) {

            $geoRegion->sqlInsert() ? $this->setReturn(3) : $this->setReturn(4);
        }


        return $this->getReturn();
    }


    public function delete()
    {
        $this->setMsg("Relação deletada com sucesso", true, 5);
        $this->setMsg("Erro ao deletar relação ", false, 6);
        $geoRegion = new GeoRegionRelationshipParent();
        $geoRegion->setGeoRegionId(DjRequest::post("geo_region_id", "int"));
        $geoRegion->setGeoRegionIdParent(DjRequest::post("geo_region_id_parent", "int"));

        if ($this->noError()) {

            $geoRegion->sqlDelete() ? $this->setReturn(5) : $this->setReturn(6);
        }

        return $this->getReturn();

    }


}