{extends file="../template.tpl"}

{block name="css" prepend}

{/block}

{block name="script" prepend}
    <script src="/dist_admin/js/page/ads/company.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Anúncios da Empresa: {$companyName} <b></b>
            </h1>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">

                        <div class="box-header">


                            <div class="row">
                                <div class="col-md-12">
                                    <a href="anuncio/cadastrar/{$companyId}/" class="btn btn-primary"> <i
                                                class="fa fa-bullhorn" aria-hidden="true"></i> Novo</a>
                                </div>
                            </div>
                            <input name="company_id" id="company_id" value="{$companyId}" type="hidden">
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body pad">

                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Imagem do Anuncio:
                                    </th>
                                    <th class="col-md-1">
                                        Local de Exibição:
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

                                <tbody id="tbody_ads"></tbody>
                            </table>
                            <!-- /.box -->
                        </div><!-- /.col-->
                    </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}
