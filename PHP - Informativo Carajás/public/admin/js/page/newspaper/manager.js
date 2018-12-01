/**
 * Created by dsisconeto on 15/09/16.
 */


$(function () {

    $("#geo_region_id").select2({


        ajax: {
            url: "/services/admin/regiao/select2/permissao/newspaper/",
            dataType: 'json',
            delay: 250,
            type:"get",
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


    $("#form_newspaper_manager").ajaxForm({
        dataType: "json",
        success: function (data) {

            if (data[0].boolean) {

                Megaic.alert.notify(true, data[0].msg);
                Megaic.location("/admin/impresso/paginas/" + data[0].data + "/", 3000);

            } else {

                Megaic.alert.notify(false, Megaic.form.returnError(data));

            }


        }, error: Megaic.ajax.error

    });


});