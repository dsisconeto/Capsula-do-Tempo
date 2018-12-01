var Panel = {
    dataLocal: null,

};


function consetarSelect() {

    $(".select2-container").attr("style", "width:100%");

}

$(function () {

    $("#select_geo_region").select2({
        ajax: {
            url: "/services/admin/regiao/select2/permissao/news/",
            dataType: 'json',
            type: "get",
            delay: 250,
            data: function (params) {
                return {
                    geo_region_name: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
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
        minimumInputLength: 1
    });

    $("#desc").click(function (event) {
        $(this).blur();
        if ($(this).hasClass("btn-danger")) {

            $(this).html('Decrescer <span class="badge">ON</span>');
            $(this).removeClass("btn-danger");
            $(this).addClass("btn-success");

        } else {
            $(this).html('Decrescer <span class="badge">OFF</span>');
            $(this).removeClass("btn-success");
            $(this).addClass("btn-danger");
        }
    });


    $("#select_geo_region").change(function (event) {
        loadTable();
    });


    $("#btn_save").click(function (e) {
        var trava = 1;
        if (trava) {
            trava = 0;
            $("#form_panel").ajaxSubmit({
                dataType: "json",
                delay: 2000,
                success: function (data) {
                    trava = 1;
                    Megaic.alert.notify(data[0].boolean, data[0].msg);

                }, error: Megaic.ajax.error
            });
        }
    });

});


function loadTable() {
    $.ajax({
        url: "/services/noticia/painel/",
        data: {geo_region_id: $("#select_geo_region").val()},
        dataType: "json",
        type: "get",
        success: function (data) {
            $("#geo_region_id").val($("#select_geo_region").val());
            Panel.dataLocal = data;
            formateResult(data);
        }, error: Megaic.ajax.error
    });
}


function formateResult(data) {

    if (data.boolean) {
        var html = "";
        var k = 1;
        $.each(data.items, function (i, obj) {

            html += "<tr>" +
                "<td>Quadro " + defineLocal(k) + "</td>" +
                "<td>" +
                "" +
                "<div class='col-md-12'>" +
                "<select class='form-control select_local'  name='local_" + k + "' >" +
                "<option value='" + obj.news_id + "'>" + obj.news_title + "</option>" +
                "</select>" +
                "</div>" +
                "</td></tr>";

            $("#table_news").html(html);
            k++;
        });


        $(".select_local").change(function (event) {

            if ($("#desc").hasClass("btn-success") && Panel.dataLocal.count === 22) {

                var local = parseInt($(this).attr("name").slice(6));

                for (var i = 21; i >= local; i--) {
                    Panel.dataLocal.items["local_" + (i + 1)] = Panel.dataLocal.items["local_" + i];
                }

            }
            Panel.dataLocal.items["local_" + local] = {
                "news_id": $(this).val(),
                "news_title": $(this).find(":selected").text()
            };
            formateResult(Panel.dataLocal);


        });

        $(".select_local").select2({
            ajax: {
                url: "/services/admin/noticia/select2/",
                dataType: 'json',
                type: "get",
                delay: 250,
                data: function (params) {
                    return {
                        news_title: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {

                    params.page = params.page || 1;

                    return {
                        results: data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },

                cache: true,
            },
            minimumInputLength: 2
        });

        $("#btn_save").css("display", "block");

        consetarSelect();
    }

}

function defineLocal(local) {
    var name = {
        1: "Mega",
        2: "Grande 1",
        3: "Grande 2",
        4: "Medio 1",
        5: "Medio 2",
        6: "Medio 3",
        7: "Pequeno 1",
        8: "Pequeno 2",
        9: "Pequeno 3",
        10: "Pequeno 4",
        11: "Pequeno 5",
        12: "Pequeno 6",
        13: "Pequeno 7",
        14: "Pequeno 8",
        15: "Pequeno 9",
        16: "Pequeno 10",
        17: "Pequeno 11",
        18: "Pequeno 12",
        19: "Pequeno 13",
        20: "Pequeno 14",
        21: "Pequeno 15",
        22: "Pequeno 16",
    };

    return name[local];
}

