<?php

namespace App\Models\Geo;

use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\Model;

class RegionRelationshipParent extends Model
{

    private $region;
    private $regionParent;


    public function edit()
    {
    }


    public function __construct()
    {
        $this->setTable("geo_region_relationship_parent");
    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("geo_region_id", $this->region()->getId());
        $sql->setRowData("geo_region_id_parent", $this->regionParent()->getId());


        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();
        $criteria->add($this->filter('geo_region_id', '=', $this->region()->getId()));
        $criteria->add($this->filter('geo_region_id_parent', '=', $this->regionParent()->getId()));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();
        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setJoin("geo_region_relationship_parent", "geo_region", "geo_region_id", "geo_region_id");

        return $sql->execute();
    }


    public function issetRelation()
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri->add($this->filter("geo_region_relationship_parent.geo_region_id", "=", $this->region()->getId()));
        $cri->add($this->filter("geo_region_id_parent", "=", $this->regionParent()->getId()));
        $cri->setProperty("limit", "1");
        $sql->setCriteria($cri);

        $sql->addColumn("geo_region_id");


        return $sql->execute();
    }

    public function createCriteriaByRegion($geoRegionId, $name = "geo_region_id")
    {
        $sql = $this->sqlSelect();
        $cri2 = $this->criteria();
        $cri1 = $this->criteria();

        $cri1->add($this->filter("geo_region_relationship_parent.geo_region_id", "=", $geoRegionId));

        $sql->setJoin("geo_region_relationship_parent", "geo_region", "geo_region_id", "geo_region_id");
        $sql->addColumn("*");
        $sql->setCriteria($cri1);


        $res = $sql->execute();

        if ($res) {

            foreach ($res as $key) {

                $cri2->add($this->filter($name, "=", $key["geo_region_id"]), Criteria::OR_OPERATOR);
                $cri2->add($this->filter($name, "=", $key["geo_region_id_parent"]), Criteria::OR_OPERATOR);

            }

        }
        $cri2->add($this->filter($name, "=", 6000), Criteria::OR_OPERATOR);

        return $cri2;


    }

    /**
     * @param array $arrayRegion
     * @return null
     */
    public function validateRegion($arrayRegion)
    {

        $return = NULL;
        $res = $this->select();
        $countArray = (count($arrayRegion) - 1);
        $count = 0;
        if ($arrayRegion) {

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

        }
        return $return;
    }

    public function selectDownRegion()
    {
        // seleciona subs regiões

        $criteria = $this->criteria();
        $criteria->add($this->filter("geo_region_id_parent", "=", $this->region()->getId()));
        return $this->selectBasic($criteria);

    }


    /**
     * @param $geoRegionIdArray
     * @return null
     *  colocar uma região e retonar todas regiões de nivel inferior e superior
     */
    public function selectRegions($geoRegionIdArray)
    {

        $resValidate = $this->validateRegion($geoRegionIdArray);

        $resRegion = $this->select();
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


    /**
     * @return Region
     */
    public function region()
    {

        $this->region = $this->region ? $this->region : new Region();

        return $this->region;
    }


    /**
     * @return Region
     */
    public function regionParent()
    {
        $this->regionParent = $this->regionParent ? $this->regionParent : new Region();

        return $this->regionParent;
    }


}