<?php

use DSisconeto\Simple\Request;


Request::route("cidade/escolher/", "Site.FormGeoRegion@sentCookie");


//============================================== ADMIN =================================================================

// #EMPRESAS ------------------------------------------------------------------------------------------------------------


Request::route("admin/empresa/status/", "Admin.FormCompany@updateStatus");
Request::route("admin/empresa/cadastrar/completo/", "Admin.FormCompany@registerComplete");
Request::route("admin/empresa/editar/completo/", "Admin.FormCompany@editComplete");

Request::route("admin/empresa/cadastrar/simples/", "Admin.FormCompany@registerSimple");
Request::route("admin/empresa/editar/simples/", "Admin.FormCompany@editSimple");


Request::route("admin/empresa/departamento/cadastrar/", "Admin.FormCompanyDepartment@register");
Request::route("admin/empresa/departamento/deletar/", "Admin.FormCompanyDepartment@delete");

Request::route("admin/empresa/telefone/cadastrar/", "Admin.FormCompanyPhone@register");
Request::route("admin/empresa/telefone/deletar/", "Admin.FormCompanyPhone@delete");

Request::route("admin/empresa/email/cadastrar/", "Admin.FormCompanyEmail@register");
Request::route("admin/empresa/email/deletar/", "Admin.FormCompanyEmail@delete");


Request::route("admin/empresa/segmento/cadastrar/relacao/", "Admin.FormCompanySegment@relationshipWithCompany");
Request::route("admin/empresa/segmento/deletar/relacao/", "Admin.FormCompanySegment@deleteRelationshipWithCompany");

Request::route("admin/empresa/redesocial/cadastrar/", "Admin.FormCompanySocialNetwork@register");
Request::route("admin/empresa/redesocial/deletar/", "Admin.FormCompanySocialNetwork@delete");

Request::route("admin/empresa/capa/cadastrar/", "Admin.FormCompany@uploadCover");
Request::route("admin/empresa/logo/cadastrar/", "Admin.FormCompany@uploadLogo");
Request::route("admin/empresa/galeria/cadastrar/", "Admin.FormCompanyGallery@register");
Request::route("admin/empresa/galeria/deletar/", "Admin.FormCompanyGallery@delete");

Request::route("admin/empresa/destaque/cadastrar/", "Admin.FormCompanyFeatured@register");
Request::route("admin/empresa/destaque/ordenar/", "Admin.FormCompanyFeatured@serializeOrder");
Request::route("admin/empresa/destaque/deletar/", "Admin.FormCompanyFeatured@delete");


Request::route("admin/empresa/regiao/cadastrar/", "Admin.FormCompanyRegion@register");
Request::route("admin/empresa/regiao/deletar/", "Admin.FormCompanyRegion@delete");


// #REGIÃO --------------------------------------------------------------------------------------------------------------
Request::route("admin/regiao/relacao/cadastrar/", "Admin.FormGeoRegionParent@register");
Request::route("admin/regiao/relacao/deletar/", "Admin.FormGeoRegionParent@delete");
Request::route("admin/regiao/relacao/configuracao/", "Admin.FormSystemConfigGeoRegion@manager");


// #EVENTO -------------------------------------------------------------------------------------------------------------

Request::route("admin/evento/cadastrar/", "Admin.FormEvent@register");
Request::route("admin/evento/editar/", "Admin.FormEvent@edit");
Request::route("admin/evento/deletar/", "Admin.FormEvent@delete");
Request::route("admin/evento/status/", "Admin.FormEvent@editStatus");
Request::route("admin/evento/capa/", "Admin.FormEvent@uploadCover");
Request::route("admin/evento/galeria/deletar/todas/", "Admin.FormEventGallery@deleteAll");
Request::route("admin/evento/galeria/deletar/", "Admin.FormEventGallery@delete");
Request::route("admin/evento/galeria/upload/", "Admin.FormEventGallery@upload");
Request::route("admin/evento/galeria/serializar/", "Admin.FormEventGallery@serializeOrder");
Request::route("admin/evento/galeria/shared/", "Admin.FormEventGallery@loadShard");


// #NOTICIA ------------------------------------------------------------------------------------------------------------


Request::route("admin/noticia/deletar/", "Admin.FormNews@delete");
Request::route("admin/noticia/status/", "Admin.FormNews@updateStatus");
Request::route("admin/noticia/cadastrar/", "Admin.FormNews@register");
Request::route("admin/noticia/editar/", "Admin.FormNews@edit");
Request::route("admin/noticia/capa/", "Admin.FormNews@editCover");
Request::route("admin/noticia/imagem/conteudo/upload/", "Admin.FormNewsContentImg@register");

Request::route("admin/noticia/tag/cadastrar/", "Admin.FormNewsTag@register");
Request::route("admin/noticia/tag/editar/nome/", "Admin.FormNewsTag@editName");
Request::route("admin/noticia/tag/deletar/", "Admin.FormNewsTag@delete");
Request::route("admin/noticia/painel/alterar/", "Admin.FormNewsPanel@manager");

// #Jornal Impresso ----------------------------------------------------------------------------------------------------

Request::route("admin/impresso/cadastrar/", "Admin.FormNewspaper@register");
Request::route("admin/impresso/editar/", "Admin.FormNewspaper@edit");
Request::route("admin/impresso/deletar/", "Admin.FormNewspaper@delete");
Request::route("admin/impresso/status/", "Admin.FormNewspaper@editStatus");
Request::route("admin/impresso/paginas/upload/", "Admin.FormNewspaperPage@upload");
Request::route("admin/impresso/paginas/ordena/", "Admin.FormNewspaperPage@serializeOrder");
Request::route("admin/impresso/paginas/deletar/", "Admin.FormNewspaperPage@delete");
// #Imagem -------------------------------------------------------------------------------------------------------------

Request::route("admin/imagem/upload/temp/", "Admin.FormSystemImg@croppicTempUpload");
Request::route("admin/imagem/upload/croppic/", "Admin.FormSystemImg@croppic");

// #ANUNCIO ------------------------------------------------------------------------------------------------------------


Request::route("admin/anuncio/registrar/", "Admin.FormAds@register");
Request::route("admin/anuncio/editar/", "Admin.FormAds@edit");

Request::route("admin/anuncio/deletar/", "Admin.FormAds@delete");
Request::route("admin/anuncio/status/", "Admin.FormAds@editStatus");


// USUARIO -------------------------------------------------------------------------------------------------------------


Request::route("usuario/cadastrar/", "Admin.FormSystemUser@register");
Request::route("usuario/editar/", "Admin.FormSystemUser@edit");

Request::route("usuario/foto/cadastrar/", "Admin.FormSystemUser@editPhoto");

Request::route("usuario/permissao/regiao/", "Admin.FormGeoRegionUserPermission@manager");


//Request::route("company-email/enviar/", "FormCompanyEmail@sentEmailToCompany");

Request::route("login/", "Admin.FormLogin@login");
Request::route("login/validar/", "Admin.FormLogin@validate");
