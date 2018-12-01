<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/05/16
 * Time: 21:24
 */
sysLoadClass("ActionAdsRelationshipRegion");
sysLoadClass("GeoRegionRelationshipParent");

sysLoadClass("Ads");

class AdsRelationshipRegion extends ActionAdsRelationshipRegion
{

    public function __construct()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Erro ao Criar relação do Anucion com a região", false, 2);
        $this->setMsg("Relação criada com sucesso", true, 3);

    }


    public function validateByUser($adsId)
    {

        $ads = new Ads();


        return ($ads->validateByUser($adsId) ? true : false);
    }

    public function selectAdsByRegion($regionId, $adsLocalId)
    {
        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion($regionId);
        $cri2 = new Criteria();
        $cri3 = new Criteria();


        $cri2->add(new Filter("ads.ads_local_id", "=", $adsLocalId));
        $cri2->add(new Filter("ads.ads_status", "=", 1));
        $cri2->add(new Filter("ads.ads_end_display", ">=", $this->currentTime()));
        $cri2->add(new Filter("ads.ads_start_display", "<=", $this->currentTime()));


        $cri3->setProperty("order", "ads.ads_turnover ASC");
        $cri3->setProperty("limit", "1");

        $cri3->add($cri);
        $cri3->add($cri2);
        $col[] = "ads_link";
        $col[] = "ads_file";
        $col[] = "ads_id";

        $resAdsRelationRegion = $this->sqlSelect($cri3, $col);

        return $resAdsRelationRegion;
    }

    public function selectLastTurnoverByRegion($regionId, $adsLocalId)
    {

        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion($regionId);
        $cri2 = new Criteria();
        $cri3 = new Criteria();


        $cri2->add(new Filter("ads.ads_local_id", "=", $adsLocalId));
        $cri2->add(new Filter("ads.ads_status", "=", 1));
        $cri2->add(new Filter("ads.ads_end_display", ">=", $this->currentTime()));
        $cri2->add(new Filter("ads.ads_start_display", "<=", $this->currentTime()));


        $cri3->setProperty("order", "ads.ads_turnover DESC");
        $cri3->setProperty("limit", "1");

        $cri3->add($cri);
        $cri3->add($cri2);

        $col[] = "ads_turnover";
        $res = $this->sqlSelect($cri3, $col);
        return $res[0]["ads_turnover"];
    }

    public function selectByAds($adsId)
    {
        $return = NULL;
        $cri = new Criteria();


        $cri->add(New Filter("ads_id_fk", "=", $adsId));
        $resRelation = $this->sqlSelect($cri);

        return $resRelation;

    }

    public function deleteByAds($adsId)
    {
        $ads = new Ads();
        if ($ads->validateByUser($adsId)):
            $this->setAdsId($adsId);
            return $this->sqlDeleteAds();

        else:
            return false;
        endif;
    }


    public function selectOrderByNameRegion($order = "ASC")
    {
        $return = NULL;

        $cri = new Criteria();

        $cri->setProperty("order", "geo_region.geo_region_name " . $this->defineOrder($order));
        $resAdsRelation = $this->sqlSelect($cri);

        return $resAdsRelation;
    }


}