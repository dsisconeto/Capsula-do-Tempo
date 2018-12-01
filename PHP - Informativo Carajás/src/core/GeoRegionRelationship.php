<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/05/16
 * Time: 21:53
 */
sysLoadClass("ActionGeoRegionRelationship");

class GeoRegionRelationship extends ActionGeoRegionRelationship
{


    public function SelectCityByRegion($geoRegionId)
    {
        $return = FALSE;
        $geoCity = new GeoCity();
        $cri = new Criteria();
        $cri->add(New Filter("geo_region_id", "=", $geoRegionId));
        $resRelation = $this->sqlSelect($cri);
        $count = 0;

        if ($resRelation):

            $resCity = $geoCity->selectOrderByName();

            if ($resCity):

                foreach ($resCity as $keyCity):

                    foreach ($resRelation as $keyRelation):

                        if ($keyCity["geo_city_id"] == $keyRelation["geo_city_id"]):
                            $return[$count]["geo_region_id"] = $keyRelation["geo_region_id"];
                            $return[$count]["geo_city_id"] = $keyCity["geo_city_id"];
                            $return[$count]["geo_city_name"] = $keyCity["geo_city_name"];
                            $return[$count]["geo_state_id"] = $keyCity["geo_state_id"];
                            $return[$count]["geo_city_date_insert"] = $keyCity["geo_city_date_insert"];
                            $return[$count]["geo_city_date_update"] = $keyCity["geo_city_date_update"];
                            $count++;
                        endif;

                    endforeach;

                endforeach;

            endif;

        endif;
        
        return $return;
    }

}