/**
 * Created by dsisconeto on 21/09/16.
 */


var options = {

    dataType: "json",
    success: function (data) {

        var html = "";
        if (data.boolean) {

            var status = {"1": "Despublicado", "2": "Em analise", "3": "Publicado"};

            $.each(data.items, function (i, obj) {


                html += "<tr>";
                html += "<td>" + obj.newspaper_id + "</td>";
                html += "<td><img src='/img/newspaper_page/sm/" + obj.newspaper_cover + "' class='img-responsive'></td>";
                html += "<td>" + obj.newspaper_description + "</td>";
                html += "<td>" + obj.newspaper_edition + "</td>";
                html += "<td>" + obj.newspaper_drawing + "</td>";
                html += "<td>" + obj.newspaper_publication_date + "</td>";
                html += "<td>" + obj.newspaper_number_of_pages + "</td>";


                html += "<td>" + status[obj.newspaper_status] + "</td>";

                html += "<td><div class='btn-group btn-group-xs'>";
                html += "<a class='btn btn-info' href='/admin/impresso/editar/" + obj.newspaper_id + "/'>Editar</a>";
                html += "<a class='btn btn-info' href='/admin/impresso/paginas/" + obj.newspaper_id + "/'>Páginas</a>";

                if (obj.newspaper_status == "1") {
                    html += "<button class='btn btn-primary' onclick='Newspaper.updateStatus(" + obj.newspaper_id + ", 3, this)'>Públicar</button>";
                } else {
                    html += "<button class='btn btn-primary' onclick='Newspaper.updateStatus(" + obj.newspaper_id + ", 1, this)'>Despublicar</button>";
                }


                html += "<button class='btn btn-danger' onclick='deleteNewspaper(" + obj.newspaper_id + ")'>Deletar</button>";
                html += "</div></td>";

                html += "</tr>";
            })


        } else {
            html = "Ainda Não tem Jornais Cadastrado";
        }


        $("#newspapers").html(html);

    },
    error: Megaic.ajax.error
};


$("#form_newspaper").ajaxForm(options);


function deleteNewspaper(id) {

    $.ajax({
        data: {newspaper_id: id},
        url: "/form/admin/impresso/deletar/",
        dataType: "json",
        type: "post",
        success: function (data) {
            if (data[0].boolean) {

                $("#form_newspaper").ajaxSubmit(options);
            } else {
                Megaic.alert.notify(false, data[0].msg);
            }


        },
        error: Megaic.ajax.error
    });


}
