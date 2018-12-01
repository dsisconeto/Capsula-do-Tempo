<?php

sysLoadClass("News");
sysLoadClass("TrafficView");
sysLoadClass("NewsCategory");
sysLoadClass("NewsLocal");


class ControllerNews extends DjView
{

    public function index()
    {
        $newsCategory = new NewsCategory();

        $res = $newsCategory->selectAllByName();
        $this->setDate("newsCategoryAll", $res);
        $this->setDate("metaTitle", "Notícias - Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setDate("metaDescription", "Notícias - Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setDate("metaKeywords", "noticias, informativo, carajas");
        $this->setDate("metaUrl", DjWork::getHost() . "noticias/");


        $CategoryNickname = DjRequest::get("news_category_nickname", "str", "");

        if ($CategoryNickname) {

            $newsCategory->sqlLoadNickname($CategoryNickname);
            if ($newsCategory->getNewsCategoryId()) {
                $this->setDate("newsCategoryId", $newsCategory->getNewsCategoryId());
            }
        }

        // verificar se já foi selecionando uma cidade
        if (SystemConfigGeoRegion::validate() || DjWork::crawlerDetect()) {
            $this->setDate("selectRegion", false);
            $this->setDate("viewLoad", 1);
        } else {
            $this->setDate("continue", DjWork::currentUrl());
            $this->setDate("selectRegion", true);

        }


        $this->view("news@index");

    }

    public function single()
    {


        $this->setDate("newsSingle", 1);


        $news = new News();
        $trafficView = new TrafficView();


        if ($news->isMobileDevice()) {
            $this->setDate("lastNews", $news->requestLastNews(2));
            $this->setDate("lastNewsCount", 0);

        } else {
            $this->setDate("lastNews", $news->requestLastNews(8));
        }

        $res = $news->showDisplayByUrl(DjRequest::get("url"));


        $login = SystemLogin::getLogin();


        if (($res) || ($news->validateByUser($news->getNewsId()) || $login->getSystemUserPermissionNewsSuper())) {

            $this->setDate("newsSystemUserName", $res["system_user_name"]);
            $this->setDate("newsTitle", $res["news_title"]);
            $this->setDate("newsCover", $res["news_cover"]);
            $this->setDate("newsCategoryName", $res["news_category_name"]);
            $this->setDate("newsCategoryNickname", $res["news_category_nickname"]);
            $this->setDate("newsTagNickname", $res["news_tag_nickname"]);
            $this->setDate("newsCategoryNickname", $res["news_category_nickname"]);


            $this->setDate("newsTag", $res["news_tag_name"]);
            $this->setDate("newsCategoryColor", $res["news_category_color"]);
            $this->setDate("newsDateInsert", $news->dateToBr($res["news_date_insert"]));
            $this->setDate("newsCounterView", $res["news_counter_view"]);

            /// carregando metas

            $this->setDate("metaTitle",$res["news_title"]);
            $this->setDate("metaDescription", $res["news_preview"]);
            $this->setDate("metaKeywords", $res["news_keywords"]);
            $this->setDate("metaImage", $news->getImgFolderSm($res["news_cover"], 1, true));
            $url = DjWork::currentUrl();
            $this->setDate("metaUrl", $url);


            $this->setDate("newsPost", $res["news_post"]);

            $this->setDate("host", DjWork::getHost());
            $this->setDate("countAdsView", $res["count_ads_view"]);

            $res = $news->newsViewMore();

            $this->setDate("viewMoreAll", $res);

            $res = $news->newsManchete();
            $this->setDate("ViewManchete", $res);


            $trafficView->register(DjRequest::get("url"), DjRequest::get("source", "int", 0));

            // verificar se já foi selecionando uma cidade
            if (SystemConfigGeoRegion::validate() || DjWork::crawlerDetect()) {
                $this->setDate("selectRegion", false);
            } else {
                $this->setDate("continue", $url);
                $this->setDate("selectRegion", DjWork::currentUrl());
            }


            $this->view("news@single");
        } else {
            $this->location("404/noticia/");

        }


    }


}