{extends file="../template.tpl"}

{block name="css" prepend}

{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
    <!-- script de configuração da pagina -->
    <script src="/js/obj/Megaic.js"></script>
    <script src="/dist_admin/js/obj/Company.js"></script>
    <scrit >
    <script src="/dist_admin/js/page/company/displayTable.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Empresas Cadastradas
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body pad">
                            <div class="row">

                                <form role="form" id="form_search_company"
                                      action="/services/admin/empresa/pesquisar/" method="get">
                                    <input type="hidden" name="page" value="1" id="page">
                                    <input type="hidden" name="limit_by_page" value="10">

                                    <div class="form-group col-md-3">
                                        <label for="company_search_arg">Nome da empresa ou segmento:</label>
                                        <input type="text" name="company_search_arg"
                                               placeholder="Digite nome ou segmento"
                                               id="company_search_arg" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="company_status">Filtrar por Status:</label>
                                        <select name="company_status" id="company_status" class="form-control">
                                            <option value="3">Todas</option>
                                            <option value="1">Ativadas</option>
                                            <option value="0">Desativadas</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="order_by">Ordena Por:</label>
                                        <select name="order_by" id="order" class="form-control">
                                            <option value="0">Data de Cadastrado</option>
                                            <option value="1">Nome</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="order">Ordem:</label>
                                        <select name="order" id="order" class="form-control">
                                            <option value="desc">Decrescente</option>
                                            <option value="asc">Crescente</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-12">

                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-search" aria-hidden="true"></i> Pesquisar
                                        </button>

                                    </div>
                                </form>
                            </div>


                            <nav aria-label="Page navigation">
                                <ul class="pagination" id="pagination">
                                </ul>
                            </nav>


                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID:</th>
                                    <th>Nome da Empresa:</th>
                                    <th>Logo:</th>
                                    <th>Url:</th>
                                    <th>Anúncio:</th>
                                    <th class="col-md-2">Ações:</th>
                                </tr>
                                </thead>

                                <tbody id="list_company">
                                </tbody>
                            </table>

                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}

