<?php

sysLoadClass("Event");
sysLoadClass("CompanyRelationshipFeatured");
sysLoadClass("Company");
sysLoadClass("NewsCategory");


class ControllerHome extends DjView
{


    public function index()
    {

        if (SystemConfigGeoRegion::validate() || DjWork::crawlerDetect()) {

            $this->setDate("selectRegion", false);


            $newsCategory = new NewsCategory();
            $res = $newsCategory->selectAllByName();
            $this->setDate("newsCategoryAll", $res);
            $companRelaFeatu = new CompanyRelationshipFeatured();
            $company = new Company();
            $event = new Event();


            $configRegion = SystemConfigGeoRegion::getSystemConfig();

            if (!$configRegion->getCompanyView() && !$configRegion->getEventView()) {
                $host = DjWork::getHost();
                header("location:{$host}noticias/");
            }


            $companyTop = $companRelaFeatu->select($_COOKIE["geo_region_id"], 1);
            $this->setDate("companyTop", $companyTop);


            $this->setDate("eventWeek", $event->eventWeek());
            $this->setDate("eventDay", $event->eventDay());
            $this->setDate("eventRoof", $event->eventRoof());
            $this->setDate("eventNext", $event->eventNext());
            $this->setDate("eventRoofCountSlide", 0);
            $this->setDate("viewLoad", 1);


        } else {

            $this->setDate("continue", DjWork::currentUrl());
            $this->setDate("selectRegion", true);
        }

        $this->setDate("metaTitle", "Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setDate("metaDescription", "Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setDate("metaKeywords", "informativo, arajas,noticias, eventos, guia comercial, empresas, sul, do, para");
        $this->setDate("metaUrl", DjWork::getHost());


        $this->view("home");
    }


    public function notFound()
    {
        $msg = "";
        $this->setDate("metaTitle", "Erro 404 - Mega IC");
        $this->setDate("metaDescription", "Página não encontrada");

        switch (DjRequest::get("entity", "str", "")) {

            case"empresa":
                $msg = "Ops, Empresa não encontrada :/";
                break;

            case"noticia":
                $msg = "Ops, Notícia não encontrada :/";
                break;

            case"evento":
                $msg = "Ops, Evento não encontrada :/";
                break;

            default:
                $msg = "Ops, página não encontrada :/";

                break;

        }

        $this->setDate("msg", $msg);

        echo "local";

        $this->view("404");
    }


}