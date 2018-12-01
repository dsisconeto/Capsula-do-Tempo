{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Todos seus usuários
        </h1>


    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-header">

                        <div class="btn-group  btn-group-sm pull-left">
                            <a href="/usuario/cadastrar/" class="btn btn-info">
                                <i class="fa fa-plus" aria-hidden="true"></i> Novo Usuário
                            </a>
                        </div>
                        <!-- tools box -->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body pad">

                        <table class="table table-bordered">
                            <thead>
                            <th>Id:</th>
                            <th>Nome:</th>
                            <th>Email:</th>
                            <th>Emoções:</th>
                            </thead>

                            <tbody>
                            {foreach from=$usersAll item=key}
                                <tr>
                                    <td>{$key.system_user_id}</td>
                                    <td>{$key.system_user_name}</td>
                                    <td>{$key.system_user_email}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a class="btn btn-info" href="/usuario/editar/{$key.system_user_id}/"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                            <a class="btn btn-info" href="/usuario/foto/{$key.system_user_id}/"><i class="fa fa-picture-o" aria-hidden="true"></i> Foto</a>
                                            <a class="btn btn-info" href="/usuario/regiao/permissao/{$key.system_user_id}/"> Permissões por Cidade</a>
                                        </div>
                                    </td>

                                </tr>
                            {/foreach}
                            </tbody>
                        </table>


                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>



<script src="/public/vendor/jqueryform/jquery.form.min.js"></script>
<!-- script de configuração da pagina -->


{include "../footer.tpl"}
