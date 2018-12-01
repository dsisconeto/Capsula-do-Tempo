<?php


DjRouter::router("login/", "admin.AdminFormLogin@login");

DjRouter::router("cidade/escolher/", "FormGeoRegion@sentCookie");


DjRouter::router("company-email/enviar/", "FormCompanyEmail@sentEmailToCompany");


//======================================================================================================================
//============================================== ADMIN =================================================================

// #EMPRESAS ------------------------------------------------------------------------------------------------------------


DjRouter::router("admin/empresa/status/", "admin.AdminFormCompany@updateStatus");
DjRouter::router("admin/empresa/cadastrar/completo/", "admin.AdminFormCompany@registerComplete");
DjRouter::router("admin/empresa/editar/completo/", "admin.AdminFormCompany@editComplete");

DjRouter::router("admin/empresa/cadastrar/simples/", "admin.AdminFormCompany@registerSimple");
DjRouter::router("admin/empresa/editar/simples/", "admin.AdminFormCompany@editSimple");


DjRouter::router("admin/empresa/departamento/cadastrar/", "admin.AdminFormCompanyDepartment@register");
DjRouter::router("admin/empresa/departamento/deletar/", "admin.AdminFormCompanyDepartment@delete");

DjRouter::router("admin/empresa/telefone/cadastrar/", "admin.AdminFormCompanyPhone@register");
DjRouter::router("admin/empresa/telefone/deletar/", "admin.AdminFormCompanyPhone@delete");

DjRouter::router("admin/empresa/email/cadastrar/", "admin.AdminFormCompanyEmail@register");
DjRouter::router("admin/empresa/email/deletar/", "admin.AdminFormCompanyEmail@delete");


DjRouter::router("admin/empresa/segmento/cadastrar/relacao/", "admin.AdminFormCompanySegment@relationshipWithCompany");
DjRouter::router("admin/empresa/segmento/deletar/relacao/", "admin.AdminFormCompanySegment@deleteRelationshipWithCompany");

DjRouter::router("admin/empresa/redesocial/cadastrar/", "admin.AdminFormCompanySocialNetwork@register");
DjRouter::router("admin/empresa/redesocial/deletar/", "admin.AdminFormCompanySocialNetwork@delete");

DjRouter::router("admin/empresa/capa/cadastrar/", "admin.AdminFormCompany@uploadCover");
DjRouter::router("admin/empresa/logo/cadastrar/", "admin.AdminFormCompany@uploadLogo");
DjRouter::router("admin/empresa/galeria/cadastrar/", "admin.AdminFormCompanyGallery@register");
DjRouter::router("admin/empresa/galeria/deletar/", "admin.AdminFormCompanyGallery@delete");

DjRouter::router("admin/empresa/destaque/cadastrar/", "admin.AdminFormCompanyFeatured@register");
DjRouter::router("admin/empresa/destaque/ordenar/", "admin.AdminFormCompanyFeatured@serializeOrder");
DjRouter::router("admin/empresa/destaque/deletar/", "admin.AdminFormCompanyFeatured@delete");


DjRouter::router("admin/empresa/regiao/cadastrar/", "admin.AdminFormCompanyRegion@register");
DjRouter::router("admin/empresa/regiao/deletar/", "admin.AdminFormCompanyRegion@delete");


// #REGIÃO --------------------------------------------------------------------------------------------------------------
DjRouter::router("admin/regiao/relacao/cadastrar/", "admin.AdminFormGeoRegionParent@register");
DjRouter::router("admin/regiao/relacao/deletar/", "admin.AdminFormGeoRegionParent@delete");
DjRouter::router("admin/regiao/relacao/configuracao/", "admin.AdminFormSystemConfigGeoRegion@manager");


// #EVENTO -------------------------------------------------------------------------------------------------------------

