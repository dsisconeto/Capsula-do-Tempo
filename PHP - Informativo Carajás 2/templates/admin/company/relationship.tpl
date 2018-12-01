{extends file="../template.tpl"}
{block name="css" prepend}
    <link rel="stylesheet" href="/dist_admin/css/page/company-featured.css">
    <link rel="stylesheet" href="/vendor/select2/select2.min.css">
{/block}

{block name="script" prepend}
    <script src="/vendor/select2/select2.min.js"></script>
    <script src="/vendor/jqueryform/jquery.form.min.js"></script>
    <script src="/vendor/jquery-multi-upload/canvas-to-blob.min.js"></script>
    <script src="/vendor/jquery-multi-upload/resize.js"></script>
    <!-- script de configuração da pagina -->
    <script>
        const companyId = {$companyId};
    </script>
    <script src="/js/obj/Megaic.js"></script>
    <script src="/dist_admin/js/page/company/relationship.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Adicionar Complementos
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h2 class="box-title">Cadastrar Departamentos:</h2>
                        </div><!-- /.box-header -->

                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_department" method="post"
                                          action="/form/admin/empresa/departamento/cadastrar/">

                                        <div class="row">
                                            <input type="hidden" value="{$companyId}" name="company_id" id="company_id">

                                            <div class="form-group col-md-12">
                                                <label for="company_department_name">Nome do Departamento:</label>
                                                <input type="text" class="form-control" name="company_department_name"
                                                       id="company_department_name" placeholder="Nome do Departamento"
                                                       autocomplete="off" required="required">

                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Departamento:</th>
                                            <th>Ações:</th>
                                        </tr>
                                        </thead>

                                        <tbody id="table_department">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h2 class="box-title"> Cadastrar Telefones: </h2>
                        </div><!-- /.box-header -->

                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_phones" method="post"
                                          action="/form/admin/empresa/telefone/cadastrar/">
                                        <div class="row">


                                            <div class="form-group col-md-12">
                                                <label>Departamento:</label>
                                                <select class="form-control company_department_id"
                                                        id="company_department_id"
                                                        name="company_department_id" required="required">
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label>DD:</label>
                                                <input type="text" class="form-control" placeholder="XX"
                                                       id="company_phone_dd"
                                                       name="company_phone_dd" maxlength="2" autocomplete="off"
                                                       required="required">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label>Fone:</label>
                                                <input type="text" class="form-control"
                                                       placeholder="xxxxxxxx ou xxxxxxxxx"
                                                       id="company_phone"
                                                       name="company_phone" maxlength="9" autocomplete="off"
                                                       required="required">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label>Tipo de Telefone:</label>
                                                <select class="form-control" id="company_phone_type"
                                                        name="company_phone_type"
                                                        required="required">
                                                    <option value="">-- Selecione o tipo --</option>
                                                    <option value="1">Fixo</option>
                                                    <option value="2">Celular</option>
                                                </select>


                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Fone:</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>

                                        <tbody id="table_phone">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h2 class="box-title"> Cadastrar Email:</h2>
                        </div><!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_email" method="post"
                                          action="/form/admin/empresa/email/cadastrar/">
                                        <div class="row">

                                            <div class="form-group col-md-12">
                                                <label for="company_department_id">Departamento:</label>
                                                <select class="form-control company_department_id"
                                                        id="company_department_id"
                                                        name="company_department_id" required="required">
                                                </select>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label for="company_email">Email:</label>
                                                <input type="text" class="form-control" placeholder="Email"
                                                       id="company_email"
                                                       name="company_email" autocomplete="off" required="required">
                                            </div>


                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Email:</th>
                                            <th>Ações:</th>
                                        </tr>
                                        </thead>

                                        <tbody id="table_email">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->

                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h2 class="box-title">Relacionar Segmento:</h2>
                        </div><!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_segment" method="post"
                                          action="/form/admin/empresa/segmento/cadastrar/relacao/">
                                        <div class="row">
                                            <input type="hidden" value="{$companyId}" name="company_id"
                                                   id="company_id">

                                            <div class="form-group col-md-12">
                                                <label for="company_segment_id">Selecione o Segmento</label>
                                                <select id="company_segment_id" class="form-control"
                                                        required="required"
                                                        name="company_segment_id">
                                                    <option value="">-- Selecione o Segmento --</option>
                                                    {foreach from=$companySegmentAll item=key}
                                                        <option value="{$key.company_segment_id}">{$key.company_segment_name}</option>
                                                    {/foreach}
                                                </select>

                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nome do Segmento</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>

                                        <tbody id="table_segment">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h2 class="box-title">Cadastrar Redes Sociais:</h2>
                        </div><!-- /.box-header -->

                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_social_network" method="post"
                                          action="/form/admin/empresa/redesocial/cadastrar/">
                                        <div class="row">

                                            <input type="hidden" required='required' value="{$companyId}"
                                                   name="company_id"
                                                   id="company_id">

                                            <div class="form-group col-md-12">
                                                <label for="system_social_network_id"> Selecione a Rede:</label>
                                                <select id="system_social_network_id" class="form-control"
                                                        name="system_social_network_id"
                                                        required="required">
                                                </select>

                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="company_social_network_link"> URL completa:</label>
                                                <input type="text" id="company_social_network_link"
                                                       autocomplete="off"
                                                       class="form-control" name="company_social_network_link"
                                                       required="required">
                                            </div>


                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                    Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Rede:</th>
                                            <th>Ações:</th>
                                        </tr>
                                        </thead>

                                        <tbody id="table_company_social">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h2 class="box-title">Relação com Região</h2>
                        </div><!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">

                                <div class="col-md-6">
                                    <form role="form" id="form_company_relationship_geo_region" method="post"
                                          action="/form/admin/empresa/regiao/cadastrar/">
                                        <div class="row">

                                            <input type="hidden" value="{$companyId}" name="company_id"
                                                   id="company_id">

                                            <div class="form-group col-md-12">
                                                <label for="geo_region_id"> Região:</label>
                                                <select id="geo_region_id" class="form-control"
                                                        name="geo_region_id"
                                                        required="required">
                                                </select>

                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                    Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nome do Segmento</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>

                                        <tbody id="table_geo_region">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h2 class="box-title"> Upload do Logo::</h2>
                        </div><!-- /.box-header -->


                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_logo" method="post"
                                          action="/form/admin/empresa/logo/cadastrar/">
                                        <div class="row">

                                            <input type="hidden" value="{$companyId}"
                                                   name="company_id" id="company_id">

                                            <div class="form-group col-md-12">
                                                <label for="company_logo">Logo 200x112:</label>
                                                <input type="file" name="company_logo"
                                                       id="company_logo" class="form-control">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit"
                                                        class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o"
                                                       aria-hidden="true"></i> Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Imagem:</th>

                                        </tr>
                                        </thead>

                                        <tbody id="table_company_logo">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">


                        <div class="box-header with-border">
                            <h2 class="box-title"> Upload da Capa:</h2>
                        </div><!-- /.box-header -->

                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_cover" method="post"
                                          action="/form/admin/empresa/capa/cadastrar/">
                                        <div class="row">

                                            <input type="hidden" value="{$companyId}"
                                                   name="company_id" id="company_id">

                                            <div class="form-group col-md-12">
                                                <label for="company_cover">Capa
                                                    1200x355:</label>
                                                <input type="file" name="company_cover"
                                                       id="company_cover"
                                                       class="form-control">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit"
                                                        class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o"
                                                       aria-hidden="true"></i> Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Imagem:</th>

                                        </tr>
                                        </thead>

                                        <tbody id="table_company_cover">
                                        <tr>
                                            <td colspan="2">
                                                <img src="/img/loader.gif" class="center-block">
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h2 class="box-title"> Upload Imagem para galeria:</h2>
                        </div><!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_company_gallery"
                                          method="post"
                                          action="/form/admin/empresa/galeria/cadastrar/">

                                        <input type="hidden" value="{$companyId}"
                                               name="company_id" id="company_id">

                                        <div class="row">

                                            <div class="form-group col-md-12">
                                                <div class="progress">
                                                    <div id="company_gallery_progresso"
                                                         class="progress-bar progress-bar-success"
                                                         role="progressbar"
                                                         aria-valuenow="0"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: 0%;"></div>
                                                </div>
                                                <label for="company_gallery">Imagem(Pode
                                                    Enviar multiplas imagens):</label>
                                                <input type="file"
                                                       name="company_gallery_file"
                                                       id="company_gallery_file"
                                                       class="form-control"
                                                       required="required"
                                                       multiple="multiple"
                                                       accept="image/*">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit"
                                                        class="btn btn-primary pull-right">
                                                    <i class="fa fa-paper-plane-o"
                                                       aria-hidden="true"></i> Enviar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Imagem:</th>

                                        </tr>
                                        </thead>

                                        <tbody id="table_company_gallery">

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <hr>


                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div>
            </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}