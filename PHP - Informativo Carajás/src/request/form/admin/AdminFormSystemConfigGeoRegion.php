<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:07
 */
sysLoadClass("SystemConfigGeoRegion");

class AdminFormSystemConfigGeoRegion extends DjReturnMsg
{


    public function manager()
    {
        $this->setMsg("Configuração  da região Editada com sucesso", true, 2);

        $this->setMsg("Erro ao Editada Configuração da região", false, 3);

        $systemConfig = new SystemConfigGeoRegion();

        $systemConfig->setGeoRegionIdFk(DjRequest::post("geo_region_id", "int", 0));


        if ($systemConfig->issetConfig($systemConfig->getGeoRegionIdFk())) {


            $systemConfig->setCompanyView(DjRequest::post("company_view", "int", 0));
            $systemConfig->setEventView(DjRequest::post("event_view", "int", 0));
            $systemConfig->setNewspaperView(DjRequest::post("newspaper_view", "int", 0));


            $systemConfig->sqlUpdate() ? $this->setReturn(2) : $this->setReturn(3);

        } else {

            $systemConfig->setCompanyView(DjRequest::post("company_view", "int", 0));
            $systemConfig->setEventView(DjRequest::post("event_view", "int", 0));
            $systemConfig->setNewspaperView(DjRequest::post("newspaper_view", "int", 0));


            $systemConfig->sqlInsert() ? $this->setReturn(2) : $this->setReturn(3);


        }

        return $this->getReturn();
    }


}