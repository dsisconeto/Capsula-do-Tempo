function loadTable() {

    var url = "/services/admin/anuncio/empresa/";
    var companyId = $("#company_id").val();

    $.ajax({
        url: url,
        dataType: "json",
        delay: 1000,
        data: {company_id: companyId},
        success: function (data) {
            if (data.boolean) {
                var html = "";
                $.each(data.items, function (i, obj) {
                    html += '<tr id="tr_' + obj.ads_id + '">'
                        + '<th>' + obj.ads_id + '</th>'
                        + '<td> <img src="/img/ads_banner/sm/' + obj.ads_file + '" class="img-responsive"> </td>'
                        + '<td>' + obj.ads_local_name + '</td>'
                        + '<td> <a href="' + obj.ads_link + '" title="' + obj.ads_link + '" target="_blank">Clique Paravero Link</a></td>'
                        + '<td>' + obj.geo_region + '</td>'
                        + '<td>De ' + obj.ads_start_display + ' <br>Até ' + obj.ads_end_display + ' </td>'
                        + '<td> Inserido: ' + obj.ads_date_insert + '<br> Atualizado:' + obj.ads_date_update + '</td>'
                        + '<td>'
                        + '<div class="btn-group btn-group-sm">'
                        + '<a href="/admin/anuncio/editar/' + obj.ads_id + '/" class="btn btn-primary">Editar</a>';
                    if (obj.ads_status == "1") {
                        html += '<button class="btn btn-warning" onclick="disableAds(\'' + obj.ads_id + '\')">Desativar </button>';
                    } else {
                        html += '<button class="btn btn-success" onclick="activeAds(\'' + obj.ads_id + '\')">Ativar </button>';
                    }

                    html += '<button class="btn btn-danger" onclick="deleteAds(\'' + obj.ads_id + '\')">Deletar</button>'
                        + '</div> </td>'
                        + '</tr>';
                });


                $("#tbody_ads").html(html);
            }
        },
        error: Megaic.ajax.error
    });


}


/**
 * Created by dejair on 07/05/16.
 */

function deleteAds(adsId) {

    var conf = prompt("Digite DELETAR");

    if (conf == "DELETAR") {

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

                    loadTable();
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


                    loadTable();
                }

            },
            error: Megaic.ajax.error


        });
    }


}

$(function () {

    loadTable();

});

