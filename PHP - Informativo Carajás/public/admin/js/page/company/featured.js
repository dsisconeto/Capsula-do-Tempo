$('#list_company').sortable({
    update: function (event, ui) {
        var data = $(this).sortable('serialize');

        // POST to server using $.post or $.ajax
        $.ajax({
            data: data,
            type: 'post',
            dataType: "json",
            url: "/form/admin/empresa/destaque/ordenar/"

        });
    }
});

function deleteRelation(id) {


    var url = "/form/admin/empresa/destaque/deletar/";
    var data = {company_relationship_featured_id: id};
    $.ajax({
        url: url,
        data: data,
        type: "post",
        dataType: "json",
        success: function (data) {

            if (data[0].boolean) {

                $("#relationship-" + id).hide(500);

            } else {


                Megaic.alert.notify(false, data[0].msg);

            }

        }, error: Megaic.ajax.error
    });


}

function loadTable(data) {

    var url = "/services/empresa/destaque/";

    $.ajax({
        url: url,
        data: data,
        dataType: "json",
        delay: 1000,
        success: function (data) {

            var html = "";
            if (data.boolean) {
                $.each(data.items, function (i, obj) {

                    html += '<li id="relationship-' + obj.company_relationship_featured_id + '"  class="company-box">'
                        + '<div class="relation-delete" onclick="deleteRelation(' + obj.company_relationship_featured_id + ')">Deletar</div>'
                        + '<div class="company-box-img">'
                        + '<img src="/img/company_logo/sm/'+obj.company_logo + '" class="img-responsive center-block">'
                        + '</div>'

                        + '<div class="company-box-text">'
                        + '<div class="company-box-title">'
                        + obj.company_fantasy_name
                        + '</div>'
                        + '</div>'

                        + '</li>';


                });

                $("#list_company").html(html);

            } else {
                $("#list_company").html("Nada Encontrado...");
            }


        }, error: Megaic.ajax.error


    });
}


$("#company_featured_search").submit(function (event) {
    event.preventDefault();
    var data = {

        geo_region_id: $("#search_geo_region_id").val(),
        company_featured_id: $("#search_company_featured_id").val()
    };

    loadTable(data);

});


$("#form_company_featured").ajaxForm({

    dataType: "json",
    success: function (data) {
        console.log(data);

        if (data[0].boolean) {
            Megaic.alert.notify(true, data[0].msg);
            data = {
                geo_region_id: $("#geo_region_id").val(),
                company_featured_id: $("#company_featured_id").val()
            };

            loadTable(data);
        } else {

            Megaic.alert.notify(false, Megaic.form.returnError(data));


        }

    }, error: Megaic.ajax.error

});


var searhRegion = {

    ajax: {
        url: "/services/admin/regiao/select2/permissao/company/",
        dataType: 'json',
        delay: 250,
        type:"get",
        data: function (params) {
            return {
                geo_region_level:1,
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
    minimumInputLength: 1,

};




$("#company_id").select2({
    ajax: {
        url: "/services/empresa/select2/",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term, // search term
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
    minimumInputLength: 1,

});
