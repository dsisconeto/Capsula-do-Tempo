<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 31/08/16
 * Time: 19:10
 */

sysLoadClass("News");

class ServicesNews
{


    public function selectByCategory()
    {

        $newsCategoryId = DjRequest::get("news_category_id", "int", 0);
        $page = DjRequest::get("page", "int", 0);
        $limitByPage = DjRequest::get("limit_by_page", "int", 0);
        $skip = DjRequest::get("skip", "int", 18);;

        $news = new News();

        $geoRegionRelationParent = new GeoRegionRelationshipParent();

        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"));

        $cri2 = new Criteria();
        $cri3 = new Criteria();


        if ($newsCategoryId):

            $cri2->add(new Filter("news_tag.news_category_id_fk", "=", $newsCategoryId));

        endif;

        if ($page && $limitByPage):

            $cri3->setProperty("limit", $news->paginate($page, $limitByPage, $skip));

        endif;

        $cri2->add(new Filter("news_status", "=", 3));

        $cri3->setProperty("order", "news_date_insert DESC");
        $cri3->add($cri);
        $cri3->add($cri2);

        $res = $news->sqlSelect($cri3);


        $result = array();
        $count = 0;
        $index = array();

        if ($res):
            foreach ($res as $key):

                if (!isset($index[$key["news_local_id"]])):
                    $index[$key["news_local_id"]] = 0;
                endif;

                if ($key["news_local_count_max"] >= $index[$key["news_local_id"]]):

                    $result[$count]["news_id"] = $key["news_id"];
                    $result[$count]["news_title"] = $key["news_title"];
                    $result[$count]["news_cover"] = $key["news_cover"];
                    $result[$count]["news_order"] = $key["news_order"];
                    $result[$count]["news_tag_name"] = $key["news_tag_name"];
                    $result[$count]["news_tag_nickname"] = $key["news_tag_nickname"];
                    $result[$count]["news_category_name"] = $key["news_category_name"];
                    $result[$count]["news_category_color"] = $key["news_category_color"];
                    $result[$count]["system_url_url"] = $news->getHost() . $key["system_url_url"];
                    $result[$count]["news_local_id"] = $key["news_local_id"];
                    $count++;

                    $index[$key["news_local_id"]]++;
                endif;
            endforeach;


        endif;


        return $result;
    }


    public function selectLastNews()
    {

        $news = new News();

        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"));

        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("news_status", "=", 3));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "news_date_insert DESC");


        $res = $news->sqlSelect($cri3);

        $result = array();
        $count = 0;
        $index = array();

        if ($res):
            foreach ($res as $key):

                if (!isset($index[$key["news_local_id"]])):
                    $index[$key["news_local_id"]]["count"] = 0;

                endif;

                if ($key["news_local_count_max"] >= $index[$key["news_local_id"]]["count"]
                    && !isset($index[$key["news_local_id"]]["order"][$key["news_order"]])
                ):

                    $result[$count]["news_title"] = $key["news_title"];
                    $result[$count]["news_cover"] = $key["news_cover"];
                    $result[$count]["news_order"] = $key["news_order"];
                    $result[$count]["news_tag_name"] = $key["news_tag_name"];
                    $result[$count]["news_category_name"] = $key["news_category_name"];
                    $result[$count]["news_category_color"] = $key["news_category_color"];
                    $result[$count]["system_url_url"] = $news->getHost() . $key["system_url_url"];
                    $result[$count]["news_local_id"] = $key["news_local_id"];
                    $index[$key["news_local_id"]]["order"][$key["news_order"]] = true;
                    $index[$key["news_local_id"]]["count"]++;
                    $count++;

                endif;

            endforeach;


        endif;


        return $result;
    }


    public function single()
    {
        $news = New News();
        $news->setNewsId(DjRequest::get("news_id", "int", 0));
        $news->sqlLoad($news->getNewsId());

        $return = NULL;
        if ($news->getNewsStatus() == 3) {
            $return["news_id"] = $news->getNewsId();
            $return["news_title"] = $news->getNewsTitle();
            $return["news_post"] = $news->getNewsPost();
            $return["news_cover"] = $news->getNewsCover();
        }
        return $return;
    }


}