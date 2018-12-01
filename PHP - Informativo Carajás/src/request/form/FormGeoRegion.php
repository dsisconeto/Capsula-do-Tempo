<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 18:55
 */

sysLoadClass("GeoRegion");

class FormGeoRegion extends DjReturnMsg
{

    public function sentCookie()
    {
        $this->setMsg("Não foi possivel escolher a cidade", false, 1);
        $this->setMsg("Cidade Salva com sucesso", true, 2);

        $geoRegion = new GeoRegion();

        $geoRegion->sqlLoad(DjRequest::post("geo_region_id", "int", 6000));

        if ($geoRegion->getId()) {

            if (DjRequest::issetCookie("geo_region_id")) {

                $time = time() - (60 * 60 * 24 * 365);

                setcookie("geo_region_id", 0, $time, "/");
            }

            $time = time() + (60 * 60 * 24 * 365);

            setcookie("geo_region_id", $geoRegion->getId(), $time, "/");


            $this->setReturn(2);

        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }


}