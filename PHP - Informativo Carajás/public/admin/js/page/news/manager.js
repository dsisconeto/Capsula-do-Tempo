/**
 * Created by dejair on 14/04/16.
 */


var enviar = 0;

function loadTags() {

    var url = "/services/admin/noticia/tag/";
    var newCategoryId = $("#select_category").val();
    $.ajax({
        url: url,
        dataType: "json",
        data: {news_category_id: newCategoryId},
        success: function (data) {
            if (data.boolean) {
                var html = "<option value=''>-- Selecione a Tag --</option>";
                $.each(data.items, function (i, obj) {

                    html += "<option value='" + obj.news_tag_id + "'>" + obj.news_tag_name + "</option>";

                });
                $("#select_tag").html(html);
            }

        }, error: Megaic.ajax.error


    });
}


$(function () {
    /* iniciando o editor de post*/
    CKEDITOR.replace('news_post');

    $("#select_tag").select2();

    $("#select_local").select2().change(function () {
        var url = "/services/admin/noticia/local/";
        var newsLocalId = $(this).val();
        $.ajax({
            url: url,
            dataType: "json",
            data: {news_local_id: newsLocalId},
            success: function (data) {
                if (data.boolean) {
                    $("#news_order").attr("max", data.items.news_local_count_max);
                    $("#news_order").val(1);
                }

            }, error: function () {
                alert("Erro Ao carregar Order");
            }


        });
    });

    $("#select_category").select2().change(function () {
        loadTags();
    });


    $("#select_region").select2({
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

        minimumInputLength: 1

    });


    // add tag
    NewsTag.register("#form_add_tag", function () {
        loadTags();
        $("#news_tag_name").val("");
        $('#myModal').modal('hide');
    });

    $("#btn_modal_news_tag").click(function () {

        if ($("#select_category").val()) {

            $("#modal_news_category_id").val($("#select_category").val());
            $('#myModal').modal('show')
        } else {

            Megaic.alert.notify(2, "Selecione a categoria primeiro!");


        }

    });


    $("#form_news_post").ajaxForm({
        beforeSerialize: function(form, options) {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
        },
        beforeSubmit: function (formData) {
            console.log(formData);
            Megaic.form.blockForm("#form_news_post");

        },
        dataType: "json",
        success: function (data) {

            if (data[0].boolean) {

                Megaic.alert.notify(true, data[0].msg);


                setTimeout(function () {
                    var newsId = 0;

                    if ($("#news_id").length) {

                        newsId = $("#news_id").val();
                    } else {

                        newsId = data[0].data;

                    }

                    window.location.href = "/admin/noticia/capa/" + newsId + "/";

                }, 2000);

            } else {


                Megaic.alert.notify(false, Megaic.form.returnError(data));

            }

            Megaic.form.desBlockForm("#form_news_post");

        }, error: Megaic.ajax.error

    });


})
;

