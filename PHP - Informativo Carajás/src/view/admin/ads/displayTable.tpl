{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Anúncios
        </h1>


    </section>

    <section class="content">
        <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check" aria-hidden="true"></i></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ativos</span>
                        <span class="info-box-number" id="status_active"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->


            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-exclamation-circle"
                                                             aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Desativados</span>
                        <span class="info-box-number" id="status_disable"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-circle-o" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total</span>
                        <span class="info-box-number" id="status_total"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->


        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-header">

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body pad">

                        {if isset($msgSuccess)}
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                {$msgSuccess}
                            </div>
                        {/if}

                        {if isset($msgError)}
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                {$msgError}
                            </div>
                        {/if}
                        <div class="row">
                            <form role="form" method="get" id="form_filter" action="{$getHost}panel/ads-on-display/">
                                <input type="hidden" name="page" value="ads-on-display">
                                <div class="form-group col-md-3">
                                    <label for="filter">Filtrar Por:</label>
                                    <select class="form-control" name="filter" id="filter">
                                        <option value="1">Ativos</option>
                                        <option value="0">Desativados</option>
                                    </select>

                                </div>

                                <div class="form-group col-md-3">
                                    <label for="order_by">Order por:</label>
                                    <select class="form-control" name="order_by" id="order_by">
                                        <option value="1">Data de Cadastro</option>
                                        <option value="2">Nome da Empresa</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="order">Ordem:</label>
                                    <select class="form-control" name="order" id="order">
                                        <option value="1">Decrescente</option>
                                        <option value="2">Crescente</option>
                                    </select>
                                </div>


                                <div class=" col-md-9">

                                    <a href="/admin/anuncio/cadastrar/" class="btn btn-info  pull-left ">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        Cadastrar Anúncio
                                    </a>

                                    <button type="submit" class="btn btn-primary  pull-right ">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                        <hr>

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th class="col-md-2">
                                    Nome da Empresa:
                                </th>
                                <th>
                                    Imagem do Anuncio:
                                </th>

                                <th class="col-md-1">
                                    Link do Anuncio:
                                </th>
                                <th class="col-md-1">
                                    Região
                                </th>


                                <th>
                                    Exibição:
                                </th>

                                <th>
                                    Data de Cadastro:
                                </th>

                                <th class="col-md-3">
                                    Ações:
                                </th>
                            </tr>
                            </thead>


                            <tbody id="tbody_ads">

                            </tbody>


                        </table>
                        <!-- /.box -->

                    </div><!-- /.col-->
                </div><!-- ./row -->


    </section><!-- /.content -->


</div>

<script src="/admin/js/page/ads/displayTable.js"></script>
<!-- script de configuração da pagina -->
{include "../footer.tpl"}
