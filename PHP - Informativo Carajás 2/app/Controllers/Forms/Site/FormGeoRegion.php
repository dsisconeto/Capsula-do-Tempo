<?php


namespace App\Controllers\Forms\Site;

use App\Models\Geo\Region;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;

class FormGeoRegion extends Form
{

    public function sentCookie()
    {
        $this->setMsg("Não foi possivel escolher a cidade", false, 1);
        $this->setMsg("Cidade Selecionada com sucesso :)", true, 2);

        $geoRegion = new Region();

        $geoRegion->load(Request::post("geo_region_id", "int", 6000));

        if ($geoRegion->getId()) {

            if (Request::issetCookie("geo_region_id")) {

                $time = time() - (60 * 60 * 24 * 365);

                Request::setCookie("geo_region_id", 0, $time);
                Request::setCookie("geo_region_name", null, $time);
            }

            $time = time() + (60 * 60 * 24 * 365);

            Request::setCookie("geo_region_id", $geoRegion->getId(), $time);
            Request::setCookie("geo_region_name", $geoRegion->getName(), $time);


            $this->setReturn(2);

        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }


}