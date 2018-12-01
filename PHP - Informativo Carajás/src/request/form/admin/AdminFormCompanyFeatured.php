<?php

sysLoadClass("CompanyRelationshipFeatured");
sysLoadClass("GeoRegionUserPermission");

class AdminFormCompanyFeatured extends DjReturnMsg
{


    public function register()
    {
        $this->setMsg("Não tem permissão.", false, 1);
        $this->setMsg("Não tem permissão para cadastrar nessa região.", false, 2);
        $this->setMsg("Cadastrado com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar", false, 4);
        $this->setMsg("Relação já existente", false, 5);

        $login = SystemLogin::getLogin();
        $relationUserRegion = new GeoRegionUserPermission();
        $companyFeatured = new CompanyRelationshipFeatured();


        $geoRegionId = DjRequest::post("geo_region_id", "int", 0);
        $companyId = DjRequest::post("company_id", "int", 0);
        $companyFeaturedId = DjRequest::post("company_featured_id", "int", 0);

        if ($login->validateLogIn() && $login->getSystemUserPermissionCompany()) {

            if (!$relationUserRegion->validatePermission($geoRegionId, "company")) {
                $this->setReturn(2);
            }

            if ($companyFeatured->issetRelation($geoRegionId, $companyId, $companyFeaturedId)) {
                $this->setReturn(5);
            }

            $companyFeatured->setGeoRegionIdFk($geoRegionId);
            $companyFeatured->setCompanyIdFk($companyId);
            $companyFeatured->setCompanyFeaturedIdFk($companyFeaturedId);
            $companyFeatured->setCompanyRelationshipFeaturedOrder($companyFeatured->lastOrder($geoRegionId, $companyFeaturedId));

            if ($this->noError()) {

                if ($companyFeatured->sqlInsert()) {

                    $this->setReturn(3);
                } else {

                    $this->setReturn(4);

                }

            }

        } else {
            $this->setReturn(1);

        }

        return $this->getReturn();
    }


    public function delete()
    {
        $id = DjRequest::post("company_relationship_featured_id");
        $this->setMsg("Não tem permissão.", false, 1);
        $this->setMsg("Deletado com sucesso", true, 6);
        $this->setMsg("Erro ao deletar", false, 7);

        $login = SystemLogin::getLogin();
        $companyFeatured = new CompanyRelationshipFeatured();

        if ($login->validateLogIn() && $login->getSystemUserPermissionCompany()) {


            $companyFeatured->setCompanyRelationshipFeaturedId($id);

            if ($companyFeatured->sqlDelete()) {

                $this->setReturn(6);

            } else {

                $this->setReturn(7);

            }


        } else {

            $this->setReturn(1);
        }


        return $this->getReturn();
    }


    public function serializeOrder()
    {
        $login = SystemLogin::getLogin();
        $companyFeatured = new CompanyRelationshipFeatured();
        $arrayPosition = DjRequest::post("relationship");
        $this->setMsg("Foi", true, 1);
        $res["success"] = 0;
        $res["error"] = 0;
        if ($login->validateLogIn() && $login->getSystemUserPermissionCompany()) {
            if ($arrayPosition) {
                $i = 0;
                foreach ($arrayPosition as $key) {
                    $companyFeatured->setCompanyRelationshipFeaturedId($key);
                    $companyFeatured->setCompanyRelationshipFeaturedOrder($i);
                    $companyFeatured->sqlSerialize() ? $res["success"]++ : $res["error"]++;
                    $i++;
                }
            }
        }
        $this->setReturn(1, $res);

        return $this->getReturn();
    }


}