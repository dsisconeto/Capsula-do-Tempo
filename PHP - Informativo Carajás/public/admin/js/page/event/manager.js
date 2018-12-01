/**
 * Created by Dejair Sisconeto on 15/06/2016.
 */


$(function () {
    CKEDITOR.replace('event_description');
    $("#event_category_id").select2();


    $("#geo_region_id_city").select2({
        ajax: {
            url: "/services/regiao/level/select2/",
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

        minimumInputLength: 1,


    });

    $("#geo_region_id").select2({
        ajax: {
            url: "/services/admin/regiao/select2/permissao/event/",
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
            , error: function (data) {

                console.log(data);
            }
        },

        minimumInputLength: 1,

    });

    $("#form_event").ajaxForm({
        beforeSerialize: function(form, options) {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
        },
        beforeSubmit: function (formData, jqForm, options) {
            console.log(formData);
            Megaic.form.blockForm("#form_event");

        },
       dataType: "json",
        success: function (data) {

            if (data[0].boolean) {

                Megaic.alert.notify(true, data[0].msg);

                Megaic.location("/admin/evento/capa/" + data[0].data, 2000);

            } else {
                Megaic.alert.notify(true, Megaic.form.returnError(data));

            }

            Megaic.form.desBlockForm("#form_event");
        }, error: function (data) {
            Megaic.form.desBlockForm("#form_event");
            Megaic.ajax.error(data);

        }
    });


});