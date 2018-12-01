$(function () {

    $.ajax({
        url: "/services/regiao/sub/",
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


});