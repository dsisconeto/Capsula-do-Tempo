<?php

namespace App\Controllers\Views\Site;

use App\Models\Company\Company;
use App\Models\Company\RelationshipFeatured;
use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\System\ConfigGeoRegion;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;


class ViewCompany extends View
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

        // verificar se já foi selecionando uma cidade
        if (ConfigGeoRegion::validate("company")) {


            $companyTop = $companRelaFeatu->selectRegion(Region::define(), 1);
            $Bares = $companRelaFeatu->selectRegion(Region::define(), 2);
            $hoteis = $companRelaFeatu->selectRegion(Region::define(), 4);
            $clubes = $companRelaFeatu->selectRegion(Region::define(), 5);
            $imobili = $companRelaFeatu->selectRegion(Region::define(), 6);
            $farmacia = $companRelaFeatu->selectRegion(Region::define(), 7);
            $super = $companRelaFeatu->selectRegion(Region::define(), 8);
            $versture = $companRelaFeatu->selectRegion(Region::define(), 9);

            $this->setData("geoRegionId", Region::define());
            $this->setData("companyTop", $companyTop);
            $this->setData("bares", $Bares);
            $this->setData("hoteis", $hoteis);
            $this->setData("clubes", $clubes);
            $this->setData("imobili", $imobili);
            $this->setData("farmacia", $farmacia);
            $this->setData("super", $super);
            $this->setData("versture", $versture);


        } else {
            $this->location();
        }


        $this->setData("metaTitle", "Empresas - Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setData("metaDescription", "Empresas - Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setData("metaKeywords", "empresas, informativo, carajas ");
        $this->setData("metaUrl", GetData::getCurrentUrl());


        $this->view("site.company@index");

    }

    public function single()
    {
        $company = new Company();
        $resCompany = $company->showDisplay(Request::get("url", "str", ""));

        if ($resCompany):

            $this->setData("companyFantasyName", $resCompany["company_fantasy_name"]);
            $this->setData("companyDescription", $resCompany["company_description"]);
            $cover = $resCompany["company_cover"];
            $this->setData("companyCover", $cover);
            $this->setData("companyEmail", $resCompany["company_email"]);
            $this->setData("companySocial", $resCompany["company_social"]);


            $this->setData("companyPhone", $resCompany["company_phone"]);
            $this->setData("companyAddress", $resCompany["company_address"]);
            $this->setData("companyAddress", $resCompany["company_address"]);
            $this->setData("companyAddressEmbed", $resCompany["company_address_embed"]);
            $this->setData("systemUrl", Request::get("url", "str", ""));

            if (isset($_SESSION["FORM_EMAIL_COMPANY"])) {

                $msg = $_SESSION["FORM_EMAIL_COMPANY"];
                unset($_SESSION["FORM_EMAIL_COMPANY"]);
                $this->setData("formEmailRes", $msg["boolean"]);
                $this->setData("formEmailMsg", $msg["msg"]);

            }


            if ($resCompany["company_gallery"]):
                $this->setData("companyGallery", $resCompany["company_gallery"]);
                $this->setData("companyGalleryCount", count($resCompany["company_gallery"]));
                $this->setData("companyGalleryCount_1", 0);

            endif;


            $this->setData("hideAdsTop", true);
            /// carregando metas
            $this->setData("metaUrlId", "");

            $this->setData("metaTitle", $resCompany["company_fantasy_name"]);
            $this->setData("metaDescription", DataFormat::limitText($resCompany["company_description"], 150) . " - " . $resCompany["company_fantasy_name"] . " de  ");
            $this->setData("metaKeywords", DataFormat::keyWords($resCompany["company_fantasy_name"]));
            $this->setData("metaImage", $company->getImgFolderMd($cover, 2, true));
            $this->setData("metaUrl", GetData::getCurrentUrl());

            if ($resCompany["company_nivel"] > 1) {

                $this->view("site.company@single");
            } else {
                $this->view("site.company@simple");
            }

        endif;


    }


    public function search()
    {

        $company = new Company();
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();
        $arg = Request::get("arg", "str", "");
        $region = Request::get("region", "int", 0);
        $limitByPage = 20;
        $page = Request::get("page", "int", 1);


        if ($arg) {

            $cri2->add(new  Filter("company_fantasy_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);
            $cri2->add(new Filter("company_segment_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);
        }

        if ($region) {
            $cri3 = (new RegionRelationshipParent())->createCriteriaByRegion($region, "company_relationship_geo_region.geo_region_id_fk");
        }

        $cri->add(new  Filter("company_status", "=", "1"));
        $cri->add($cri2);
        $cri->add($cri3);


        if ($cri3->dump()) {
            $this->setData("geoRegionId", $region);
            $result = $company->selectMixRegion($cri, "COUNT(DISTINCT company_id) as count");
        } else {
            $result = $company->selectMix($cri, "COUNT(DISTINCT company_id) as count");
        }

        $numberPage = ceil($result[0]["count"] / $limitByPage);
        $numberResult = $result[0]["count"];

        $cri->setProperty("order", "company_nivel DESC");
        $cri->setProperty("limit", DataFormat::paginate($page, $limitByPage));

        $col = ["company_id", "company_fantasy_name", "company_address", "company_logo", "company_nivel", "system_url_url"];

        if ($cri3->dump()) {
            $result = $company->selectMixRegion($cri, $col);
        } else {
            $result = $company->selectMix($cri, $col);
        }


        $this->setData("numberPage", $numberPage);
        $this->setData("numberResult", $numberResult);
        $this->setData("resCompany", $result);
        $this->setData("arg", $arg);
        $this->setData("page", $page);

        $this->setData("metaTitle", "Empresas: {$arg}($numberResult)");
        $this->setData("metaDescription", "Empresas: {$arg} = ($numberResult)");
        $this->setData("metaKeywords", "Pesquisar, Empresas,guia, comercial");
        $this->setData("metaUrl", GetData::getCurrentUrl());


        $this->view("site.company@search");


    }


}