<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 27/04/17
 * Time: 05:34
 */

namespace App\Controllers\Forms\Admin;


use App\Models\Geo\RegionRelationshipParent;
use App\Models\Geo\RegionUserPermission;
use App\Models\News\Panel;
use App\Models\Process\NewsHome;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;

class FormNewsPanel extends Form
{

    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(1));
    }


    public function manager()
    {
        $this->setMsg("Alguma notícia é invalida", false, 1);
        $this->setMsg("Erro ao alterar no banco dados", false, 2);
        $this->setMsg("Painel alterado com sucesso", true, 3);
        $this->setMsg("Usuário não tem permissão para alterar essa região", false, 4);
        $this->setMsg("Região não encontrada", false, 5);

        $panel = new Panel();
        $panel2 = new Panel();

        $regionUser = new RegionUserPermission();
        $regionParent = new RegionRelationshipParent();
        $regionId = Request::post("geo_region_id", "int", 0);
        $panel->region()->setId($regionId);

        $regionParent->region()->setId($regionId);
        $regionParent->region()->setLevel($regionParent->region()->regionLevel());


        $panel->load(); // carregada dados

        if (!$regionUser->issetPermission($panel->region()->getId())) {
            // verifica se o usuario tem permissão para alterar a mesma
            $this->setReturn(4);
        }


        if ($this->noError()) { // não tem erros

            for ($i = 1; $i <= $panel->getNumberLocal(); $i++) {
                $local = Request::post("local_{$i}", "int", 0);
                if (($panel->local($i)->getId() == $local) || ($panel->local($i)->load($local) || $local == 0)) {
                    $panel->local($i)->setId($local);
                }
            }


            if ($panel->issetPanel()) {
                $panel->edit() ? $this->setReturn(3) : $this->setReturn(2);
            } else {
                $panel->register() ? $this->setReturn(3) : $this->setReturn(2);
            }


            if ($regionParent->region()->getLevel() > 1) {

                $resultRegion = $regionParent->selectDownRegion(); // carrega as sub regiões

                if ($resultRegion) {

                    foreach ($resultRegion as $key) {
                        // vai alterar uma por uma
                        $panel2->region()->setId($key["geo_region_id"]);
                        $panel2->load(); // carrega sub região

                        for ($i = 1; $i <= $panel->getNumberLocal(); $i++) {
                            $local = Request::post("local_{$i}", "int", 0);
                            if (($panel2->local($i)->getId() == $local) || $panel2->local($i)->load($local)) {
                                $panel2->local($i)->setId($local);
                            }
                        }


                        if ($panel2->issetPanel()) {

                            $panel2->edit();
                        } else {

                            $panel2->register();

                        }

                    }

                }
            }


            (new NewsHome())->verify($regionId);

        }


        return $this->getReturn();
    }
}