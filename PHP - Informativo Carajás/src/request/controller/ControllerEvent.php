<?php

sysLoadClass("Event");
sysLoadClass("TrafficView");

use Respect\Validation\Validator as respect;

class ControllerEvent extends DjView
{
    public function displaySingle()
    {
        $event = new Event();
        $trafficView = new TrafficView();
        $gallery = new EventGallery();
        $res = $event->sqlLoadUrl(DjRequest::get("url"));

        if ($res && ($event->getEventStatus() == 3 || $event->validateUserByEvent($event->getId()))) {

            $this->setDate("metaTitle", $event->getName());
            $this->setDate("metaDescription", $event->limitText($event->getDescription(), 150));
            $this->setDate("metaKeywords", $event->keyWords($event->getName()));
            $photo = DjRequest::get("photo", "int", 0);

            $res = $photo ? $gallery->sqlLoad($photo) : false;
            if (($res) && $gallery->event()->getId() == $event->getId()) {
                $this->setDate("metaImage", $gallery->getImgFolderSm($gallery->getFile(), 1, true));
            } else {
                $this->setDate("metaImage", $event->getImgFolderSm($event->getCover(), 1, true));
            }
            $this->setDate("eventUrl", DjWork::getHost() . $event->url()->getUrl());
            $this->setDate("eventId", $event->getId());
            $this->setDate("eventName", $event->getName());
            $this->setDate("eventDescription", $event->getDescription());
            $this->setDate("eventLocal", $event->getEventLocal());
            $this->setDate("eventDate", $event->dateToViewBr($event->getDate()));
            $this->setDate("eventCover", $event->getCover());
            $this->setDate("eventAddress", $event->getAddress());
            $this->setDate("eventCounterView", $event->getCounterView());
            $this->setDate("eventCategoryName", $event->category()->getName());
            $this->setDate("regionName", $event->region()->getName());


            if (SystemConfigGeoRegion::validate()) {

                $this->setDate("selectRegion", false);

                $this->setDate("eventRoof", $event->getRoof());

                if ($event->getAddressMaps()) {

                    $this->setDate("eventAddressMaps", $event->getAddressMaps());

                }

                if ($trafficView->register(DjRequest::get("url"))) {
                    $rand = rand(1, 7);
                    for ($i = 0; $i < $rand; $i++) {
                        $trafficView->register(DjRequest::get("url"));
                    }
                    $event->updateCounter(DjRequest::get("url"));
                }

            } else {
                $this->setDate("selectRegion", true);
                $this->setDate("continue", DjWork::currentUrl());
            }

            $this->view("event@single");
        } else {

            $this->location("404/evento/");
        }

    }


    public function search()
    {

        $event = new Event();
        $arg = DjRequest::get("arg");

        if (DjRequest::issetGet("arg") && respect::length(1)->validate($arg)) {


            if (SystemConfigGeoRegion::validate("event")) {
                $this->setDate("selectRegion", false);
                $res = $event->search($arg);

                $this->setDate("eventSearch", $res);
                $this->setDate("search", $arg);

                $count = count($res);

                $this->setDate("metaTitle", "$arg($count) - Pesquisar Evento");
                $this->setDate("metaDescription", "Eventos: { $arg} = ($count)");
                $this->setDate("metaKeywords", "Pesquisar, eventos");
                $this->setDate("metaUrl", DjWork::currentUrl());


            } else {

                $this->setDate("metaTitle", "Pesquiar Eventos - Informativo Carajás");
                $this->setDate("metaDescription", "Pesquiar Eventos");
                $this->setDate("metaKeywords", "Pesquisar, eventos");
                $this->setDate("metaUrl", DjWork::currentUrl());
                $this->setDate("metaImage", "");


                $this->setDate("selectRegion", true);
                $this->setDate("continue", DjWork::currentUrl());
            }


            $this->view("event@search");


        } else {

            $this->location("eventos/");

        }
    }

    public function index()
    {

        $event = new Event();
        $this->setDate("metaTitle", "Eventos - Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setDate("metaDescription", "Eventos - Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setDate("metaKeywords", "evento, informativo, carjas");
        $this->setDate("metaUrl", DjWork::currentUrl());

        if (SystemConfigGeoRegion::validate("event") || DjWork::crawlerDetect()) {
            $this->setDate("selectRegion", false);
            $this->setDate("metaImage", "");
            $this->setDate("eventWeek", $event->eventWeek());
            $this->setDate("eventDay", $event->eventDay());
            $this->setDate("eventRoof", $event->eventRoof());
            $this->setDate("eventNext", $event->eventNext());
            $this->setDate("eventRoofCountSlide", 0);


        } else {


            $this->setDate("selectRegion", true);
            $this->setDate("continue", DjWork::currentUrl());

        }


        $this->view("event@index");


    }


}