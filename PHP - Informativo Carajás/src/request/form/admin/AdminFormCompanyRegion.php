<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 19:09
 */

sysLoadClass("CompanyRelationshipGeoRegion");
sysLoadClass("GeoRegionUserPermission");

class AdminFormCompanyRegion extends DjReturnMsg
{


    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Relação criada com sucesso.", true, 2);
        $this->setMsg("Erro ao criar relação.", false, 3);
        $this->setMsg("A cidade já está relacionada com a empresa.", false, 6);

        $geoRegionId = DjRequest::post("geo_region_id");
        $companyId = DjRequest::post("company_id");


        $relationRegionUser = new GeoRegionUserPermission();
        $relationGeo = new CompanyRelationshipGeoRegion();

        if ($relationRegionUser->validatePermission($geoRegionId,"company")) {


            if ($relationGeo->issetRelationship($geoRegionId, $companyId)) {

                $this->setReturn(6);

            } else {

                $relationGeo->setGeoRegionIdFk($geoRegionId);
                $relationGeo->setCompanyIdFk($companyId);

                $relationGeo->sqlInsert() ? $this->setReturn(2) : $this->setReturn(3);
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

        $geoRegionId = DjRequest::post("geo_region_id");
        $companyId = DjRequest::post("company_id");

        $company = new Company();
        $relationGeo = new CompanyRelationshipGeoRegion();


        if ($company->validateByUser($companyId)) {

            $relationGeo->setGeoRegionIdFk($geoRegionId);
            $relationGeo->setCompanyIdFk($companyId);
            $relationGeo->sqlDelete() ? $this->setReturn(2) : $this->setReturn(3);

        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();
    }

}