{extends file="../template.tpl"}

{block name="css" prepend}
    <link rel="stylesheet" href="/vendor/croppic/css/croppic.css">
{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryform/jquery.form.min.js"></script>
    <script src="/vendor/croppic/js/croppic.min.js"></script>
    <!-- script de configuração da pagina -->
    <script src="/dist_admin/js/obj/Event.js"></script>
    <script src="/dist_admin/js/page/event/managerCover.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Capa do Evento <b>{$eventName} - {$eventId}</b>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <div class="btn-group  btn-group-sm pull-left">
                                <a href="/admin/evento/todos/" class="btn btn-info">
                                    <i class="fa fa-list" aria-hidden="true"></i> Todos os Eventos
                                </a>
                            </div>

                            <div class="btn-group btn-group-sm pull-right">

                                <a href="/admin/evento/editar/{$eventId}" class="btn btn-info">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> Editar Informações
                                </a>


                                {if $eventRoof}
                                    <a href="/admin/evento/galeria/{$eventId}/" class="btn btn-info">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i> Upload de Galeria
                                    </a>
                                {/if}

                                {if $eventStatus == 1}
                                    <button onclick="Event.updateStatus({$eventId}, 3, this)"
                                            class="btn btn-primary"
                                            id="btn_event_status">
                                        Públicar
                                    </button>
                                {else}
                                    <button onclick="Event.updateStatus({$eventId}, 1, this)"
                                            class="btn btn-primary"
                                            id="btn_event_status">
                                        Despublicar
                                    </button>
                                {/if}
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-12"
                                     style="{if !$eventCover}display: none{/if}">
                                    <h2 class="text-center">Capa Atual.</h2>
                                    <img src="/img/event_cover/lg/{if $eventCover}/{$eventCover}{/if}"
                                         class="img-responsive center-block" id="news_cover_file">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <h2 class="text-center">Upload de Imagem de Capa</h2>
                                    <div id="show_cover"
                                         style="margin: 0 auto; width:1000px; height: 1000px; position:relative; border:solid 1px #CCCCCC;"
                                         class="center-block">
                                    </div>

                                </div>

                            </div>
                            <hr>
                            <form role="form" id="form_event_cover" method="post"
                                  action="/form/admin/evento/capa/">
                                <input type="hidden" name="event_cover" id="event_cover" required="required">
                                <input type="hidden" name="event_id" value="{$eventId}" required="required">
                            </form>


                        </div>
                    </div><!-- /.box -->

                </div><!-- /.col-->
            </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}