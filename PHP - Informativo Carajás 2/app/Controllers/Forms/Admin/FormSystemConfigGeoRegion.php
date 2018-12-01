<?php

namespace App\Controllers\Forms\Admin;

use App\Models\System\ConfigGeoRegion;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use App\Models\User\Login;

class FormSystemConfigGeoRegion extends Form
{

    public function getData($index = 0)
    {
        Login::validateForm(Request::cookie("jwt"), array(11));
    }


    public function manager()
    {
        $this->setMsg("Configuração  da região Editada com sucesso", true, 2);

        $this->setMsg("Erro ao Editada Configuração da região", false, 3);

        $systemConfig = new ConfigGeoRegion();

        $systemConfig->setId(Request::post("geo_region_id", "int", 0));


        if ($systemConfig->load($systemConfig->getId())) {


            $systemConfig->setCompanyView(Request::post("company_view", "int", 0));
            $systemConfig->setEventView(Request::post("event_view", "int", 0));
            $systemConfig->setNewspaperView(Request::post("newspaper_view", "int", 0));


            $systemConfig->edit() ? $this->setReturn(2) : $this->setReturn(3);

        } else {

            $systemConfig->setCompanyView(Request::post("company_view", "int", 0));
            $systemConfig->setEventView(Request::post("event_view", "int", 0));
            $systemConfig->setNewspaperView(Request::post("newspaper_view", "int", 0));


            $systemConfig->register() ? $this->setReturn(2) : $this->setReturn(3);


        }

        return $this->getReturn();
    }


}