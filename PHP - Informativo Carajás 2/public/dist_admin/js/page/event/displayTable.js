function deleteEvent(eventId) {

    if (confirm("Tem certeza que deseja deletar ?")) {
        $.ajax({
            data: {event_id: eventId},
            url: "/form/admin/evento/deletar/",
            type: "post",
            dataType: "json",
            success: function (data) {
                if (data[0].boolean) {
                    $("#tr_event_id_" + eventId).hide(400);
                } else {
                    alert(data[0].msg);
                }
            }, error: Megaic.ajax.error
        });
    }
}

var optinos = {
    dataType: "json",
    success: function (data) {
        console.log(data);

        var html = "Sem Resultados";
        if (data.boolean) {
            $.each(data.items.items, function (i, obj) {
                html += "<tr id='tr_event_id_" + obj.event_id + "'>";
                html += "<td>" + obj.event_id + "</td>";
                html += "<td>" + obj.event_name + "</td>";

                if (obj.event_cover) {
                    html += "<td><img style='max-width: 150px' src='/img/event_cover/xs/" + obj.event_cover + "' class='img-responsive'></td>";
                } else {
                    html += "<td>Sem Imagem</td>";
                }
                html += "<td><a target='_blank' href='/" + obj.system_url_url + "'>" + obj.system_url_url + "</a></td>";

                html += "<td><div class='btn-group btn-group-xs'>";

                html += "<a class='btn btn-info' href='/admin/evento/editar/" + obj.event_id + "/'>Editar</a>";
                html += "<a class='btn btn-info' href='/admin/evento/capa/" + obj.event_id + "/'>Capa</a>";
                html += "<a class='btn btn-info' href='/admin/evento/galeria/" + obj.event_id + "/'>Galerria</a>";


                if (obj.event_status == "1") {
                    html += "<button class='btn btn-primary' onclick='Event.updateStatus(" + obj.event_id + ",3,this)'>Públicar</button>";
                } else {
                    html += "<button class='btn btn-primary' onclick='Event.updateStatus(" + obj.event_id + ",1, this)'>Despublicar</button>";
                }
                html += "<button class='btn btn-danger' onclick='deleteEvent(" + obj.event_id + ")'>Deletar</button>";
                html += "</div></td>";
                html += "</tr>";

            });
            var page = $("#page").val();
            var pagination = Megaic.html.pagination(page, data.items.pageNumber);
            $("#pagination").html(pagination);
            $("#list_event").html(html);
        } else {
            $("#list_event").html(html);
            $("#pagination").html("");
        }
    }, error: Megaic.ajax.error
};
function pageFlip(page) {
    $("#page").val(page);
    $("#form_search_event").ajaxSubmit(optinos);
}
$(function () {
    $("#form_search_event").submit(function (event) {
        $("#page").val(1);
    });
    $("#form_search_event").ajaxForm(optinos);
    $("#form_search_event").ajaxSubmit(optinos);
});
