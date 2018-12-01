<?php

sysLoadClass("AdsRelationshipRegion");
sysLoadClass("GeoRegionUserPermission");

class AdminFormAdsRegion extends DjReturnMsg
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if (!$login->validateLogIn() && !$login->getSystemUserPermissionAds()) {
            exit();
        }
    }


    public function register()
    {

        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Erro ao Criar relação do Anucion com a região", false, 2);
        $this->setMsg("Relação criada com sucesso", true, 3);

        $login = SystemLogin::getLogin();
        $success = 0;
        $adsRelation = new AdsRelationshipRegion();

        $regionUser = new GeoRegionUserPermission();

        if ($adsRelation->validateByUser(DjRequest::post("ads_id"))) {


            $geoRegionRelationParent = new GeoRegionRelationshipParent();
            $adsRelation->setAdsId(DjRequest::post("ads_id"));
            $geoRegion = $geoRegionRelationParent->validateRegion(DjRequest::post("geo_region"));

            if ($geoRegion) {

                $adsRelation->deleteByAds($adsRelation->getAdsId());

                foreach ($geoRegion as $keyRegion):

                    if ($regionUser->validatePermission($keyRegion["geo_region_id"], "ads")) {

                        $adsRelation->setGeoRegionId($keyRegion["geo_region_id"]);
                        $adsRelation->setSystemUserId($login->getSystemUserId());

                        if ($adsRelation->sqlInsert()) {

                            $success++;

                        }

                    }
                endforeach;

            }
            if ($success > 0):

                $this->setReturn(3);
            else:
                $this->setReturn(2);
            endif;
        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }


}