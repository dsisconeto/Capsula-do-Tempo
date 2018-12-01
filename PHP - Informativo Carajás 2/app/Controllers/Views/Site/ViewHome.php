<?php


namespace App\Controllers\Views\Site;

use App\Models\Company\RelationshipFeatured;
use App\Models\Event\Event;
use App\Models\Geo\Region;
use App\Models\News\Category;
use App\Models\News\Panel;
use App\Models\Process\NewsHome;
use App\Models\System\ConfigGeoRegion;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;
use Respect\Validation\Rules\EvenTest;


class ViewHome extends View
{

    public function __construct()
    {
        $configRegion = ConfigGeoRegion::getSystemConfig();
        Region::define();
        $this->setData("selectGeoRegionName", Request::cookie("geo_region_name"));
        $this->setData("selectGeoRegionId", Request::cookie("geo_region_id"));

        $this->setData("systemEventView", $configRegion->getEventView());
        $this->setData("systemCompanyView", $configRegion->getCompanyView());
        $this->setData("systemNewspaperView", $configRegion->getNewspaperView());

    }


    public function index()
    {
        $companRelaFeatu = new RelationshipFeatured();
        $newsHome = new NewsHome();
        $event = new Event();

        // pega as configurações da região
        $configRegion = ConfigGeoRegion::getSystemConfig();
        /// caso essa região só tenha noticia
        if (!$configRegion->getCompanyView() && !$configRegion->getEventView()) {
            // caso a região só tenha noticias
            $this->location("noticias/");
        }

        $newsHome->load(Region::define());
        // recuperar as notiias
        $news = json_decode($newsHome->getData(), true);
        $this->setData("resultNews", $news["panel"]);
        // recuperas todas categorias de noticias
        $this->setData("companyTop", $companRelaFeatu->selectRegion(Region::define(), 1));

        // recuperando os eventos
        $col = ["event_id", "event_name", "system_url_url", "geo_region_name", "event_cover", "event_roof_cover"];

        $this->setData("eventWeek", $event->eventWeek($col));
        $this->setData("eventDay", $event->eventsDay($col));
        $this->setData("eventRoof", $event->eventsRoof($col));
        $this->setData("eventNext", $event->eventNext($col));
        $this->setData("eventRoofCountSlide", 0);


        $this->setData("metaTitle", "Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setData("metaDescription", "Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setData("metaKeywords", "informativo, arajas,noticias, eventos, guia comercial, empresas, sul, do, para");
        $this->setData("metaUrl", GetData::getHostMain());
        $this->setData("geoRegionId", Region::define());

        $this->view("site@home");
    }


    public function notFound()
    {

        $this->setData("metaTitle", "Erro 404 - Mega IC");
        $this->setData("metaDescription", "Página não encontrada");

        switch (Request::get("entity", "str", "")) {

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

        $this->setData("msg", $msg);


        $this->view("site.404");
    }


}