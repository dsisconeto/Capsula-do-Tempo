<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 26/08/16
 * Time: 21:19
 */

sysLoadClass("DjView");

//====================================================== <ADMIN> =======================================================

// <Jornal Impresso>----------------------------------------------------------------------------------------------------

DjRouter::router("admin/impresso/cadastrar/", "admin.AdminControllerNewsPaper@register");
DjRouter::router("admin/impresso/editar/(.)/", "admin.AdminControllerNewsPaper@edit", array(4 => "newspaper_id"));
DjRouter::router("admin/impresso/todos/", "admin.AdminControllerNewsPaper@displayTable");

DjRouter::router("admin/impresso/paginas/(.)/", "admin.AdminControllerNewsPaper@pages", array(4 => "newspaper_id"));


// </Jornal Impresso>----------------------------------------------------------------------------------------------------

/// rigiões ---------------------------------------------------


DjRouter::router("admin/regiao/todas/", "admin.AdminControllerGeoRegion@displayTable");
DjRouter::router("admin/regiao/configurar/(.)", "admin.AdminControllerGeoRegion@config", array(4 => "geo_region_id"));
DjRouter::router("admin/regiao/relacoes/(.)", "admin.AdminControllerGeoRegion@addRelationship", array(4 => "geo_region_id"));


/// -------------------------------------------------------------


// anuncios ------------------------------------------------


DjRouter::router("admin/anuncio/todos/", "admin.AdminControllerAds@displayTable");
DjRouter::router("admin/anuncio/cadastrar/", "admin.AdminControllerAds@register");
DjRouter::router("admin/anuncio/editar/(.)", "admin.AdminControllerAds@edit", array(4 => "ads_id"));


// ----------------------------------------------------


// admin noticias ------------------------------------------------


DjRouter::router("admin/noticia/todas/", "admin.AdminControllerNews@displayTable");
DjRouter::router("admin/noticia/cadastrar/", "admin.AdminControllerNews@register");
DjRouter::router("admin/noticia/editar/(.)", "admin.AdminControllerNews@edit", array(4 => "news_id"));
DjRouter::router("admin/noticia/capa/(.)", "admin.AdminControllerNews@cover", array(4 => "news_id"));
DjRouter::router("admin/noticia/imagem/upload/", "admin.AdminControllerNews@frameImgContent");
DjRouter::router("admin/noticia/tag/", "admin.AdminControllerNews@tag");


// ----------------------------------------------------


// admin eventos ---------------------------------------------

DjRouter::router("admin/evento/cadastrar/", "admin.AdminControllerEvent@register");
DjRouter::router("admin/evento/gerenciar/", "admin.AdminControllerEvent@register");
DjRouter::router("admin/evento/editar/(.)/", "admin.AdminControllerEvent@edit", array(4 => "event_id"));
DjRouter::router("admin/evento/gerenciar/(.)/", "admin.AdminControllerEvent@edit", array(4 => "event_id"));
DjRouter::router("admin/evento/capa/(.)/", "admin.AdminControllerEvent@managerCover", array(4 => "event_id"));
DjRouter::router("admin/evento/galeria/(.)/", "admin.AdminControllerEvent@managerGallery", array(4 => "event_id"));
DjRouter::router("admin/evento/todos/", "admin.AdminControllerEvent@displayTable");

// ------------------------------------------------

// admin empresas ----------------------------------------


DjRouter::router("admin/empresa/cadastrar/", "admin.AdminControllerCompany@register");

DjRouter::router("admin/empresa/editar/(.)/", "admin.AdminControllerCompany@edit", array(4 => "company_id"));
DjRouter::router("admin/empresa/adicionais/(.)/", "admin.AdminControllerCompany@relationship", array(4 => "company_id"));
DjRouter::router("admin/empresa/todas/", "admin.AdminControllerCompany@displayTable");
DjRouter::router("admin/empresa/destaque/", "admin.AdminControllerCompany@featured");

//====================================================== </ADMIN> =============================================


// --------- login
DjRouter::router("login/", "admin.AdminControllerLogin@displayLogin");
DjRouter::router("logout/", "admin.AdminControllerLogin@logOut");

// USUARIO -------------------------------------------------------------------------------------------------------------

DjRouter::router("admin/usuario/cadastrar/", "admin.AdminControllerSystemUser@registerForm");

DjRouter::router("admin/usuario/todos/", "admin.AdminControllerSystemUser@displayTable");
DjRouter::router("admin/usuario/regiao/permissao/(.)/", "admin.AdminControllerGeoRegionUserPermission@manager", array(5 => "system_user_id"));

DjRouter::router("admin/usuario/editar/(.)/", "admin.AdminControllerSystemUser@edit", array(4 => "system_user_id"));
DjRouter::router("admin/usuario/foto/(.)/", "admin.AdminControllerSystemUser@photo", array(4 => "system_user_id"));


DjRouter::router("evento/(.)/", "ControllerEvent@displaySingle", array(2 => "url"));

DjRouter::router("empresas/", "ControllerCompany@index");
DjRouter::router("empresas/pesquisar/", "ControllerCompany@search");
DjRouter::router("empresa/(.)/", "ControllerCompany@single");

DjRouter::router("noticias/", "ControllerNews@index");

DjRouter::router("noticias/(.)/", "ControllerNews@index", array(2 => "news_category_nickname"));

DjRouter::router("impresso/", "ControllerNewspaper@index");

DjRouter::router("impresso/ler/(.)/", "ControllerNewspaper@reader", array(3 => "newspaper_id"));
DjRouter::router("impresso/ler/(.)/pagina/(.)/", "ControllerNewspaper@readerPage", array(3 => "newspaper_id", 5 => "newspaper_page_number"));


DjRouter::router("eventos/", "ControllerEvent@index");
DjRouter::router("eventos/pesquisar/", "ControllerEvent@search");
DjRouter::router("cidade/selecionar/", "ControllerGeoRegion@index");


DjRouter::router("404/(.)/", "ControllerHome@notFound", array(2 => "entity"));
DjRouter::router("404/", "ControllerHome@notFound");


DjRouter::router("anuncio/click/(.)/","ControllerAds@redirect",  array(3 => "ads_id"));

DjRouter::router("admin/", "admin.AdminControllerHome@index");


DjRouter::router("(.)/", "ControllerSystemUrl@defineUrl", array(1 => "url"));

DjRouter::router("sitemp/", "ControllerSystemUrl@siteMap");

DjRouter::router("/", "ControllerHome@index");



