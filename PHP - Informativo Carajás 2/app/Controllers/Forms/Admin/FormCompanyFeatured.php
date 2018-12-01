<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Company\RelationshipFeatured;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;

class FormCompanyFeatured extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::input("jwt", "str"), 7);

    }

    public function register()
    {
        $this->setMsg("Não tem permissão para cadastrar nessa região.", false, 2);
        $this->setMsg("Cadastrado com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar", false, 4);
        $this->setMsg("Relação já existente", false, 5);


        $relationUserRegion = new RegionUserPermission();
        $featured = new RelationshipFeatured();


        $geoRegionId = Request::post("geo_region_id", "int", 0);
        $companyId = Request::post("company_id", "int", 0);
        $companyFeaturedId = Request::post("company_featured_id", "int", 0);


        if (!$relationUserRegion->validatePermission($geoRegionId, "company")) {
            $this->setReturn(2);
        }

        if ($featured->issetRelation($geoRegionId, $companyId, $companyFeaturedId)) {
            $this->setReturn(5);
        }

        $featured->region()->setId($geoRegionId);
        $featured->company()->setId($companyId);
        $featured->featured()->setId($companyFeaturedId);
        $featured->setOrder($featured->lastOrder($geoRegionId, $companyFeaturedId));

        if ($this->noError()) {

            if ($featured->register()) {

                $this->setReturn(3);
            } else {

                $this->setReturn(4);

            }

        }


        return $this->getReturn();
    }


    public function delete()
    {
        $id = Request::post("company_relationship_featured_id");
        $this->setMsg("Não tem permissão.", false, 1);
        $this->setMsg("Deletado com sucesso", true, 6);
        $this->setMsg("Erro ao deletar", false, 7);


        $companyFeatured = new RelationshipFeatured();


        $companyFeatured->setId($id);

        if ($companyFeatured->delete()) {

            $this->setReturn(6);

        } else {

            $this->setReturn(7);

        }


        return $this->getReturn();
    }


    public function serializeOrder()
    {

        $companyFeatured = new RelationshipFeatured();
        $arrayPosition = Request::post("relationship");
        $this->setMsg("Foi", true, 1);
        $res["success"] = 0;
        $res["error"] = 0;
        if ($arrayPosition) {
            $i = 0;
            foreach ($arrayPosition as $key) {
                $companyFeatured->setId($key);
                $companyFeatured->setOrder($i);
                $companyFeatured->editSerialize() ? $res["success"]++ : $res["error"]++;
                $i++;
            }
        }


        return $this->getReturn();
    }


}