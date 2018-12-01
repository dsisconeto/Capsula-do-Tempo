{extends file="../template.tpl"}

{block name="css" prepend}

    <link href="/dist_admin/css/page/event-gallery-upload.css" rel="stylesheet">
{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
    <script src="/vendor/jquery-multi-upload/canvas-to-blob.min.js"></script>
    <script src="/vendor/jquery-multi-upload/resize.js"></script>
    <script src="/dist_admin/js/obj/Event.js"></script>
    <script src="/dist_admin/js/page/event/managerGallery.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Upload de Galleria - <b>{$eventName} /{$eventId} </b>
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

                                <a href="/admin/evento/capa/{$eventId}/"
                                   class="btn btn-info">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i> Upload da Capa
                                </a>

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

                                <button class="btn btn-danger" onclick="deleteAllGallery({$eventId});">
                                    Deletar Todas as Fotos
                                </button>

                            </div>


                        </div><!-- /.box-header -->
                        <div class="box-body pad">

                            <form role="form" id="form_event_gallery" method="post"
                                  action="/form/admin/evento/galeria/upload/" enctype="multipart/form-data">
                                <div class="row">

                                    <input type="hidden" value="{$eventId}" name="event_id" id="event_id">

                                    <div class="form-group col-md-12">

                                        <div class="progress">
                                            <div id="event_gallery_progresso"
                                                 class="progress-bar progress-bar-success"
                                                 role="progressbar"
                                                 aria-valuenow="0"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width: 0%;"></div>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12">

                                        <label for="event_cover">Capa do Evento: Proporção 1x1</label>

                                        <span type="button" class="btn btn-primary form-control">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i> Selecione a Imagem
                                        </span>

                                        <input type="file" name="event_gallery_file" class="form-control"
                                               id="event_gallery_file"
                                               style=" cursor: pointer; z-index:2; position: absolute; right: 0; top: 24px;   opacity: 0;"
                                               required="required" multiple="multiple">
                                    </div>


                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                            Enviar
                                        </button>
                                    </div>


                                </div>

                            </form>

                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <ul id="list_gallery">

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div><!-- /.box -->

                    </div><!-- /.col-->
                </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}