DjRouter::router("evento/cadastrar/", "admin.AdminFormEvent@register");
DjRouter::router("evento/editar/", "admin.AdminFormEvent@edit");
DjRouter::router("evento/deletar/", "admin.AdminFormEvent@delete");
DjRouter::router("evento/status/", "admin.AdminFormEvent@editStatus");
DjRouter::router("admin/evento/capa/", "admin.AdminFormEvent@uploadCover");
DjRouter::router("admin/evento/galeria/deletar/todas/", "admin.AdminFormEventGallery@deleteAll");
DjRouter::router("evento/galeria/deletar/", "admin.AdminFormEventGallery@delete");
DjRouter::router("evento/galeria/upload/", "admin.AdminFormEventGallery@upload");
DjRouter::router("evento/galeria/serializar/", "admin.AdminFormEventGallery@serializeOrder");
DjRouter::router("admin/evento/galeria/shared/", "admin.AdminFormEventGallery@loadShard");


// #NOTICIA ------------------------------------------------------------------------------------------------------------


DjRouter::router("admin/noticia/deletar/", "admin.AdminFormNews@delete");
DjRouter::router("admin/noticia/status/", "admin.AdminFormNews@updateStatus");
DjRouter::router("admin/noticia/cadastrar/", "admin.AdminFormNews@register");
DjRouter::router("admin/noticia/editar/", "admin.AdminFormNews@edit");
DjRouter::router("admin/noticia/capa/", "admin.AdminFormNews@editCover");
DjRouter::router("admin/noticia/imagem/conteudo/upload/", "admin.AdminFormNewsContentImg@register");

DjRouter::router("admin/noticia/capa/", "admin.AdminFormNews@editCover");
DjRouter::router("admin/noticia/tag/cadastrar/", "admin.AdminFormNewsTag@register");
DjRouter::router("admin/noticia/tag/editar/nome/", "admin.AdminFormNewsTag@editName");
DjRouter::router("admin/noticia/tag/deletar/", "admin.AdminFormNewsTag@delete");

// #Jornal Impresso ----------------------------------------------------------------------------------------------------

DjRouter::router("admin/impresso/cadastrar/", "admin.AdminFormNewspaper@register");
DjRouter::router("admin/impresso/editar/", "admin.AdminFormNewspaper@edit");
DjRouter::router("admin/impresso/deletar/", "admin.AdminFormNewspaper@delete");
DjRouter::router("admin/impresso/status/", "admin.AdminFormNewspaper@editStatus");
DjRouter::router("admin/impresso/paginas/upload/", "admin.AdminFormNewspaperPage@upload");
DjRouter::router("admin/impresso/paginas/ordena/", "admin.AdminFormNewspaperPage@serializeOrder");
DjRouter::router("admin/impresso/paginas/deletar/", "admin.AdminFormNewspaperPage@delete");
// #Imagem -------------------------------------------------------------------------------------------------------------

DjRouter::router("admin/imagem/upload/temp/", "admin.AdminFormSystemImg@croppicTempUpload");
DjRouter::router("admin/imagem/upload/croppic/", "admin.AdminFormSystemImg@croppic");

// #ANUNCIO ------------------------------------------------------------------------------------------------------------


DjRouter::router("admin/anuncio/registrar/", "admin.AdminFormAds@register");
DjRouter::router("admin/anuncio/editar/", "admin.AdminFormAds@edit");

DjRouter::router("admin/anuncio/deletar/", "admin.AdminFormAds@delete");
DjRouter::router("admin/anuncio/status/", "admin.AdminFormAds@editStatus");


// USUARIO -------------------------------------------------------------------------------------------------------------


DjRouter::router("admin/usuario/cadastrar/", "admin.AdminFormSystemUser@register");
DjRouter::router("admin/usuario/editar/", "admin.AdminFormSystemUser@edit");

DjRouter::router("admin/usuario/foto/cadastrar/", "admin.AdminFormSystemUser@editPhoto");

DjRouter::router("admin/usuario/permissao/regiao/", "admin.AdminFormGeoRegionUserPermission@manager");
