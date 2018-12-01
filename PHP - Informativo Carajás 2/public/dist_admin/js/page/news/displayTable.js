var option = {
    dataType: "json",
    delay: 1000,
    success: function (data) {

        var html = "<tr><td>Sem Resultados</td></tr>";

        if (data.items.count > 0) {

            $.each(data.items.items, function (i, obj) {

                html += '<tr id="tr_' + obj.news_id + '">'
                    + '<th>' + obj.news_id + '</th>'
                    + '<td>' + obj.news_title + '</td>';

                if (obj.news_cover) {

                    html += '<td> <img src="/img/news_cover/xxs/' + obj.news_cover + '" class="img-responsive"> </td>'
                } else {
                    html += '<td> <img src="/img/systemNotFound/newsCover/thumbnails/newsCover.jpg" class="img-responsive"> </td>'
                }

                html += '<td>' + obj.news_category_name + '</td>'
                    + '<td> <a href="/' + obj.system_url_url + '" title="/' + obj.system_url_url + '" target="_blank">Clique Para ver o Link</a></td>'
                    + '<td>' + obj.news_counter_view + '</td>'
                    + '<td> Inserido: ' + obj.news_date_insert + '<br> Atualizado:' + obj.news_date_update + '</td>'
                    + '<td>';

                switch (obj.news_status) {
                    case "1":
                        html += 'Não Públicada';
                        break;
                    case "3":
                        html += 'Públicada';
                        break;
                }

                html += '</td>'

                    + '<td>'
                    + '<div class="btn-group btn-group-xs">';

                html += '<a href="/admin/noticia/editar/' + obj.news_id + '/" target="_blank" class="btn btn-info">Editar</a>';

                if (obj.news_status == "1") {
                    html += "<button class='btn btn-primary' onclick='News.updateStatus(" + obj.news_id + ", 3,reload())'>Públicar</button>";
                } else {
                    html += "<button class='btn btn-primary' onclick='News.updateStatus(" + obj.news_id + ", 1,reload())'>Despublicar</button>";
                }
                html += '<button class="btn btn-danger" onclick="News.delete(' + obj.news_id + ', reload);">Deletar</button>';
            });

        }

        // paginação
        var numPage = data.items.numberPage;  // quantidade de páginda
        var page = $("#page").val();
        var pagination = Megaic.html.pagination(page, numPage);

        $("#pagination").html(pagination);
        $("#tbody_news").html(html);
    }, error: Megaic.ajax.error
};

$(function () {

    $("#form_news_search").submit(function (eve) {
        $("#page").val(1);
    });
    $("#form_news_search").ajaxSubmit(option);
    $("#form_news_search").ajaxForm(option);
});

function reload() {

    $("#form_news_search").ajaxSubmit(option);

}
function pageFlip(page) {

    $("#page").val(page);

    $("#form_news_search").ajaxSubmit(option);

}