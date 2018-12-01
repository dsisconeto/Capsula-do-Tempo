<?php

sysLoadClass("ActionNews");
sysLoadClass("SystemUrl");
sysLoadClass("TrafficView");
sysLoadClass("NewsRelationshipRegion");

use Respect\Validation\Validator as respect;


class News extends ActionNews
{

    public function __construct()
    {

        $this->setImgFolder("news_cover");

    }

    public function validateByUser($news)
    {

        $login = SystemLogin::getLogin();
        $this->sqlLoad($news);
        return (($login->validateLogIn()) && $login->getSystemUserPermissionNews() && ($login->getSystemUserId() == $this->getSystemUserIdFk() || $login->getSystemUserPermissionNewsSuper()));

    }


    public function lastOrder($newsOrder, $newsLocalId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("news_order", "=", $newsOrder));
        $cri->add(new Filter("news_local_id_fk", "=", $newsLocalId));
        $cri->setProperty("limit", 1);
// verifica se existe alguma noticia no lugar

        if ($this->sqlSelect($cri)) {

            $cri = new Criteria();
            $cri2 = new Criteria();
            $cri3 = new Criteria();

            switch ($newsLocalId) {

                case 3:
                    $cri2->add(new Filter("news_local_id_fk", "=", 3), Filter::OR_OPERATOR);
                    $cri2->add(new Filter("news_local_id_fk", "=", 1), Filter::OR_OPERATOR);
                    $cri2->add(new Filter("news_local_id_fk", "=", 4), Filter::OR_OPERATOR);
                    $cri2->add(new Filter("news_local_id_fk", "=", 2), Filter::OR_OPERATOR);

                    break;

                case 1:
                    $cri2->add(new Filter("news_local_id_fk", "=", 1), Filter::OR_OPERATOR);
                    $cri2->add(new Filter("news_local_id_fk", "=", 4), Filter::OR_OPERATOR);
                    $cri2->add(new Filter("news_local_id_fk", "=", 2), Filter::OR_OPERATOR);

                    break;

                case 4:  //caso seja quadro medio

                    $cri2->add(new Filter("news_local_id_fk", "=", 4), Filter::OR_OPERATOR);
                    $cri2->add(new Filter("news_local_id_fk", "=", 2), Filter::OR_OPERATOR);


                    break;
                case 2://caso seja quadro pequeno
                    $cri2->add(new Filter("news_local_id_fk", "=", 2));
                    break;
            }

            $cri->add(new Filter("news_order", ">", 0));
            $cri->add(new Filter("news_status", "=", 3));

            $cri3->add($cri);
            $cri3->add($cri2);
            $cri3->setProperty("order", "news_date_insert DESC");

            $col[] = "news_id";
            $col[] = "news_local_id_fk";
            $col[] = "news_order";
            $col[] = "news_status";
            $col[] = "news_local_count_max";
            $col[] = "news_date_insert";
            $col[] = "news_title";


            $resNews = $this->sqlSelect($cri3, $col);


            if ($resNews) {

                foreach ($resNews as $key) {
                    $this->setNewsTitle($key["news_title"]);

                    $this->setNewsId($key["news_id"]);

                    // caso ele não seja o ultimo do local
                    if (($key["news_order"] < $key["news_local_count_max"])) {

                        if ($newsLocalId == $key["news_local_id_fk"] && ($key["news_order"] < $newsOrder)) {

                            $this->setNewsOrder(($key["news_order"]));
                            $this->setNewsLocalId($key["news_local_id_fk"]);

                        } else {

                            $this->setNewsOrder(($key["news_order"] + 1));
                            $this->setNewsLocalId($key["news_local_id_fk"]);

                        }

                    } else { // caso ele seja o ultimo do local
                        $this->setNewsOrder(1);

                        switch ($key["news_local_id_fk"]) {


                            case 3:     // caso seja gradro MEGA
                                /// maanda para o quadro grande
                                $this->setNewsLocalId(1);

                                break;

                            case 1:         // caso seja quadro grande
                                // manda para o médio
                                $this->setNewsLocalId(4);
                                break;

                            case 4:  //caso seja quadro medio
                                // manda para o pequeno
                                $this->setNewsLocalId(2);

                                break;
                            case 2://caso seja quadro pequeno
                                // contianua no pequeno com a ordem 0
                                $this->setNewsLocalId(2);
                                $this->setNewsOrder(0);
                                break;
                        }

                    }
                    // fazer atualização do ordem e do local
                    $this->sqlUpdateLocal(false);
                }

                $this->sqlUpdateLocal();
            }
        }
    }


    public function showDisplayByUrl($url, $app = false)
    {
        $systemUrl = new SystemUrl();
        $trafficView = new TrafficView();

        if ($systemUrl->sqlLoadByUrl($url)):

            $cri = new Criteria();
            $cri->add(new Filter("system_url_id_fk", "=", $systemUrl->getId()));
            $cri->setProperty("limit", "1");

            $res = $this->sqlSelect($cri);

            if ($res):
                $res = $res[0];
                $result["news_id"] = $res["news_id"];
                $result["news_title"] = $res["news_title"];
                $result["news_category_name"] = $res["news_category_name"];
                $result["news_category_nickname"] = $res["news_category_nickname"];
                $result["news_tag_nickname"] = $res["news_tag_nickname"];
                $result["news_tag_name"] = $res["news_tag_name"];
                $result["news_category_color"] = $res["news_category_color"];
                $result["news_date_insert"] = $res["news_date_insert"];
                $result["news_counter_view"] = $res["news_counter_view"];
                $result["system_url_url"] = $res["system_url_url"];
                $result["news_preview"] = $res["news_preview"];
                $result["news_keywords"] = $res["news_keywords"];
                $result["system_user_name"] = $res["system_user_name"];
                $result["news_cover"] = $res["news_cover"];


                $contet = explode("</p>", $res["news_post"]);
                $count = count($contet);
                $post = "";

                $count = ($count - 1);
                if ($count <= 5):
                    $countAdsVIew = 2;
                else:
                    $countAdsVIew = intval($count / 3);
                endif;
                $result["count_ads_view"] = $countAdsVIew;

                $url = DjWork::currentUrl();
                for ($i = 0; $count >= $i; $i++):

                    $post .= $contet[$i] . "</p>";

                    if (is_int(($i / 7)) && $i != 0 || $i == 1):

                        if ($this->isMobileDevice() || $app):
                            $post .= $ads = "<div class=\"ads\"><script src=\"/services/anuncio/6/js/{$i}/?url=$url\"></script></div>";
                        else:
                            $post .= $ads = "<div class=\"ads\"><script src=\"/services/anuncio/5/js/{$i}/?url=$url\"></script></div>";
                        endif;


                    endif;

                endfor;

                $result["news_post"] = $post;

                if ($res["news_status"] == 3):

                    $this->updateCounterView($res["news_id"], $trafficView->counterViewUrl($systemUrl->getId()));

                    return $result;

                elseif ($this->validateUser($res["news_id"])):

                    return $result;
                else:
                    false;
                endif;

            else:
                return false;
            endif;

        else:
            return false;
        endif;
    }


    public function lastId()
    {

        $cri = new Criteria();
        $cri->setProperty("limit", 1);
        $cri->setProperty("order", "news_id DESC");
        $cri->setProperty("session", session_id());

        $res = $this->sqlSelect($cri);

        if ($res):
            $this->setNewsId($res[0]["news_id"]);
            return $res[0]["news_id"];

        else:
            return false;
        endif;
    }


    public function validateUser($newsId)
    {
        /// valida se a noticia perdence ao usuario
        $login = SystemLogin::getLogin();

        $this->sqlLoad($newsId);

        return $login->validateLogIn() && ($this->getSystemUserIdFk() == $login->getSystemUserId());

    }

    public function newsViewMore($limit = 3)
    {
        $cri = new Criteria();
        $cri->add(new Filter("news_date_insert", ">=", $this->dateLess($this->currentTime(), 7)));

        $cri->add(new Filter("news_status", "=", "3"));
        $cri->setProperty("limit", $limit);
        $cri->setProperty("order", "news_counter_view DESC");

        return $this->sqlSelect($cri);
    }

    public function newsManchete($limit = 3)
    {

        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();


        $cri2->add(new Filter("news_status", "=", "3"));

        $cri3->add(new Filter("news_local_id", "=", "1"));
        $cri3->add(new Filter("news_local_id", "=", "3"), Expression::OR_OPERATOR);

        $cri->add($cri2);
        $cri->add($cri3);
        $cri->setProperty("limit", $limit);
        $cri->setProperty("order", "news_date_insert DESC");

        $res = $this->sqlSelect($cri);
        $count = 0;
        if ($res):

            foreach ($res as $key):
                $result[$count]["news_title"] = $key["news_title"];
                $result[$count]["news_tag_name"] = $key["news_tag_name"];
                $result[$count]["system_url_url"] = $this->getHost() . $key["system_url_url"];
                $result[$count]["news_cover"] = $key["news_cover"];
                $result[$count]["news_category_color"] = $key["news_category_color"];


                $count++;
            endforeach;

        else:

            $result = null;

        endif;


        return $result;
    }


    public function updateCounterView($newsId, $counterView)
    {
        $this->setNewsId($newsId);
        $this->setNewsCounterView($counterView);
        $this->sqlUpdateCounterView();
    }


    public function selectMachete()
    {

        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::requestInputOther("geo_region_id", "int"));

        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("news_status", "=", 3));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "news_date_insert DESC");

        $res = $this->sqlSelect($cri3);

        $result = array();
        $count = 0;
        $index = array();

        if ($res):

            foreach ($res as $key):

                if (!isset($index[$key["news_local_id"]])):

                    $index[$key["news_local_id"]] = 0;

                endif;

                if ($key["news_local_count_max"] >= $index[$key["news_local_id"]]):

                    $result[$count]["news_title"] = $key["news_title"];
                    $result[$count]["news_cover"] = $this->getHost() . $this->getImgFolder() . $key["news_cover"];
                    $result[$count]["news_order"] = $key["news_order"];
                    $result[$count]["news_tag_name"] = $key["news_tag_name"];
                    $result[$count]["news_category_name"] = $key["news_category_name"];
                    $result[$count]["news_category_color"] = $key["news_category_color"];
                    $result[$count]["system_url_url"] = $this->getHost() . $key["system_url_url"];
                    $result[$count]["news_local_id"] = $key["news_local_id"];
                    $count++;

                    $index[$key["news_local_id"]]++;

                endif;

            endforeach;


        endif;


        return $result;


    }


    public function requestLastNews($limit)
    {

        $geoRegionRelationParent = new GeoRegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(DjRequest::cookie("geo_region_id", "int"));

        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $cri2->add(new Filter("news_status", "=", 3));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("limit", "0, $limit");
        $cri3->setProperty("order", "news_date_insert DESC");

        return $this->sqlSelect($cri3);

    }


}
