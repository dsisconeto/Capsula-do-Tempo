<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Company\Company;
use App\Models\Company\RelationshipRegion;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;

class FormCompanyRegion extends Form
{

    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(7));

    }


    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Relação criada com sucesso.", true, 2);
        $this->setMsg("Erro ao criar relação.", false, 3);
        $this->setMsg("A cidade já está relacionada com a empresa.", false, 6);

        $geoRegionId = Request::post("geo_region_id");
        $companyId = Request::post("company_id");

        $company = new Company();
        $relationRegionUser = new RegionUserPermission();
        $relationGeo = new RelationshipRegion();

        if ($company->validateByUser($companyId) && $relationRegionUser->validatePermission($geoRegionId, "company")) {


            if ($relationGeo->issetRelationship($geoRegionId, $companyId)) {

                $this->setReturn(6);

            } else {

                $relationGeo->region()->setId($geoRegionId);
                $relationGeo->company()->setId($companyId);

                $relationGeo->register() ? $this->setReturn(2) : $this->setReturn(3);
            }

        } else {

            $this->setReturn(1);
        }


        return $this->getReturn();

    }

    public function delete()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Relação deletada com sucesso.", true, 2);
        $this->setMsg("Erro ao deletar relação.", false, 3);

        $geoRegionId = Request::post("geo_region_id");
        $companyId = Request::post("company_id");

        $company = new Company();
        $relationGeo = new RelationshipRegion();


        if ($company->validateByUser($companyId)) {

            $relationGeo->region()->setId($geoRegionId);
            $relationGeo->company()->setId($companyId);
            $relationGeo->register() ? $this->setReturn(2) : $this->setReturn(3);

        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();
    }

}