<?php

namespace App\Controllers\Services\Admin;

use App\Models\Geo\RegionUserPermission;
use App\Models\News\News;
use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\GetData;

class ServicesNews
{


    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"), 1);

        $newsId = Request::get("news_id", "int", 0);

        if ($newsId) {
            $news = new News();
            Login::exitServices(!$news->validateByUser($newsId));
        }

    }


    public function search()
    {
        $regionUser = new RegionUserPermission();
        $news = new News();
        $criteria1 = new Criteria();
        $criteria2 = new Criteria();
        $res = array("items" => null, "count" => 0, "numberPage" => 0);

        $categoryIdFilter = Request::get("news_category_id", "int", 0);
        $filterStatus = Request::get("news_status", "int", 0);
        $searchTitle = Request::get("news_title", "string", null);
        $orderBy = Request::get("order_by", "string");
        $order = Request::get("order", "string");
        $page = Request::get("page", "int", 1);
        $limitByPage = Request::get("limitByPage", "int", 10);

        $criteriaRegion = $regionUser->createCriteria("news");


        /// searchTitle
        if (strlen($searchTitle) >= 1):
            $criteria1->add(New Filter("news_title", "LIKE", "%$searchTitle%"));
        endif;
        // filtrando por categoria caso seja necessario
        if ($categoryIdFilter > 0):
            $criteria1->add(New Filter("news_tag.news_category_id_fk", "=", intval($categoryIdFilter)));
        endif;

        // definindo filtro por status
        if ($filterStatus <= 3 && $filterStatus >= 1) {
            $criteria1->add(new Filter("news_status", "=", $filterStatus));
        }
        // definindo ordem
        $order = strtolower($order);

        if ($order != "asc") {
            $order = " DESC ";
        } else {
            $order = " ASC ";
        }

        if ($orderBy == 1):
            $criteria2->setProperty("order", "news_title " . $order);
        elseif ($orderBy == 2):
            $criteria2->setProperty("order", "news_date_insert" . $order);
        elseif ($orderBy == 3):
            $criteria2->setProperty("order", "news_date_update" . $order);
        elseif ($orderBy == 4):
            $criteria2->setProperty("order", "news_counter_view" . $order);
        else:
            $criteria2->setProperty("order", "news_title" . $order);
        endif;

        $criteria2->add($criteria1);
        $criteria2->add($criteriaRegion);
        // sistema de pagaginacao

        // verifica se precisa retorna o número de paginas

        $resNews = $news->searchWithRegion($criteria2, "COUNT(DISTINCT news_id) as count");

        $pageNumber = ceil($resNews[0]["count"] / $limitByPage);

        // setando prorpriedade de paginacao
        $criteria2->setProperty("limit", DataFormat::paginate($page, $limitByPage));
        $col = ["news_id", "news_title", "news_cover", "news_category_name", "system_url_url", "news_date_insert", "news_date_update", "news_status", "news_counter_view"];
        $resNews = $news->searchWithRegion($criteria2, $col);


        if ($resNews) {
            $count = 0;
            foreach ($resNews as $key):
                $resNews[$count]["news_date_insert"] = DataFormat::dateToBr($key["news_date_insert"], true);
                $resNews[$count]["news_date_update"] = DataFormat::dateToBr($key["news_date_update"], true);
                $count++;
            endforeach;

            $res["items"] = $resNews;
            $res["count"] = $count - 1;
            $res["numberPage"] = $pageNumber;
        }


        return $res;
    }


    public function selectTwo()
    {

        $news = new News();
        $criteria1 = new Criteria();
        $criteria2 = new Criteria();
        $criteria3 = new Criteria();
        $criteria4 = new Criteria();
        $news->setTitle(Request::get("news_title", "str", ""));


        $col = array("news_id", "news_title");
        $criteria1->add(New Filter("news_title", "LIKE", "%{$news->getTitle()}%"));
        $criteria1->add(New Filter("news_id", "LIKE", "%{$news->getTitle()}%"), Criteria::OR_OPERATOR);

        $criteria2->add(New Filter("news_date_insert", ">=", DataFormat::dateLess(GetData::getCurrentTime(), 30)));
        $criteria2->add(New Filter("news_date_update", ">=", DataFormat::dateLess(GetData::getCurrentTime(), 30)), Criteria::OR_OPERATOR);
        $criteria3->add(New Filter("news_status", "=", "3"));


        $criteria4->setProperty("limit", "30");
        $criteria4->add($criteria1);
        $criteria4->add($criteria2);
        $criteria4->add($criteria3);
        $result = $news->selectBasic($criteria4, $col);

        $i = 0;
        foreach ($result as $key) {
            $result[$i]["news_title"] = $result[$i]["news_id"] . " - " . $result[$i]["news_title"];
            $i++;
        }

        return DataFormat::select2($result, array("id" => "news_id", "text" => "news_title"));
    }


    public function cover()
    {

        $news = new News();
        $cri = new Criteria();
        $news->setId(Request::get("news_id", "int", 0));

        if ($news->validateByUser()) {
            $col = array("news_title", "news_status", "news_cover");
            $cri->add(new Filter("news_id", "=", $news->getId()));
            $cri->setProperty("limit", "1");
            $result = $news->selectBasic($cri, $col);
            if ($result) {
                $result = $result[0];
            }

            return $result;
        }

        return false;
    }


}