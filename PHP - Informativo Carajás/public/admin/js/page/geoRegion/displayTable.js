/**
 * Created by dejai on 23/08/2016.
 */

$(document).ready(function () {


    loadTableBySearch("#form_search_region", "#tbody_geo_region");


});


function loadTableBySearch(form, tbody) {

    var success = function (data) {


        if (data.boolean) {
            var html = "";

            $.each(data.items, function (i, obj) {

                html += "<tr id='geo_" + obj.geo_region_id + "'>" +
                    "<td>" + obj.geo_region_id + "</td>" +
                    "<td>" + obj.geo_region_name + "</td>";


                html += "<td>";
                if (obj.geo_region_level > 1 && obj.geo_region_level < 4) {

                    html += "<a href='/admin/regiao/relacoes/" + obj.geo_region_id + "/' class='btn btn-info'><i class='fa fa-plus' aria-hidden='true'></i> Adicionar Região</a></td>";
                }

                html += "<a href='/admin/regiao/configurar/" + obj.geo_region_id + "/' class='btn btn-info'> <i class='fa fa-cog' aria-hidden='true'></i> Configurar Região</a></td>";


                html += "</tr>";


            });

            $(tbody).html(html);

        } else {

            $(tbody).html("<tr><td>Ainda não foi adicionada região.</td></tr>");
        }

    };

    var options = {
        dataType: "json",
        success: success,
        error: Megaic.ajax.error
    };

    $(form).ajaxForm(options);


}

