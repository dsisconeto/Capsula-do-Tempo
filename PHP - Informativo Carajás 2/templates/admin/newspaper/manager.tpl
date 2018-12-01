
{extends file="../template"}

{block name="css" prepend}

{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryform/jquery.form.min.js"></script>
    <script src="/vendor/select2/select2.min.js"></script>
    <!-- script de configuração da pagina -->
    <script src="/dist_admin/js/page/newspaper/manager.js"></script>
{/block}

{block name="content" prepend}

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {if $edit}
                    Editar Jornal Impresso
                {else}
                    Cadastrar Jornal Impresso
                {/if}
            </h1>


        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">

                        <div class="box-header">

                            <div class="btn-group  btn-group-sm pull-left">
                                <a href="/impresso/todos/" class="btn btn-info">
                                    Todos Jornais
                                </a>

                                {if $edit}
                                    <a href="/impresso/paginas/{$newspaperId}/" class="btn btn-info">
                                        Páginas
                                    </a>
                                {/if}
                            </div>
                            <!-- tools box -->
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body pad">


                            <form role="form" id="form_newspaper_manager" method="post"
                                  action="/form/impresso/{if $edit}editar{else}cadastrar{/if}/" autocomplete="off">
                                {if $edit}
                                    <input type="hidden" name="newspaper_id" value="{$newspaperId}">
                                {/if}


                                <div class="col-md-12 form-group">
                                    <label for="newspaper_description">Descrição:</label>
                                    <textarea class="form-control" name="newspaper_description"
                                              id="newspaper_description" required="required"
                                              minlength="5">{if isset($newspaperDescription)}{$newspaperDescription}{/if}</textarea>
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="newspaper_publication_date">Data de Publicação:</label>
                                    <input type="date" class="form-control" name="newspaper_publication_date"
                                           id="newspaper_publication_date" required="required"
                                           value="{if isset($newspaperPublicationDate)}{$newspaperPublicationDate}{/if}">
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="newspaper_number_of_pages">Número de Páginas:</label>
                                    <input type="number" class="form-control" min="4" name="newspaper_number_of_pages"
                                           id="newspaper_number_of_pages" required="required"
                                           value="{if isset($newspaperNumberOfPages)}{$newspaperNumberOfPages}{/if}">
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="newspaper_drawing">Tiragem:</label>
                                    <input type="number" class="form-control" min="1" name="newspaper_drawing"
                                           id="newspaper_drawing" required="required"
                                           value="{if isset($newspaperDrawing)}{$newspaperDrawing}{/if}">
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="newspaper_edition">Edição:</label>
                                    <input type="number" class="form-control" min="1" name="newspaper_edition"
                                           id="newspaper_edition" required="required"
                                           value="{if isset($newspaperEdition)}{$newspaperEdition}{/if}">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="geo_region_id">Região</label>
                                    <select class="form-control" name="geo_region_id" id="geo_region_id"
                                            required="required">
                                        {if $edit}
                                            <option value="{$geoRegionId}">{$geoRegionName}</option>
                                        {/if}


                                    </select>


                                </div>


                                <div class="form-group col-md-12">
                                    <button class="btn btn-primary pull-right">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div><!-- /.box -->

                </div><!-- /.col-->
            </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}