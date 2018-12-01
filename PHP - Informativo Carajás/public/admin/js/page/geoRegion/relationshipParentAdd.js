/**
 * Created by dejai on 20/08/2016.
 */



$(function () {


    loadTableByRegionId($("#geo_region_id_parent").val(), "#tbody_geo_region");
    register("#form_region", $("#geo_region_id_parent").val(), "#tbody_geo_region");


    $("#geo_region_id").select2({
        ajax: {
            url: "/services/admin/regiao/select2/level/",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    geo_region_id: $("#geo_region_id_parent").val(),
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },

        minimumInputLength: 1,

    });

});


function register(form, geoRegionId, tbody) {

    var options = {
        dataType: "json",
        resetForm: true,
        success: function (data) {

            Megaic.alert.notify(data[0].boolean, data[0].msg);
            loadTableByRegionId(geoRegionId, tbody);

        }, error: Megaic.ajax.error
    };

    $(form).ajaxForm(options);

}


function loadTableByRegionId(geoRegionId, tbody) {

    var url = "/services/admin/regiao/parent/";
    var data = {geo_region_id: geoRegionId};
    var dataType = "json";

    var success = function (data) {

        if (data.boolean) {
            var html = "";

            $.each(data.items, function (i, obj) {
                html += "<tr id='geo_" + obj.geo_region_id + "'>" +
                    "<td>" + obj.geo_region_id + "</td>" +
                    "<td>" + obj.geo_region_name + "</td>" +
                    "<td><button class='btn btn-danger' onclick='deleteG(" + obj.geo_region_id + ", " + geoRegionId + ", \"geo_\")'>Deletar</button></td>" +
                    "</tr>";


            });
            $(tbody).html(html);

        } else {

            $(tbody).html("<tr><td>Ainda não foi adicionada região.</td></tr>");
        }

    };


    $.ajax({
        url: url,
        data: data,
        dataType: dataType,
        success: success,
        error: Megaic.ajax.error

    });


}


function deleteG(geoRegionId, geoRegionIdParent, pre_id) {


    var url = "/form/admin/regiao/relacao/deletar/";
    var data = {geo_region_id: geoRegionId, geo_region_id_parent: geoRegionIdParent};
    var dataType = "json";

    var success = function (data) {

        if (data[0].boolean) {

            $("#" + pre_id + geoRegionId).hide(500);
        } else {

            Megaic.alert.notify(data[0].boolean, data[0].msg);
        }

    };


    $.ajax({
        url: url,
        data: data,
        type: "post",
        dataType: dataType,
        success: success,
        error: Megaic.ajax.error

    });


}