<?php

use DSisconeto\Simple\Request;

//====================================================== <SITE> =======================================================

// EMPRESAS
Request::route("empresas/", "Site.ViewCompany@index");
Request::route("empresas/pesquisar/", "Site.ViewCompany@search");
Request::route("empresas/pesquisar/(page)", "Site.ViewCompany@search");
Request::route("empresa/(.)/", "Site.ViewCompany@single");

// NOTÍCIAS
Request::route("noticias/", "Site.ViewNews@index");
Request::route("noticias/pesquisar/", "Site.ViewNews@search");
Request::route("noticias/pesquisar/(page)/", "Site.ViewNews@search");
Request::route("noticias/(news_category_nickname)/", "Site.ViewNews@index");
Request::route("noticias/(news_category_nickname)/(news_tag_nickname)", "Site.ViewNews@index");

// JORNAL IMPRESO
Request::route("impresso/", "Site.ViewNewspaper@index");
Request::route("impresso/ler/(newspaper_id)/", "Site.ViewNewspaper@reader");
Request::route("impresso/ler/(newspaper_id)/pagina/(newspaper_page_number)/", "Site.ViewNewspaper@readerPage");

//  EVENTOS
Request::route("eventos/", "Site.ViewEvent@index");
Request::route("eventos/pesquisar/", "Site.ViewEvent@search");
Request::route("eventos/pesquisar/(page)/", "Site.ViewEvent@search");
// CIDADE
Request::route("cidade/selecionar/", "Site.ViewGeoRegion@index");

// 404
Request::route("404/(entity)/", "Site.ViewHome@notFound");
Request::route("404/", "Site.ViewHome@notFound");


// INDEX
Request::route("/", "Site.ViewHome@index");


// SITEMAP
Request::route("sitemap/", "Site.ViewSystemUrl@siteMap");

// ANUNCIO
Request::route("anuncio/click/(ads_id)/", "Site.ViewAds@redirect");

// LOGIN
Request::route("login/", "Admin.ViewLogin@displayLogin");
Request::route("logout/", "Admin.ViewLogin@logOut");


//====================================================== </SITE> =======================================================

//====================================================== <Admin> =======================================================

// INDEX
Request::route("admin/", "Admin.ViewHome@index");


// JORNAL IMPRESSO
Request::route("admin/impresso/cadastrar/", "Admin.ViewNewsPaper@register");
Request::route("admin/impresso/editar/(newspaper_id)/", "Admin.ViewNewsPaper@edit");
Request::route("admin/impresso/todos/", "Admin.ViewNewsPaper@displayTable");
Request::route("admin/impresso/paginas/(newspaper_id)/", "Admin.ViewNewsPaper@pages");

/// REGIÕES
Request::route("admin/regiao/todas/", "Admin.ViewGeoRegion@displayTable");
Request::route("admin/regiao/configurar/(geo_region_id)", "Admin.ViewGeoRegion@config");
Request::route("admin/regiao/relacoes/(geo_region_id)", "Admin.ViewGeoRegion@addRelationship");

// ANUNCIOS
Request::route("admin/anuncio/cadastrar/", "Admin.ViewAds@register");
Request::route("admin/anuncio/cadastrar/(company_id)/", "Admin.ViewAds@register");
Request::route("admin/anuncio/editar/(ads_id)", "Admin.ViewAds@edit");
Request::route("admin/anuncio/empresa/(company_id)", "Admin.ViewAds@company");

// NOTICIAS
Request::route("admin/noticia/painel/", "Admin.ViewNews@panel");
Request::route("admin/noticia/todas/", "Admin.ViewNews@displayTable");
Request::route("admin/noticia/cadastrar/", "Admin.ViewNews@register");
Request::route("admin/noticia/editar/(news_id)/", "Admin.ViewNews@edit");
Request::route("admin/noticia/capa/(news_id)", "Admin.ViewNews@cover");
Request::route("admin/noticia/imagem/upload/", "Admin.ViewNews@frameImgContent");
Request::route("admin/noticia/tag/", "Admin.ViewNews@tag");

// EVENTOS
Request::route("admin/evento/cadastrar/", "Admin.ViewEvent@register");
Request::route("admin/evento/gerenciar/", "Admin.ViewEvent@register");
Request::route("admin/evento/editar/(event_id)/", "Admin.ViewEvent@edit");
Request::route("admin/evento/gerenciar/(event_id)/", "Admin.ViewEvent@edit");
Request::route("admin/evento/capa/(event_id)/", "Admin.ViewEvent@managerCover");
Request::route("admin/evento/galeria/(event_id)/", "Admin.ViewEvent@managerGallery");
Request::route("admin/evento/todos/", "Admin.ViewEvent@displayTable");


// EMRPESAS
Request::route("admin/empresa/cadastrar/", "Admin.ViewCompany@register");
Request::route("admin/empresa/editar/(company_id)/", "Admin.ViewCompany@edit");
Request::route("admin/empresa/adicionais/(company_id)/", "Admin.ViewCompany@relationship");
Request::route("admin/empresa/todas/", "Admin.ViewCompany@displayTable");
Request::route("admin/empresa/destaque/", "Admin.ViewCompany@featured");


// USUARIO

Request::route("admin/usuario/cadastrar/", "Admin.ViewSystemUser@registerForm");
Request::route("admin/usuario/todos/", "Admin.ViewSystemUser@displayTable");
Request::route("admin/usuario/regiao/permissao/(system_user_id)/", "Admin.ViewGeoRegionUserPermission@manager");
Request::route("admin/usuario/editar/(system_user_id)/", "Admin.ViewSystemUser@edit");
Request::route("admin/usuario/foto/(system_user_id)/", "Admin.ViewSystemUser@photo");


//====================================================== </ADMIN> =============================================

// ENTIDADES GERAIS
Request::route("(url)/", "Site.ViewSystemUrl@defineUrl");