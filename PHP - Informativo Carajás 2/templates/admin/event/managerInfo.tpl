{extends file="../template.tpl"}

{block name="css" prepend}
    <link href="/vendor/select2/select2.min.css" rel="stylesheet">
{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryform/jquery.form.min.js"></script>
    <script src="/vendor/ckeditor/ckeditor.js"></script>
    <script src="/vendor/select2/select2.min.js"></script>
    <!-- script de configuração da pagina -->
    <script src="/dist_admin/js/obj/Event.js"></script>
    <script src="/dist_admin/js/page/event/manager.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {if $edit}
                    Editar Evento
                {else}
                    Cadastrar Evento
                {/if}
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
                            {if $edit}
                                <div class="btn-group btn-group-sm pull-right">

                                    <a href="/admin/evento/capa/{$eventId}"
                                       class="btn btn-info">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i> Upload da Capa
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
                            {/if}
                        </div>

                        <div class="box-body pad">
                            <form role="form" id="form_event" method="post"
                                  action="/form/admin/evento/{if $edit}editar{else}cadastrar{/if}">
                                <div class="row">
                                    {if $edit}
                                        <input type="hidden" value="{$eventId}" name="event_id" id="event_id">
                                    {/if}

                                    <div class="form-group col-md-12">
                                        <label for="event_name">Nome do Evento:</label>
                                        <input type="text" class="form-control" name="event_name" id="event_name"
                                               placeholder="Nome do Evento" required="required" value="{$eventName}"
                                               minlength="2" maxlength="150">
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="event_local">Onde vai acontecer o evento?:</label>
                                        <input type="text" class="form-control" name="event_local" id="event_local"
                                               placeholder="Local do Evento" required="required" minlength="2"
                                               maxlength="50"
                                               value="{$eventLocal}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="event_address">Endereço:</label>
                                        <input type="text" class="form-control" name="event_address" id="event_address"
                                               placeholder="Endereço do Evento" required="required" minlength="2"
                                               maxlength="300" value="{$eventAddress}">
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="geo_region_id_city">Cidade do Evento:</label>

                                        <select class="form-control" id="geo_region_id_city" name="geo_region_id_city"
                                                required="required">
                                            {if isset($geo_region_id_city)}
                                                <option value="{$geo_region_id_city}"
                                                        selected="selected">{$geo_region_name_city}</option>
                                            {/if}

                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="event_date">Data e Hora:</label>
                                        <input type="datetime-local" class="form-control" name="event_date"
                                               id="event_date"
                                               value="{if isset($eventDate)}{$eventDate}{/if}"
                                               required="required">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="event_category_id">Selecione uma categoria:</label>
                                        <select class="form-control" name="event_category_id" id="event_category_id"
                                                required="required">
                                            {if $edit}
                                                <option value="{$eventCategoryId}">{$eventCategoryName}</option>
                                                {foreach from=$eventCategoryAll item=key}
                                                    {if $eventCategoryId != $key.event_category_id}
                                                        <option value="{$key.event_category_id}">{$key.event_category_name}</option>
                                                    {/if}

                                                {/foreach}

                                            {else}
                                                <option value="">-- Selecione a Categoria --</option>
                                                {foreach from=$eventCategoryAll item=key}
                                                    <option value="{$key.event_category_id}">{$key.event_category_name}</option>
                                                {/foreach}
                                            {/if}

                                        </select>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="event_address_maps">Embed do Google Maps:</label>
                                        <input type="text" class="form-control" name="event_address_maps"
                                               id="event_address_maps"
                                               placeholder="URL Google Maps" minlength="2"
                                               maxlength="500"
                                               value='{if $edit && $eventAddressMaps}<iframe src="https://www.google.com/maps/embed?pb={$eventAddressMaps}" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>{/if}'>
                                    </div>

                                    {if !$geoRegionId}
                                        <div class="form-group col-md-6">
                                            <label for="geo_region_id">Selecione uma Região:</label>
                                            <select class="form-control" name="geo_region_id[]" id="geo_region_id"
                                                    required="required" multiple="multiple">
                                                {if $edit && $geoRegionAll}
                                                    {foreach from=$geoRegionAll item=key}
                                                        <option value="{$key.geo_region_id}"
                                                                selected="selected">{$key.geo_region_name}</option>
                                                    {/foreach}
                                                {/if}
                                            </select>
                                        </div>
                                    {else}
                                        <input type="hidden" value="{$geoRegionId}" name="geo_region_id[]">
                                    {/if}

                                    <div class="form-group col-md-12 text-center">

                                        <label class="radio-inline">
                                            <input type="radio" name="event_roof" id="inlineRadio1"
                                                   {if $edit && $eventRoof == 1}checked{/if} value="1"> Vai ter
                                            cobertura
                                            de fotos
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="event_roof" id="inlineRadio2"
                                                   {if $edit && $eventRoof == 0}checked{/if} value="0"> Não vai ter
                                            cobertura de fotos
                                        </label>

                                    </div>


                                    <div class="form-group col-md-12">
                                        <label for="event_description">Descrição:</label>
                                        <textarea name="event_description" id="event_description"
                                                  required="required">{$eventDescription}</textarea>
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
                    </div><!-- /.box -->

                </div><!-- /.col-->
            </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}


