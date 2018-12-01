<?php

// Eventos -------------------------------------------------------------------------------------------------------------
DjRouter::routerServices("evento/pagina/(.)/", "ServicesEvent@allPaginate", array(3 => "page"));

DjRouter::routerServices("evento/pagina/", "ServicesEvent@allPaginate");

DjRouter::routerServices("evento/galeria/pagina/", "ServicesEventGallery@requestByEvent");

DjRouter::routerServices("evento/galeria/foto/download/", "ServicesEventGallery@downloadPhoto");


// Empresas ------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("empresa/departamento/", "ServicesCompanyDepartment@selectByCompany");
DjRouter::routerServices("empresa/telefone/", "ServicesCompanyPhone@selectByCompany");
DjRouter::routerServices("empresa/email/", "ServicesCompanyEmail@selectByCompany");
DjRouter::routerServices("empresa/relacao/segmento/", "ServicesCompanySegment@selectByCompany");
DjRouter::routerServices("empresa/logo/", "ServicesCompany@logo");
DjRouter::routerServices("empresa/capa/", "ServicesCompany@cover");
DjRouter::routerServices("empresa/galeria/", "ServicesCompanyGallery@selectBycCompany");
DjRouter::routerServices("empresa/social/", "ServicesCompanySocialNetwork@selectByView");
DjRouter::routerServices("empresa/regiao/", "ServicesCompanyRegion@selectByCompany");
DjRouter::routerServices("empresa/destaque/", "ServicesCompanyFeatured@select");
DjRouter::routerServices("empresa/select2/", "ServicesCompany@select2");

// Sistema -------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("sistema/redesocial/", "ServicesSystemSocialNetwork@selectOrderByName");

// Noticias ------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("noticia/news-all/", "ServicesNews@selectLastNews");
DjRouter::routerServices("noticia/news-all-paginate/", "ServicesNews@selectByCategory");
DjRouter::routerServices("noticia/(.)/", "ServicesNews@single", array( 2 => "news_id"));
/// Anuncios -----------------------------------------------------------------------------------------------------------

DjRouter::routerServices("anuncio/(.)/(.)/", "ServicesAds@show", array(2 => "local", 3 => "view"));
DjRouter::routerServices("anuncio/(.)/(.)/(.)/", "ServicesAds@show", array(2 => "local", 3 => "view", 4 => "nada"));
DjRouter::routerServices("anuncio/(.)/(.)/(.)/(.)/", "ServicesAds@show", array(2 => "local", 3 => "view", 4 => "blabla", 5 => "url"));

// Região  -------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("regiao/select2/", "ServicesGeoRegion@select2");

// Jornal impresso----------------------------------------------------------------------------------------------------


DjRouter::routerServices("impresso/todos/", "ServicesNewspaper@featAll");
DjRouter::routerServices("impresso/paginas/", "ServicesNewspaper@allPagesByNewspaper");
DjRouter::routerServices("impresso/pagina/", "ServicesNewspaper@Page");

//======================================================================================================================
//============================================= <ADMIN> ================================================================

// Anuncios ------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("admin/anuncio/pesquisar/", "admin.AdminServicesAds@search");
DjRouter::routerServices("admin/anuncio/company/", "admin.AdminServicesCompany@searchForAds");

// Empresas ------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("admin/empresa/pesquisar/", "admin.AdminServicesCompany@search");

// Noticias ------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("admin/noticia/pesquisar/", "admin.AdminServicesNews@search");
DjRouter::routerServices("admin/noticia/tag/", "admin.AdminServicesNewsTag@selectByCategory");
DjRouter::routerServices("admin/noticia/local/", "admin.AdminServicesNewsLocal@byId");
DjRouter::routerServices("admin/noticia/imagem/conteudo/", "admin.AdminServicesNewsContentImg@selectByUser");


// Eventos -------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("admin/evento/capa/(.)/", "admin.AdminServicesEvent@cover", array(4 => "event_id"));
DjRouter::routerServices("admin/evento/pesquisar/", "admin.AdminServicesEvent@search");
DjRouter::routerServices("admin/evento/galeria/(.)/", "admin.AdminServicesEventGallery@byEvent", array(4 => "event_id"));
DjRouter::routerServices("admin/evento/galeria/", "admin.AdminServicesEventGallery@byEvent");

// Regiao --------------------------------------------------------------------------------------------------------------


DjRouter::routerServices("admin/regiao/pesquisar/", "admin.AdminServicesGeoRegion@search");
DjRouter::routerServices("admin/regiao/parent/", "admin.AdminServicesGeoParent@loadTable");
DjRouter::routerServices("admin/regiao/select2/level/", "admin.AdminServicesGeoRegion@searchLowLevel");

DjRouter::routerServices("admin/regiao/select2/permissao/(.)/", "admin.AdminServicesGeoRegionPermission@searchRegion", array(5 => "permission"));


// Jornal impresso----------------------------------------------------------------------------------------------------


DjRouter::routerServices("admin/impresso/paginas/", "admin.AdminServicesNewspaperPage@selectAllPagesByNewspaper");
DjRouter::routerServices("admin/impresso/pesquisar/", "admin.AdminServicesNewspaper@search");


// Usuario --------------------------------------------------------------------------------------------------------------------

DjRouter::routerServices("admin/regiao/permissao/select2/", "admin.AdminServicesGeoRegionPermission@select2");


DjRouter::routerServices("admin/usuario/permissao/regiao/", "admin.AdminServicesGeoRegionPermission@selectPermissionByUser");


//============================================= </ADMIN> ===============================================================


DjRouter::routerServices("regiao/sub/", "ServicesGeoRegion@selectSubRegionByRegion");
DjRouter::routerServices("regiao/level/select2/", "ServicesGeoRegion@searchLevel");



