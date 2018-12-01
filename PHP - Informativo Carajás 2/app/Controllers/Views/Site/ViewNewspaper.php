<?php


namespace App\Controllers\Views\Site;
use App\Models\Newspaper\Newspaper;
use App\Models\Newspaper\Page;
use App\Models\System\ConfigGeoRegion;
use DSisconeto\Simple\Controller;

use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\View;

class ViewNewspaper extends View
{

    public function __construct()
    {
        $configRegion = ConfigGeoRegion::getSystemConfig();
        $this->setData("systemEventView", $configRegion->getEventView());
        $this->setData("systemCompanyView", $configRegion->getCompanyView());
        $this->setData("systemNewspaperView", $configRegion->getNewspaperView());

    }

    public function index()
    {

        $configRegion = ConfigGeoRegion::getSystemConfig();


        // verificar se já foi selecionando uma cidade
        if (ConfigGeoRegion::validate("newspaper")) {
            $this->setData("selectRegion", false);

            if (!$configRegion->validate("newspaper")) {
                $this->location("");
            }

        } else {
            $this->setData("continue", Core::currentUrl());
            $this->setData("selectRegion", true);

        }

        $this->setData("metaTitle", "Jornal Impresso  - Informativo Carajás");
        $this->setData("metaDescription", "Jornal Impresso  - Informativo Carajás");
        $this->setData("metaKeywords", "jornal, impresso, noticias");


        $this->view("site.newspaper@index");
    }

    public function readerPage()
    {
        // instacinado classe
        $page = new Page();
        $newspaper = new Newspaper();
        // pegando variaveis
        $pageNumber = Request::get("newspaper_page_number", "int", 1);
        $newspaperId = Request::get("newspaper_id");

        // carregando dados do jornal
        $load = $newspaper->load($newspaperId);
        // pegando o nome da região(cidade)
        $regioName = $load["geo_region_name"];

        // pegando páginas do jornal
        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id_fk", "=", $newspaperId));
        $cri->setProperty("order", "newspaper_page_number ASC");
        $col[] = "newspaper_page_number";
        $col[] = "newspaper_page_file";
        $res = $page->select($cri, $col);


        if (isset($res[0]) && $load) {

            // definindo capa de evento
            $cover = $res[0]["newspaper_page_file"];
            // contanto quantas páginas são
            $countPage = count($res);
            $dataPub = DataFormat::dateToBr($newspaper->getPublicationDate(), false);
            $edition = $newspaper->getEdition();
            $drawing = $newspaper->getDrawing();

            $metaTitle = $regioName . " /  Edição {$edition}°, Publicação: {$dataPub}, Tiragem: {$drawing}";


            // colocando as paǵinas com indexe de ordem
            $pageJson = array();
            foreach ($res as $key) {
                $pageJson[$key["newspaper_page_number"]] = $key["newspaper_page_file"];
            }


            $this->setData("regionName", $regioName);
            $this->setData("edition", $edition);
            $this->setData("drawing", $drawing);
            $this->setData("dataPub", $dataPub);
            $this->setData("hideAdsTop", true);
            $this->setData("pagesJson", json_encode($pageJson));
            $this->setData("pages", $res);
            $this->setData("pageNumber", $pageNumber);
            $this->setData("countPage", $countPage);
            $this->setData("metaTitle", $metaTitle);
            $this->setData("metaDescription", $metaTitle);
            $this->setData("metaKeywords", DataFormat::keyWords($metaTitle));
            $this->setData("metaImage", "/img/newspaperPage/thumbnails/" . $cover);
            $this->setData("metaUrl", Core::currentUrl());


            $this->view("site.newspaper@readerPage");


        } else {
            $this->setData("msg", "ops, Página do Jornal não encontrada");
            $this->view("404");
        }


    }


}