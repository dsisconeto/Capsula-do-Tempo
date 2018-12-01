<?php

namespace App\Models\Ads;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;

use App\Models\User\User;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class RelationshipRegion extends Model
{

    private $ads;
    private $geoRegion;
    private $user;
    private $dateInsert;


    public function __construct()
    {
        $this->setTable("ads_relationship_region");
    }


    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("ads_id_fk", $this->ads()->getId());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("system_user_id", $this->user()->getId());
        $sql->setRowData("ads_relationship_region_date_insert", GetData::getCurrentTime());

        return $sql->execute();
    }

    public function edit()
    {
    }


    public function validateByUser($adsId)
    {
        $ads = new Ads();
        return ($ads->validateByUser($adsId) ? true : false);
    }

    public function selectAdsByRegion($regionId, $adsLocalId)
    {
        $geoRegionRelationParent = new RegionRelationshipParent();
        $sql = $this->sqlSelect();
        $cri = $geoRegionRelationParent->createCriteriaByRegion($regionId);
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();


        $cri2->add($this->filter
        ("ads.ads_local_id", "=", $adsLocalId));
        $cri2->add($this->filter
        ("ads.ads_status", "=", 1));
        $cri2->add($this->filter
        ("ads.ads_end_display", ">=", GetData::getCurrentTime()));
        $cri2->add($this->filter
        ("ads.ads_start_display", "<=", GetData::getCurrentTime()));


        $cri3->setProperty("order", "ads.ads_turnover ASC");
        $cri3->setProperty("limit", "1");


        $sql->setJoin("ads_relationship_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("ads_relationship_region", "ads", "ads_id_fk", "ads_id");
        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");


        $cri3->add($cri);
        $cri3->add($cri2);

        $sql->addColumn("ads_link");
        $sql->addColumn("ads_id");
        $sql->addColumn("ads_file");

        $sql->setCriteria($cri3);

        return $sql->execute();
    }

    public function selectLastTurnoverByRegion($regionId, $adsLocalId)
    {

        $geoRegionRelationParent = new RegionRelationshipParent();
        $sql = $this->sqlSelect();
        $cri = $geoRegionRelationParent->createCriteriaByRegion($regionId);
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();


        $cri2->add($this->filter
        ("ads.ads_local_id", "=", $adsLocalId));
        $cri2->add($this->filter
        ("ads.ads_status", "=", 1));
        $cri2->add($this->filter
        ("ads.ads_end_display", ">=", GetData::getCurrentTime()));
        $cri2->add($this->filter
        ("ads.ads_start_display", "<=", GetData::getCurrentTime()));


        $cri3->setProperty("order", "ads.ads_turnover DESC");
        $cri3->setProperty("limit", "1");

        $sql->setJoin("ads_relationship_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("ads_relationship_region", "ads", "ads_id_fk", "ads_id");
        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");


        $cri3->add($cri);
        $cri3->add($cri2);

        $sql->addColumn('ads_turnover');
        $sql->setCriteria($cri3);

        $res = $sql->execute();

        return $res[0]["ads_turnover"];
    }

    public function selectRegionsByAds($adsId)
    {
        $return = NULL;
        $cri = $this->criteria();
        $sql = $this->sqlSelect();
        $col = array("geo_region.geo_region_name", "geo_region.geo_region_id");
        $sql->setJoin("ads_relationship_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->addColumn($col);

        $cri->add($this->filter("ads_id_fk", "=", $adsId));


        $sql->setCriteria($cri);
        return $sql->execute();


    }


    public function selectByCompany($companyId, $col = NUll)
    {
        $this->ads()->company()->setId($companyId);
        $cri = $this->criteria();
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");

        $sql->setJoin("ads_relationship_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("ads_relationship_region", "ads", "ads_id_fk", "ads_id");

        $cri->add($this->filter("ads.company_id", "=", $this->ads()->company()->getId()));
        $sql->setCriteria($cri);

        return $sql->execute();
    }


    public function deleteByAds($adsId)
    {
        $ads = new Ads();
        $sql = $this->sqlDelete();


        if ($ads->validateByUser($adsId)):

            $this->ads()->setId($adsId);
            $cri = $this->criteria();
            $cri->add($this->filter('ads_id_fk', '=', $this->ads()->getId()));
            $sql->setCriteria($cri);

            return $sql->execute();
        else:
            return false;
        endif;


    }


    public function selectOrderByNameRegion($order = "ASC")
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->setProperty("order", "geo_region.geo_region_name " . Core::defineOrder($order));
        $sql->setJoin("ads_relationship_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("ads_relationship_region", "ads", "ads_id_fk", "ads_id");
        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");
        $sql->setCriteria($cri);

        return $sql->execute();
    }


    public function ads()
    {

        $this->ads = $this->ads ? $this->ads : new Ads();

        return $this->ads;
    }


    /**
     * @return Region
     */
    public function region()
    {

        $this->geoRegion = $this->geoRegion ? $this->geoRegion : new Region();

        return $this->geoRegion;
    }


    /**
     * @return User
     */
    public function user()
    {
        $this->user = $this->user ? $this->user : new User();

        return $this->user;
    }


    /**
     * @return mixed
     */
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * @param mixed $dateInsert
     */
    public function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;
    }


}