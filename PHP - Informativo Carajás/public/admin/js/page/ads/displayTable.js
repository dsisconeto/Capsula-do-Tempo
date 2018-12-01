/**
 * Created by dejair on 07/05/16.
 */

function deleteAds(adsId) {

    var conf = prompt("Para delatar digite a palavra del mais o número do id do anuncio. Ex: del+24, del+30")

    if (conf == "del+" + adsId) {

        var url = "/form/admin/anuncio/deletar/";
        $.ajax({
            url: url,
            type: "post",
            data: {ads_id: adsId},
            dataType: "json",
            delay: 250,

            success: function (data) {
                data = data[0];
                if (data.boolean) {
                    alert("Deletada com sucesso");
                    $("#tr_" + adsId).hide(500);
                } else {
                    alert("Erro ao deletar");
                }

            },
            error: Megaic.ajax.error


        });

    } else {
        alert("Errou errou feio errou rude.");
    }
}

function activeAds(adsId) {
    var conf = confirm("Tem certeza que deseja ativar ?");

    if (conf) {
        var url = "/form/admin/anuncio/status/";
        $.ajax({
            url: url,
            data: {ads_id: adsId, ads_status: 1},
            dataType: "json",
            type: "post",
            delay: 250,

            success: function (data) {
                data = data[0];
                console.log(data);
                if (data.boolean) {

                    loadTableAds();
                }

            },
            error: Megaic.ajax.error


        });
    }

}

function disableAds(adsId) {
    var conf = confirm("Tem certeza que deseja desativar ?");

    if (conf) {
        var url = "/form/admin/anuncio/status/";
        $.ajax({
            url: url,
            data: {ads_id: adsId, ads_status: 0},
            dataType: "json",
            type: "post",
            delay: 250,

            success: function (data) {
                data = data[0];
                console.log(data);
                if (data.boolean) {


                    loadTableAds();
                }

            },
            error: Megaic.ajax.error


        });
    }


}


function loadTableAds() {

    var filter = $("#filter").val();
    var orderBy = $("#order_by").val();
    var order = $("#order").val();
    var url = "/services/admin/anuncio/pesquisar/";

    $.ajax({
        url: url,
        dataType: "json",
        delay: 1000,
        data: {filter: filter, order_by: orderBy, order: order},
        success: function (data) {


            console.log(data);

            if (data.boolean) {
                var html = "";

                $.each(data.items.items, function (i, obj) {
                    html += '<tr id="tr_' + obj.ads_id + '">'
                        + '<th>' + obj.ads_id + '</th>'
                        + '<td> <h3>' + obj.company_fantasy_name + '</h3> </td>'
                        + '<td> <img src="/img/ads_banner/sm/' + obj.ads_file + '" class="img-responsive"> </td>'
                        + '<td>' + obj.geo_region + '</td>'
                        + '<td> <a href="' + obj.ads_link + '" title="' + obj.ads_link + '" target="_blank">Clique Paravero Link</a></td>'
                        + '<td>De ' + obj.ads_start_display + ' <br>Até ' + obj.ads_end_display + ' </td>'
                        + '<td> Inserido: ' + obj.ads_date_insert + '<br> Atualizado:' + obj.ads_date_update + '</td>'
                        + '<td>'
                        + '<div class="btn-group btn-group-sm">'
                        + '<a href="/admin/anuncio/editar/' + obj.ads_id + '/" target="_blank"class="btn btn-primary">Editar</a>';
                    if (obj.ads_status == "1") {
                        html += '<button class="btn btn-warning" onclick="disableAds(\'' + obj.ads_id + '\')">Desativar </button>';

                    } else {
                        html += '<button class="btn btn-success" onclick="activeAds(\'' + obj.ads_id + '\')">Ativar </button>';


                    }


                    html += '<button class="btn btn-danger" onclick="deleteAds(\'' + obj.ads_id + '\')">Deletar</button>'
                        + '</div> </td>'
                        + '</tr>'
                });


                $("#tbody_ads").html(html);

            }

            $("#status_active").text(data.items.active);

            $("#status_disable").text(data.items.disable);

            $("#status_total").text(data.items.total);

        }, error: Megaic.ajax.error
    });


}


$(function () {

    loadTableAds();
    $("#form_filter").submit(function (e) {
        e.preventDefault();
        loadTableAds();

    });


});