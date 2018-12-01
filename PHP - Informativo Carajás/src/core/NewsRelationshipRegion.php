<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 13/05/2016
 * Time: 17:55
 */
sysLoadClass("ActionNewsRelationshipRegion");
sysLoadClass("GeoRegionRelationshipParent");
sysLoadClass("News");
sysLoadClass("GeoRegionUserPermission");

class NewsRelationshipRegion extends ActionNewsRelationshipRegion
{


    public function __construct()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Erro ao Criar relação Noticia com a região", false, 2);
        $this->setMsg("Relação criada com sucesso", true, 3);

    }


    public function register($geoRegionId, $newsId)
    {
        // $geoRegionArray espera receber uma array enviado por multiple select
        $success = 0;
        $newsRegion = new NewsRelationshipRegion();


        $relationUserRegion = new GeoRegionUserPermission();
        $geoRegionRelationParent = new GeoRegionRelationshipParent();

        $geoRegion = $geoRegionRelationParent->validateRegion($geoRegionId);
        $newsRegion->setNewsIdFk($newsId);

        if ($geoRegion):

            $newsRegion->deleteByNews($newsId);

            foreach ($geoRegion as $keyRegion):

                if ($relationUserRegion->validatePermission($keyRegion["geo_region_id"], "news")):

                    $newsRegion->setGeoRegionId($keyRegion["geo_region_id"]);

                    if ($newsRegion->sqlInsert()):

                        $success++;
                    endif;

                endif;

            endforeach;
        endif;


        return $success;
    }


    public function selectByNews($newsId)
    {
        $return = NULL;
        $cri = new Criteria();

        $cri->add(New Filter("news_id_fk", "=", intval($newsId)));
        $resRelation = $this->sqlSelect($cri);

        return $resRelation;

    }

    public function deleteByNews($newsId)
    {
        $news = new News();
        if ($news->validateUser($newsId)):
            $this->setNewsIdFk($newsId);
            return $this->sqlDeleteNews();
        else:
            return false;
        endif;
    }


    public function selectOrderByNameRegion($order = "ASC")
    {
        $geoRegion = new GeoRegion();
        $return = NULL;
        $count = 0;

        $resRegion = $geoRegion->selectOrderByName($order);
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


}