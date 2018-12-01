/**
 * Created by dejai on 18/08/2016.
 */





$(function () {

    $.ajax({
        url: HOST + "services/regiao/sub/",
        cache: true,
        data: {geo_region_id: 6002},
        type: "get",
        dataType: "json",
        success: function (data) {
            var html = "";

            html += "<option value=''>Selecione sua Cidade</option>";

            if (data.boolean) {


                $.each(data.items, function (i, obj) {
                    html += "<option value='" + obj.geo_region_id + "'>" + obj.geo_region_name + "</option>";


                });

                html += "<option value='6002'>Outra Cidade</option>";
                $("#geo_region_id").html(html);
                $("#geo_region_id").select2();

            }
        }, error: Megaic.ajax.error


    });

    $("#form_region").ajaxForm({
        dataType: "json",
        success: function (data) {

            if (data[0].boolean) {

                if (conti) {

                    Megaic.location(conti, 1000);

                } else {

                    Megaic.location("/", 1000);
                }

                Megaic.alert.notify(true, data[0].msg);

            } else {
                Megaic.alert.notify(false, data[0].msg);


            }
        }, error: Megaic.ajax.error

    });


});