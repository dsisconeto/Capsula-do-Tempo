<?php


namespace App\Controllers\Views\Site;

use App\Models\Event\Event;
use App\Models\Event\Gallery;
use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\System\ConfigGeoRegion;
use App\Models\Traffic\View as traficView;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\View;

class ViewEvent extends View
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

    public function displaySingle()
    {
        $trafficView = new traficView();
        $gallery = new Gallery();
        $event = new Event();


        if ($event->loadDisplay(Request::get("url", "str", ""))) {

            $this->setData("metaTitle", $event->getName());
            $this->setData("metaDescription", DataFormat::limitText($event->getDescription(), 150));

            $this->setData("metaUrl", GetData::getCurrentUrl());
            $photo = Request::get("photo", "int", 0);
            $photo ? $gallery->load($photo) : false;
            if ($gallery->event()->getId() == $event->getId()) {

                $this->setData("metaImage", $gallery->getImgFolderSm($gallery->getFile(), 1, true));
            } else {
                $this->setData("metaImage", $event->getImgFolderSm($event->getCover(), 1, true));
            }


            $this->setData("eventId", $event->getId());
            $this->setData("eventName", $event->getName());
            $this->setData("eventDescription", $event->getDescription());
            $this->setData("eventLocal", $event->getLocal());
            $this->setData("eventDate", DataFormat::dateToViewBr($event->getDate()));
            $this->setData("eventCover", $event->getCover());
            $this->setData("eventAddress", $event->getAddress());
            $this->setData("eventCounterView", $event->getCounterView());
            $this->setData("eventCategoryName", $event->category()->getName());
            $this->setData("regionName", $event->region()->getName());

            $this->setData("gallery", json_encode($gallery->selectByEvent($event->getId(), ["event_gallery_file", "event_gallery_id"])));


            $this->setData("eventRoof", $event->getRoof());

            if ($event->getAddressMaps()) {

                $this->setData("eventAddressMaps", $event->getAddressMaps());

            }


            $trafficView->url()->setUrl(Request::get("url"));


            $this->view("site.event@single");
        }

    }


    public function search()
    {

        $event = new Event();
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri4 = new Criteria();
        $cri3 = new Criteria();
        $limitByPage = 10;

        $arg = Request::get("arg", "str", "");
        $page = Request::get("page", "int", 0);
        $region = Request::get("region", "int", 0);


        if ($arg) {
            $cri2->add(new Filter("event_category_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);
            $cri2->add(new Filter("event_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);
        }

        if ($region) {
            $cri3 = (new RegionRelationshipParent())->createCriteriaByRegion($region, "event_relationship_geo_region.geo_region_id_fk");
        }


        $cri->add(new Filter("event_status", "=", 3));
        $cri4->add($cri);
        $cri4->add($cri2);

        if ($cri3->dump()) {
            $this->setData("geoRegionId", $region);
            $cri4->add($cri3);
        }

        if ($cri3->dump()) {
            $result = $event->selectMix($cri4, "COUNT(DISTINCT event_id) as count");
        } else {
            $result = $event->select($cri4, "COUNT(DISTINCT event_id) as count");
        }

        $numberPage = ceil($result[0]["count"] / $limitByPage);
        $numberResult = $result[0]["count"];

        $cri4->setProperty("limit", DataFormat::paginate($page, $limitByPage));
        $cri4->setProperty("order", "event_date DESC");


        if ($cri3->dump()) {
            $result = $event->selectMix($cri4, ["event_id", "event_cover", "system_url_url", "event_name"]);
        } else {
            $result = $event->select($cri4, ["event_id", "event_cover", "system_url_url", "event_name"]);
        }


        $this->setData("arg", $arg);
        $this->setData("eventSearch", $result);
        $this->setData("numberPage", $numberPage);
        $this->setData("page", $page);
        $this->setData("metaTitle", "$arg($numberResult) - Pesquisar Evento");
        $this->setData("metaDescription", "Eventos: { $arg} = ($numberResult)");
        $this->setData("metaUrl", GetData::getCurrentUrl());


        $this->view("site.event@search");


    }

    public function index()
    {

        $event = new Event();
        $this->setData("metaTitle", "Eventos - Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setData("metaDescription", "Eventos - Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setData("metaKeywords", "evento, informativo, carjas");
        $this->setData("metaUrl", GetData::getCurrentUrl());

        if (ConfigGeoRegion::validate("event")) {


            $this->setData("metaImage", "");
            $col = ["event_id", "event_name", "system_url_url", "geo_region_name", "event_cover", "event_roof_cover"];
            $this->setData("eventWeek", $event->eventWeek($col));
            $this->setData("eventDay", $event->eventsDay($col));
            $this->setData("eventRoof", $event->eventsRoof($col));
            $this->setData("eventNext", $event->eventNext($col));
            $this->setData("eventRoofCountSlide", 0);
            $this->setData("geoRegionId", Region::define());


        } else {
            $this->location();
        }


        $this->view("site.event@index", false);
    }


}