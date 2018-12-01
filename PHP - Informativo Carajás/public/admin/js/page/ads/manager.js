/**
 * Created by dejair on 05/05/16.
 */
$(function ($) {

    $('.date').datepicker({
        autoclose: true,
        language: 'pt-BR',
        format: 'dd/mm/yyyy'

    });


    Ads.managerForm("#form_ads_manager");


    $("#select_region").select2(
        {
            ajax: {
                url: "/services/admin/regiao/select2/permissao/ads/",
                dataType: 'json',
                type:"get",
                delay: 250,
                error: function (data) {
                    console.log(data);
                },
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

            minimumInputLength: 1,

        }
    );


    $("#select_company").select2({
        ajax: {
            url: "/services/admin/anuncio/company/",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
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