<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 05/05/16
 * Time: 14:41
 */
sysLoadClass("ActionPartnerRelationshipGeoCity");

class PartnerRelationshipGeoCity extends ActionPartnerRelationshipGeoCity
{


    public function issetRelationship($geoCityId)
    {
        $login = SystemLogin::getLogin();
        if ($login->validateLogIn()):

            $cri = new Criteria();
            $cri->add(New Filter("geo_city_id", "=", $geoCityId));
            $cri->add(new Filter("partner_id", "=", $login->getPartnerId()));
            
            return $this->sqlSelect($cri);
        endif;
    }


}