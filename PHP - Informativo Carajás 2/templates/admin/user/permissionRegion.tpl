{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Permissões de Usuario por cidade Usuário: {$userName}({$userId})
        </h1>


    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-header">

                        <div class="btn-group  btn-group-sm pull-left">
                            <a href="/usuario/todos/" class="btn btn-info">
                                <i class="fa fa-list" aria-hidden="true"></i> Todos os Usuários
                            </a>
                        </div>
                        <!-- tools box -->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body pad">


                        <form role="form" id="search_region" method="get"
                              action="/services/usuario/permissao/regiao/" autocomplete="off">

                            <input type="hidden" id="system_user_id" value="{$userId}" name="system_user_id">
                            <div class="form-group col-md-12">
                                <label for="geo_region_name">Nome da Cidade:</label>
                                <input type="text" class="form-control" id="geo_region_name" name="geo_region_name">
                            </div>


                            <div class="form-group col-md-12">
                                <button class="btn btn-primary pull-right">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar
                                </button>
                            </div>
                        </form>

                        <hr>


                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    Cidade
                                </th>
                                <th>
                                    Permissões
                                </th>
                            </tr>
                            </thead>
                            <tbody id="table_permission">

                            </tbody>

                        </table>


                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>


<script src="/vendor/jqueryform/jquery.form.min.js"></script>

<script src="/vendor/select2/select2.min.js"></script>

<!-- script de configuração da pagina -->
<script src="/js/page/user/permissionRegion.js"></script>

{include "../footer.tpl"}
