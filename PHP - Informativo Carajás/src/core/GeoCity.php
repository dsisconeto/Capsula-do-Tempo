<?php

sysLoadClass("ActionGeoCity");
sysLoadClass("SystemLogin");

class GeoCity extends ActionGeoCity
{

    public function __construct()
    {
        $this->setMsg("Não tem permissão para cadastrar ou editar cidades", false, 1);
        $this->setMsg("O nome da cidade dever conter entre 2 e 150 digisto", false, 2);
        $this->setMsg("Cadastrada com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar", false, 4);
        $this->setMsg("Editada com Sucesso", true, 5);
        $this->setMsg("Erro ao Editar", false, 6);
    }



    public function searchNameBy($geoCityName)
    {

        $cri = new Criteria();
        $cri->setProperty("order", "geo_city_name ASC");
        $cri->add(New Filter("geo_city_name", "like", "%{$geoCityName}%"));
        return $this->sqlSelect($cri);

    }


    public function selectOrderByName($order = "ASC")
    {
        $cri = new Criteria();
        if ($order == "DESC"):
            $order = "DESC";
        else:
            $order = "ASC";
        endif;
        $cri->setProperty("order", "geo_city_name " . $order);
        
       return $this->sqlLoad($cri);
    }

}

