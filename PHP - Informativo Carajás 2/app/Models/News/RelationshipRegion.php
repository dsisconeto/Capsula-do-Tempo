<?php

namespace App\Models\News;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\Geo\RegionUserPermission;
use DSisconeto\Simple\Model;

class RelationshipRegion extends Model
{


    private $news;
    private $region;

    public function __construct()
    {
        $this->news = new News();
        $this->region = new Region();
        $this->setTable("news_relationship_region");
    }

    public function register($newsId, $regions)
    {
        // $geoRegionArray espera receber uma array enviado por multiple select
        $success = 0;
        $relationUserRegion = new RegionUserPermission();
        $sql = $this->sqlInsert();
        $this->news()->setId($newsId);

        $regions = (new RegionRelationshipParent())->validateRegion($regions);

        if ($regions) {

            $this->beginTransaction();

            $this->deleteByNews();

            foreach ($regions as $keyRegion) {

                if ($relationUserRegion->validatePermission($keyRegion["geo_region_id"], "news")):

                    $this->region()->setId($keyRegion["geo_region_id"]);

                    $sql->setRowData("news_id_fk", $this->news()->getId());
                    $sql->setRowData("geo_region_id", $this->region()->getId());

                    if ($sql->execute()) $success++;

                endif;
            }

            if ($success) {
                $this->commit();

            } else {

                $this->rollBack();
            }

        }

        return $success;


    }


    public function deleteByNews()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();
        $criteria->add($this->filter('news_id_fk', '=', $this->news()->getId()));
        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        $sql->setJoin("news_relationship_region", "geo_region", "geo_region_id", "geo_region_id");

        return $sql->execute();
    }


    public function selectByNews($id)
    {
        $cri = $this->criteria();
        $col = array("geo_region.geo_region_id", "geo_region_name");
        $cri->add($this->filter("news_id_fk", "=", $id));

        return $this->select($cri, $col);
    }


    public function selectOrderByNameRegion($order = "ASC")
    {

        $return = NULL;
        $count = 0;

        $resRegion = $this->region()->selectOrderByName($order);
        $resAdsRelation = $this->sqlSelect();

        foreach ($resRegion as $keyRegion):

            foreach ($resAdsRelation as $keyRelation):

                if ($keyRegion["geo_region_id"] == $keyRelation["geo_region_id"]):
                    $return[$count]["geo_region_id"] = $keyRegion["geo_region_id"];
                    $return[$count]["geo_region_name"] = $keyRegion["geo_region_name"];
                    $return[$count]["geo_region_level"] = $keyRegion["geo_region_id"];
                    $return[$count]["news_id"] = $keyRelation["news_id_fk"];
                    $count++;
                endif;

            endforeach;

        endforeach;

        return $return;
    }


    /**
     * @return News
     */
    public function news()
    {

        return $this->news;
    }


    /**
     * @return Region
     */
    public function region()
    {

        return $this->region;
    }
}