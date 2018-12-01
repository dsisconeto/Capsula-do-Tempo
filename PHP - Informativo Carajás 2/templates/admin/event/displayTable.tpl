{extends file="../template.tpl"}

{block name="css" prepend}

{/block}

{block name="script" prepend}
  <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
  <script src="/vendor/select2/select2.min.js"></script>
  <!-- script de configuração da pagina -->
  <script src="/js/obj/Megaic.js"></script>
  <script src="/dist_admin/js/obj/Event.js"></script>
  <script src="/dist_admin/js/page/event/displayTable.js"></script>

{/block}

{block name="content" prepend}

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Eventos</h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-body pad">
              <div class="row">
                <form role="form" id="form_search_event" method="get" action="/services/admin/evento/pesquisar/">
                  <input type="hidden" value="1" name="page" id="page">
                  <input type="hidden" value="10" name="limit_by_page">

                  <div class="form-group col-md-3">
                    <label for="event_name">Nome do Evento:</label>
                    <input type="text" name="event_name" placeholder="Nome do Evento"
                           id="event_name" class="form-control">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="event_status">Status:</label>
                    <select class="form-control" id="event_status" name="event_status">
                      <option value="3">Públicados</option>
                      <option value="0">Todos</option>
                      <option value="1">Salvos</option>
                      <option value="2">Em Analise</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="order_by">Ordena por:</label>
                    <select class="form-control" id="order_by" name="order_by">
                      <option value="2">Data de Inserção</option>
                      <option value="3">Data de Atualização</option>
                      <option value="0">Nome do Evento</option>
                      <option value="1">Data do Evento</option>


                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="order">Ordena:</label>
                    <select class="form-control" id="order" name="order">
                      <option value="0">Decrecente</option>
                      <option value="1">Crecente</option>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <a href="/admin/evento/cadastrar/"
                       class="btn btn-info pull-left">
                      <i class="fa fa-plus" aria-hidden="true"></i> Novo Evento
                    </a>

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
                  <th class="col-md-2">Nome do Evento:</th>
                  <th>Capa:</th>
                  <th>Url:</th>
                  <th class="col-md-3">Ações:</th>
                </tr>
                </thead>
                <tbody id="list_event">
                </tbody>
              </table>
            </div><!-- /.box -->
          </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
  </div>
{/block}