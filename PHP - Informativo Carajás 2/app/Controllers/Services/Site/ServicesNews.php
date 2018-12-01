<?php

namespace App\Controllers\Services\Site;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\News\News;
use App\Models\News\Panel;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;


class ServicesNews
{


    public function selectByCategory()
    {
        $news = new News();
        $geoRegionRelationParent = new RegionRelationshipParent();
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $tagId = Request::get("news_tag", "int", 0);
        $newsCategoryId = Request::get("news_category_id", "int", 0);
        $page = Request::get("page", "int", 1);
        $limitByPage = 20;
        $skip = Request::get("skip", "int", (new Panel())->getNumberLocal());

        $cri = $geoRegionRelationParent->createCriteriaByRegion(Region::define());


        if ($newsCategoryId) {

            $cri2->add(new Filter("news_tag.news_category_id_fk", "=", $newsCategoryId));
        } elseif ($tagId) {

            $cri2->add(new Filter("news_tag.news_tag_id", "=", $tagId));
        }


        $cri3->setProperty("limit", DataFormat::paginate($page, $limitByPage, $skip));


        $cri2->add(new Filter("news_status", "=", 3));

        $cri3->setProperty("order", "news_date_insert DESC");
        $cri3->add($cri);
        $cri3->add($cri2);

        $col = array("news_id", "news_title", "news_cover", "news_tag_name", "news_tag_nickname", "news_category_name", "system_url_url", "news_category_color");

        return $news->searchWithRegion($cri3, $col);
    }


}