<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 10/05/16
 * Time: 01:28
 */
sysLoadClass("ActionGeoRegionRelationshipParent");

/**
 * Class GeoRegionRelationshipParent
 */
class GeoRegionRelationshipParent extends ActionGeoRegionRelationshipParent
{
    public function __construct()
    {



    }






    public function issetRelation()
    {

        $cri = new Criteria();
        $cri->add(new Filter("geo_region_relationship_parent.geo_region_id", "=", $this->getGeoRegionId()));
        $cri->add(new Filter("geo_region_id_parent", "=", $this->getGeoRegionIdParent()));
        $cri->setProperty("limit", "1");
        $col[] = "geo_region_relationship_parent.geo_region_id";

        return $this->sqlSelect($cri, $col) ? true : false;
    }

    public function createCriteriaByRegion($geoRegionId, $name = "geo_region_id")
    {
        $cri2 = new Criteria();
        $cri1 = new Criteria();
        $geoRegionRelationParent = new GeoRegionRelationshipParent();

        $cri1->add(new Filter("geo_region_relationship_parent.geo_region_id", "=", $geoRegionId));

        $res = $geoRegionRelationParent->sqlSelect($cri1);

        if ($res) {

            foreach ($res as $key) {

                $cri2->add(new Filter($name, "=", $key["geo_region_id"]), Filter::OR_OPERATOR);
                $cri2->add(new Filter($name, "=", $key["geo_region_id_parent"]), Filter::OR_OPERATOR);

            }

        }
        $cri2->add(new Filter($name, "=", 6000), Filter::OR_OPERATOR);

        return $cri2;


    }

    /**
     * @param array $arrayRegion
     * @return null
     */
    public function validateRegion(Array $arrayRegion)
    {
        $return = NULL;
        $res = $this->sqlSelect();
        $countArray = (count($arrayRegion) - 1);
        $count = 0;
        foreach ($res as $keyRelation):

            for ($i = 0; $countArray >= $i; $i++):

                if ($keyRelation["geo_region_id"] == $arrayRegion[$i]):

                    for ($c = 0; $countArray >= $c; $c++):

                        if ($keyRelation["geo_region_id_parent"] == $arrayRegion[$c]):

                            $search[$keyRelation["geo_region_id"]] = true;
                            // caso tenha a região superior a ela não vai adicionar el

                        endif;

                    endfor;

                    if (!isset($search[$keyRelation["geo_region_id"]]) && !isset($index[$keyRelation["geo_region_id"]])):

                        $return[$count]["geo_region_id"] = $keyRelation["geo_region_id"];
                        $return[$count]["geo_region_id_parent"] = $keyRelation["geo_region_id_parent"];
                        $index[$keyRelation["geo_region_id"]] = true;
                        $count++;

                    endif;


                endif;

            endfor;

        endforeach;

        return $return;
    }


    /**
     * @param $geoRegionIdArray
     * @return null
     *  colocar uma região e retonar todas regiões de nivel inferior e superior
     */
    public function selectRegions($geoRegionIdArray)
    {

        $resValidate = $this->validateRegion($geoRegionIdArray);

        $resRegion = $this->sqlSelect();
        $return = NULL;
        $count = 0;

        foreach ($resValidate as $keyValidate):
            $return[$count]["geo_region_id"] = $keyValidate["geo_region_id"];
            $count++;
            foreach ($resRegion as $keyRegion):

                if ($keyValidate["geo_region_id"] == $keyRegion["geo_region_id"]):

                    foreach ($resRegion as $keyRegion2):

                        if ($keyRegion["geo_region_id_parent"] == $keyRegion2["geo_region_id"]):
                            if (!isset($index[$keyRegion2["geo_region_id"]])):
                                $return[$count]["geo_region_id"] = $keyRegion2["geo_region_id"];
                                $count++;
                                $index[$keyRegion2["geo_region_id"]] = true;
                            endif;

                        elseif ($keyRegion2["geo_region_id_parent"] == $keyRegion["geo_region_id"]):
                            if (!isset($index[$keyRegion2["geo_region_id"]])):
                                $return[$count]["geo_region_id"] = $keyRegion2["geo_region_id"];

                                $count++;
                                $index[$keyRegion2["geo_region_id"]] = true;
                            endif;


                        endif;

                    endforeach;

                endif;

            endforeach;
        endforeach;

        return $return;
    }


}