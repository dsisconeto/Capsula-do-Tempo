<?php


namespace App\Controllers\Views\Site;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\News\Category;
use App\Models\News\News;
use App\Models\News\Panel;
use App\Models\News\Tag;
use App\Models\Process\NewsHome;
use App\Models\Traffic\View as TraficView;
use App\Models\System\ConfigGeoRegion;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;


class ViewNews extends View
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
        $home = new NewsHome();
        $home->load(Region::define());

        $json = json_decode($home->getData(), true);
        $result = null;

        $this->setData("categoryResult", $json["category"]);
        $this->setData("resultNews", $json["panel"]);


        $this->setData("geoRegionId", Region::define());


        $this->setData("metaTitle", "Notícias - Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setData("metaDescription", "Notícias - Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setData("metaUrl", GetData::getCurrentUrl());
        $this->view("site.news@index", false);

    }

    public function search()
    {
        $news = new News();
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();
        $page = Request::get("page", "int", 1);
        $arg = Request::get("arg", "str", "");
        $region = Request::get("region", "int", 0);
        $limitByPage = 21;


        // só pode aparecer notícias de públicadas
        $cri->add(new Filter("news_status", "=", 3));
        // caso tenha algum paramentro pesquisar
        if ($region) {

            $cri3 = (new RegionRelationshipParent())->createCriteriaByRegion($region);
        }
        if ($arg) {
            $cri2->add(new Filter("news_title", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
            $cri2->add(new Filter("news_category_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
        }

        $cri->add($cri2);

        if ($cri3->dump()) {
            $this->setData("geoRegionId", $region);
            $cri->add($cri3);
        }

        if ($cri3->dump()) {

            $result = $news->searchWithRegion($cri, "COUNT(DISTINCT news_id) as count");

        } else {

            $result = $news->select($cri, "COUNT(DISTINCT news_id) as count");

        }

        $numberPage = ceil($result[0]["count"] / $limitByPage);
        $numberResult = $result[0]["count"];

        $cri->setProperty("order", "news.news_date_insert DESC");
        $cri->setProperty("limit", DataFormat::paginate($page, $limitByPage));
        if ($cri3->dump()) {
            $result = $news->searchWithRegion($cri, ["news_id", "news_title", "news_cover", "system_url_url", "news_category_color", "news_tag_name"]);
        } else {

            $result = $news->select($cri, ["news_id", "news_title", "news_cover", "system_url_url", "news_category_color", "news_tag_name"]);

        }

        $this->setData("result", $result);
        $this->setData("numberPage", $numberPage);
        $this->setData("numberResult", $numberResult);
        $this->setData("page", $page);
        $this->setData("arg", $arg);

        $this->setData("metaTitle", "Todas as Notícias - Informativo Carajás. O Portal da Região Carajás (Sul do Pará)");
        $this->setData("metaDescription", "Todas as Notícias - Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setData("metaUrl", GetData::getCurrentUrl());

        $this->view("site.news@search");
    }

    public function single()
    {

        $traffic = new TraficView();
        $news = new News();
        $news->url()->setUrl(Request::get("url"));
        // verifica se é possivel carregar noticia
        if ($news->loadTotal()) {

            if (GetData::getIsMobile()) {
                $this->setData("lastNews", $news->lastNews());
            } else {
                $this->setData("lastNews", $news->lastNews(8));
            }
            // registrando acesso

            $traffic->register($news->url()->getUrl(), Request::get("source", "int", 0));

            $this->setData("viewMoreAll", $news->mostViewed(Region::define(), 5));
            $this->setData("ViewManchete", $news->selectMachete(Region::define()));
            $this->setData("related", $news->related(Region::define()));


            $news->setDateInsert(DataFormat::dateToBr($news->getDateInsert(), true));


            /// carregando metas
            $this->setData("metaTitle", $news->getTitle());
            $this->setData("metaDescription", $news->getPreview());
            $this->setData("metaImage", $news->getImgFolderSm($news->getCover(), 1, true));
            $this->setData("metaUrl", GetData::getHostMain() . "");


            $this->setData("news", $news);
            $this->view("site.news@single", true);
        }


    }


}