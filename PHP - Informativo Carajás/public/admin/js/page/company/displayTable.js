var seacrhOptions;
function pageFlip(page) {
  $("#page").val(page);
  loadTable();

}
$(function () {
  seacrhOptions = {
    dataType: "json",
    success: function (data) {
      var html = "Sem Resultados";
      console.log(data);
      if (data.boolean) {
        $.each(data.items.items, function (i, obj) {
          html += '<tr>' +
            '<td>' + obj.company_id + '</td>' +
            '<td>' + obj.company_fantasy_name + '</td>';
          if (obj.company_logo) {

            html += '<td><img src="/img/company_logo/xs/' + obj.company_logo + '" class="img-responsive"></td>';
          } else {
            html += '<td>Sem Imagem</td>';
          }
          html += '<td>' + obj.company_address + '</td>' +
            '<td><a href="/' + obj.system_url_url + '">' + obj.system_url_url + '</a></td>' +
            '<td><div class="btn-group btn-group-xs">'
            + '<a  target="_blank" href="/admin/empresa/editar/' + obj.company_id + '/" class="btn btn-info">Editar</a>'
            + '<a  target="_blank" href="/admin/empresa/adicionais/' + obj.company_id + '/" class="btn btn-info">Adicionais</a>';

          if (obj.company_status == "1") {

            html += '<button onclick="Company.updateStatus(' + obj.company_id + ', 0, this, loadTable)" class="btn btn-danger">'
              + '<i class="fa fa-times" aria-hidden="true"></i> Desativar'
              + '</button>';

          } else {
            html += '<button onclick="Company.updateStatus(' + obj.company_id + ', 1, this, loadTable)" class="btn btn-success">'
              + '<i class="fa fa-check" aria-hidden="true"></i> Ativar'
              + '</button>';
          }
          html += '</div>' +
            '</td>' +
            '</tr>';
        });
        var page = $("#page").val();
        var pagination = Megaic.html.pagination(page, data.items.pageNumber);
        $("#pagination").html(pagination);
        $("#list_company").html(html);


      } else {
        $("#list_company").html(html);
        $("#pagination").html("");
      }

    }, error: Megaic.ajax.error

  };


  loadTable();

  $("#form_search_company").submit(function (event) {
    $("#page").val(1);
  });

  $("#form_search_company").ajaxForm(seacrhOptions);

});

function loadTable() {
  $("#form_search_company").ajaxSubmit(seacrhOptions);
}
