<?php

use DSisconeto\Simple\Request;


//============================================= <SITE> ===============================================================

// EVENTOS -------------------------------------------------------------------------------------------------------------

Request::route("evento/", "Site.ServicesEvent@single");
Request::route("evento/pagina/(page)/", "Site.ServicesEvent@allPaginate");
Request::route("evento/pagina/", "Site.ServicesEvent@allPaginate");
Request::route("evento/galeria/pagina/", "Site.ServicesEventGallery@requestByEvent");
Request::route("evento/galeria/foto/download/", "Site.ServicesEventGallery@downloadPhoto");


// EMREPSAS ------------------------------------------------------------------------------------------------------------

Request::route("empresa/departamento/", "Site.ServicesCompanyDepartment@selectByCompany");
Request::route("empresa/telefone/", "Site.ServicesCompanyPhone@selectByCompany");
Request::route("empresa/email/", "Site.ServicesCompanyEmail@selectByCompany");
Request::route("empresa/relacao/segmento/", "Site.ServicesCompanySegment@selectByCompany");
Request::route("empresa/logo/", "Site.ServicesCompany@logo");
Request::route("empresa/capa/", "Site.ServicesCompany@cover");
Request::route("empresa/galeria/", "Site.ServicesCompanyGallery@selectBycCompany");
Request::route("empresa/social/", "Site.ServicesCompanySocialNetwork@selectByView");
Request::route("empresa/regiao/", "Site.ServicesCompanyRegion@selectByCompany");
Request::route("empresa/destaque/", "Site.Company.ServicesFeatured@selectByRegion");
Request::route("empresa/select2/", "Site.ServicesCompany@select2");

// SISTEMA -------------------------------------------------------------------------------------------------------------

Request::route("sistema/redesocial/", "Site.ServicesSystemSocialNetwork@selectOrderByName");

// NOTICIAS ------------------------------------------------------------------------------------------------------------
Request::route("noticia/", "Site.ServicesNews@single");
Request::route("noticia/manchete/", "Site.ServicesPanel@featured");
Request::route("noticia/por-categoria/", "Site.ServicesNews@selectByCategory");
Request::route("noticia/painel/", "Site.ServicesPanel@content");
Request::route("noticia/painel/show/", "Site.ServicesPanel@show");
Request::route("noticia/categoria/por-nome/", "Site.ServicesNewsCategory@byName");
Request::route("noticia/tag/por-categoria/", "Site.ServicesNewsTag@byCategory");

/// ANUCIOS -----------------------------------------------------------------------------------------------------------

Request::route("anuncio/(local)/(view)/", "Site.ServicesAds@show");
Request::route("anuncio/(local)/(view)/(url)/", "Site.ServicesAds@show");

// REGIÔES -------------------------------------------------------------------------------------------------------------

Request::route("regiao/select2/", "Site.ServicesGeoRegion@select2");

// JORNAL IMPRESSO----------------------------------------------------------------------------------------------------

Request::route("impresso/todos/", "Site.ServicesNewspaper@featAll");
Request::route("impresso/paginas/", "Site.ServicesNewspaper@allPagesByNewspaper");
Request::route("impresso/pagina/", "Site.ServicesNewspaper@Page");
Request::route("regiao/sub/", "Site.ServicesGeoRegion@selectSubRegionByRegion");
Request::route("regiao/level/select2/", "Site.ServicesGeoRegion@searchLevel");

//============================================= </SITE> ===============================================================


//============================================= <ADMIN> ================================================================

// ANUCIOS ------------------------------------------------------------------------------------------------------------

Request::route("admin/anuncio/pesquisar/", "Admin.ServicesAds@search");
Request::route("admin/anuncio/empresa/", "Admin.ServicesAds@company");
Request::route("admin/anuncio/company/", "Admin.ServicesCompany@searchForAds");

// EMPRESAS ------------------------------------------------------------------------------------------------------------

Request::route("admin/empresa/pesquisar/", "Admin.ServicesCompany@search");

// NOTICIAS ------------------------------------------------------------------------------------------------------------

Request::route("admin/noticia/capa/", "Admin.ServicesNews@cover");
Request::route("admin/noticia/pesquisar/", "Admin.ServicesNews@search");
Request::route("admin/noticia/select2/", "Admin.ServicesNews@selectTwo");
Request::route("admin/noticia/imagem/conteudo/", "Admin.ServicesNewsContentImg@selectByUser");

// EVENTOS -------------------------------------------------------------------------------------------------------------

Request::route("admin/evento/capa/(event_id)/", "Admin.ServicesEvent@cover");
Request::route("admin/evento/pesquisar/", "Admin.ServicesEvent@search");
Request::route("admin/evento/galeria/(event_id)/", "Admin.ServicesEventGallery@byEvent");
Request::route("admin/evento/galeria/", "Admin.ServicesEventGallery@byEvent");

// REGIÕES --------------------------------------------------------------------------------------------------------------

Request::route("admin/regiao/pesquisar/", "Admin.ServicesGeoRegion@search");
Request::route("admin/regiao/parent/", "Admin.ServicesGeoParent@loadTable");
Request::route("admin/regiao/select2/level/", "Admin.ServicesGeoRegion@searchLowLevel");

Request::route("admin/regiao/select2/permissao/(permission)/", "Admin.ServicesGeoRegionPermission@searchRegion");


// JORNAL IMPRESSO----------------------------------------------------------------------------------------------------

Request::route("admin/impresso/paginas/", "Admin.ServicesNewspaperPage@selectAllPagesByNewspaper");
Request::route("admin/impresso/pesquisar/", "Admin.ServicesNewspaper@search");


// USUARIO --------------------------------------------------------------------------------------------------------------------

Request::route("admin/usuario/permissao/regiao/", "Admin.ServicesGeoRegionPermission@selectPermissionByUser");

//============================================= </ADMIN> ===============================================================
