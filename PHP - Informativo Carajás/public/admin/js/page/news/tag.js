/**
 * Created by Dejair Sisconeto on 31/05/2016.
 */




function loadTable() {

    var newsCategoryId = $("#news_category_id").val();
    var url = "/services/admin/noticia/tag/";

    $.ajax({
        data: {news_category_id: newsCategoryId},
        url: url,
        dataType: "json",
        success: function (data) {
            var html = null;
            if (data.boolean) {

                $.each(data.items, function (i, obj) {

                    html += "<tr>"
                        + "<td>" + obj.news_tag_name + "</td>"
                        + "<td>"
                        + "<button class='btn btn-danger' onclick='NewsTag.delete(" + obj.news_tag_id + ", loadTable);'> Deletar</button>"
                        + "</td>"
                        + "</tr>";

                });

                $("#tbody_tags").html(html);


            } else {

                $("#tbody_tags").html("<tr><td>Sem Resultado</td></tr>");
            }


        }, error: function (data) {
            console.log(data);
        }


    });

}

$(function ($) {

    $("#news_category_id").change(function () {
        loadTable();
    });

    NewsTag.register("#form-add-tag", loadTable);

    loadTable();
});