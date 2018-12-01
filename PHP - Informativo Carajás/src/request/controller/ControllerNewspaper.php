<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 22/09/16
 * Time: 19:16
 */

sysLoadClass("SystemConfigGeoRegion");
sysLoadClass("NewspaperPage");

class ControllerNewspaper extends DjView
{

    public function index()
    {

        $configRegion = SystemConfigGeoRegion::getSystemConfig();


        // verificar se já foi selecionando uma cidade
        if (SystemConfigGeoRegion::validate("newspaper")) {
            $this->setDate("selectRegion", false);

            if (!$configRegion->validate("newspaper")) {
                $this->location("");
            }

        } else {
            $this->setDate("continue", DjWork::currentUrl());
            $this->setDate("selectRegion", true);

        }

        $this->setDate("metaTitle", "Jornal Impresso  - Informativo Carajás");
        $this->setDate("metaDescription", "Jornal Impresso  - Informativo Carajás");
        $this->setDate("metaKeywords", "jornal, impresso, noticias");


        $this->view("newspaper@index");
    }

    public function readerPage()
    {
        // instacinado classe
        $page = new NewspaperPage();
        $newspaper = new Newspaper();
        // pegando variaveis
        $pageNumber = DjRequest::get("newspaper_page_number", "int", 1);
        $newspaperId = DjRequest::get("newspaper_id");

        // carregando dados do jornal
        $load = $newspaper->sqlLoad($newspaperId);
        // pegando o nome da região(cidade)
        $regioName = $load["geo_region_name"];

        // pegando páginas do jornal
        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id_fk", "=", $newspaperId));
        $cri->setProperty("order", "newspaper_page_number ASC");
        $col[] = "newspaper_page_number";
        $col[] = "newspaper_page_file";
        $res = $page->sqlSelect($cri, $col);


        if (isset($res[0]) && $load) {

            // definindo capa de evento
            $cover = $res[0]["newspaper_page_file"];
            // contanto quantas páginas são
            $countPage = count($res);
            $dataPub = DjWork::dateToBr($newspaper->getNewspaperPublicationDate(), false);
            $edition = $newspaper->getNewspaperEdition();
            $drawing = $newspaper->getNewspaperDrawing();

            $metaTitle = $regioName . " /  Edição {$edition}°, Publicação: {$dataPub}, Tiragem: {$drawing}";


            // colocando as paǵinas com indexe de ordem
            $pageJson = array();
            foreach ($res as $key) {
                $pageJson[$key["newspaper_page_number"]] = $key["newspaper_page_file"];
            }


            $this->setDate("regionName", $regioName);
            $this->setDate("edition", $edition);
            $this->setDate("drawing", $drawing);
            $this->setDate("dataPub", $dataPub);
            $this->setDate("hideAdsTop", true);
            $this->setDate("pagesJson", json_encode($pageJson));
            $this->setDate("pages", $res);
            $this->setDate("pageNumber", $pageNumber);
            $this->setDate("countPage", $countPage);
            $this->setDate("metaTitle", $metaTitle);
            $this->setDate("metaDescription", $metaTitle);
            $this->setDate("metaKeywords", DjWork::keyWords($metaTitle));
            $this->setDate("metaImage", "/img/newspaperPage/thumbnails/" . $cover);
            $this->setDate("metaUrl", DjWork::currentUrl());


            $this->view("newspaper@readerPage");


        } else {
            $this->setDate("msg", "ops, Página do Jornal não encontrada");
            $this->view("404");
        }


    }


}