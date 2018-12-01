<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Ads\RelationshipRegion;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;

class FormAdsRegion extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(8));




    }


    public function register()
    {

        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Erro ao Criar relação do Anucion com a região", false, 2);
        $this->setMsg("Relação criada com sucesso", true, 3);

        $success = 0;
        $adsRelation = new RelationshipRegion();

        $regionUser = new RegionUserPermission();

        if ($adsRelation->validateByUser(Request::post("ads_id"))) {


            $geoRegionRelationParent = new RegionRelationshipParent();
            $adsRelation->setId(Request::post("ads_id"));
            $geoRegion = $geoRegionRelationParent->validateRegion(Request::post("geo_region"));

            if ($geoRegion) {

                $adsRelation->deleteByAds($adsRelation->getId());

                foreach ($geoRegion as $keyRegion):

                    if ($regionUser->validatePermission($keyRegion["geo_region_id"], "ads")) {

                        $adsRelation->region()->setId($keyRegion["geo_region_id"]);
                        $adsRelation->user()->setId(Login::user()->getId());

                        if ($adsRelation->register()) {

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