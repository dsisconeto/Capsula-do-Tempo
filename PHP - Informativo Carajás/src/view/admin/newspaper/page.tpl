{include "../header.tpl"}
{include "../siderbar.tpl"}
<link href="/admin/css/page/newspaper/page.css" rel="stylesheet">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cadastrar páginas do jornal de {$geoRegionName}, {$newspaperEdition}° Edição
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-header">

                        <div class="btn-group  btn-group-sm pull-left">
                            <a href="/admin/impresso/todos/" class="btn btn-info">
                                Todos Jornais
                            </a>
                            <a href="/admin/impresso/editar/{$newspaperId}/" class="btn btn-info">
                                Editar Jornal
                            </a>
                        </div>


                        <!-- tools box -->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body pad">


                        <form role="form" id="form_newspaper_manager" method="post"
                              autocomplete="off" action="/form/admin/impresso/paginas/upload/">

                            <input type="hidden" name="newspaper_id" value="{$newspaperId}" id="newspaper_id">

                            <div class="form-group col-md-12">
                                <div class="progress">
                                    <div id="progress"
                                         class="progress-bar progress-bar-success"
                                         role="progressbar"
                                         aria-valuenow="0"
                                         aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 0%;"></div>
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="file" class="form-control" name="newspaper_page_file"
                                       id="newspaper_page_file" required="required" multiple="multiple">
                            </div>


                            <div class="form-group col-md-12">
                                <button class="btn btn-primary pull-right" type="submit">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar
                                </button>
                            </div>
                        </form>

                        <div class="col-md-12 pages" id="pages">


                        </div>


                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>

<script src="/vendor/jquery-multi-upload/canvas-to-blob.min.js"></script>
<script src="/vendor/jquery-multi-upload/resize.js"></script>

<!-- script de configuração da pagina -->
<script src="/admin/js/page/newspaper/page.js"></script>

{include "../footer.tpl"}

