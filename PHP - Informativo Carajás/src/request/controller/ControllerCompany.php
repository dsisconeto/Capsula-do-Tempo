<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 08/09/2016
 * Time: 05:16
 */

sysLoadClass("Company");

sysLoadClass("CompanyRelationshipFeatured");
sysLoadClass("Company");

class ControllerCompany extends DjView
{


    public function index()
    {
        $companRelaFeatu = new CompanyRelationshipFeatured();

        // verificar se já foi selecionando uma cidade
        if (SystemConfigGeoRegion::validate("company") || DjWork::crawlerDetect()) {
            $this->setDate("selectRegion", false);


            $companyTop = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 1);
            $Bares = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 2);
            $hoteis = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 4);
            $clubes = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 5);
            $imobili = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 6);
            $farmacia = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 7);
            $super = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 8);
            $versture = $companRelaFeatu->select(DjRequest::cookie("geo_region_id"), 9);


            $this->setDate("companyTop", $companyTop);
            $this->setDate("bares", $Bares);
            $this->setDate("hoteis", $hoteis);
            $this->setDate("clubes", $clubes);
            $this->setDate("imobili", $imobili);
            $this->setDate("farmacia", $farmacia);
            $this->setDate("super", $super);
            $this->setDate("versture", $versture);


        } else {
            $this->setDate("continue", DjWork::currentUrl());
            $this->setDate("selectRegion", true);

        }


        $this->setDate("metaTitle", "Empresas - Informativo Carajás. O Portal da Região Carajás(Sul do Pará)");
        $this->setDate("metaDescription", "Empresas - Informativo Carajás. O Portal da Região Carajás(Sul do Pará), Acompanhe Notícias, Eventos e Guia Comercial da Região do Carajás(Sul do Pará)");
        $this->setDate("metaKeywords", "empresas, informativo, carajas ");
        $this->setDate("metaUrl", DjWork::currentUrl());


        $this->view("company@index");

    }

    public function single()
    {
        $company = new Company();
        $resCompany = $company->showDisplay(DjRequest::get("url", "str", ""));

        if ($resCompany):

            $this->setDate("companyFantasyName", $resCompany["company_fantasy_name"]);
            $this->setDate("companyDescription", $resCompany["company_description"]);
            $cover = $resCompany["company_cover"];
            $this->setDate("companyCover", $cover);
            $this->setDate("companyEmail", $resCompany["company_email"]);
            $this->setDate("companySocial", $resCompany["company_social"]);


            $this->setDate("companyPhone", $resCompany["company_phone"]);
            $this->setDate("companyAddress", $resCompany["company_address"]);
            $this->setDate("companyAddress", $resCompany["company_address"]);
            $this->setDate("companyAddressEmbed", $resCompany["company_address_embed"]);
            $this->setDate("systemUrl", DjRequest::get("url", "str", ""));

            if (isset($_SESSION["FORM_EMAIL_COMPANY"])) {

                $msg = $_SESSION["FORM_EMAIL_COMPANY"];
                unset($_SESSION["FORM_EMAIL_COMPANY"]);
                $this->setDate("formEmailRes", $msg["boolean"]);
                $this->setDate("formEmailMsg", $msg["msg"]);

            }


            if ($resCompany["company_gallery"]):
                $this->setDate("companyGallery", $resCompany["company_gallery"]);
                $this->setDate("companyGalleryCount", count($resCompany["company_gallery"]));
                $this->setDate("companyGalleryCount_1", 0);

            endif;


            $this->setDate("hideAdsTop", true);
            /// carregando metas
            $this->setDate("metaUrlId", "");

            $this->setDate("metaTitle", $resCompany["company_fantasy_name"]);
            $this->setDate("metaDescription", $company->limitText($resCompany["company_description"], 150) . " - " . $resCompany["company_fantasy_name"] . " de  ");
            $this->setDate("metaKeywords", DjWork::keyWords($resCompany["company_fantasy_name"]));
            $this->setDate("metaImage", $company->getImgFolderMd($cover, 2, true));
            $this->setDate("metaUrl", DjWork::currentUrl());

            if ($resCompany["company_nivel"] > 1) {

                $this->view("company@single");
            } else {
                $this->view("company@simple");
            }

        endif;


    }


    public function search()
    {


        $company = new Company();

        if (strlen(DjRequest::get("arg", "str", "")) >= 1) {


            if (SystemConfigGeoRegion::validate("company")) {

                $this->setDate("selectRegion", false);


                if (!SystemConfigGeoRegion::validate("company")) {
                    $this->location("");
                }


                $arg = DjRequest::get("arg");
                $res = $company->search($arg);
                $this->setDate("resCompany", $res);


                $this->setDate("search", DjRequest::get("arg"));
                $count = count($res);
                $this->setDate("metaTitle", "Empresas: {$arg}($count)");
                $this->setDate("metaDescription", "Empresas: {$arg} = ($count)");
                $this->setDate("metaKeywords", "Pesquisar, Empresas,guia, comercial");
                $this->setDate("metaUrl", DjWork::currentUrl());


            } else {

                $this->setDate("continue", DjWork::currentUrl());
                $this->setDate("selectRegion", true);


                $this->setDate("metaTitle", "Pesquisar Empresas - Informativo Carajás");
                $this->setDate("metaDescription", "Pesquisar Empresas - Informativo Carajás");
                $this->setDate("metaKeywords", "Pesquisar, Empresas,guia, comercial");
                $this->setDate("metaUrl", DjWork::currentUrl());
                $this->setDate("metaImage", "");

            }


            $this->view("company@search");

        } else {
            echo "fail";
            DjRouter::callController("ControllerCompany@index");
        }

    }


}