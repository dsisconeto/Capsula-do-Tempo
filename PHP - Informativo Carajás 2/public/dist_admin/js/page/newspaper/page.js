$(function () {

    var data = {newspaper_id: $("#newspaper_id").val()};
    Megaic.form.imgMultiUpload.send("#form_newspaper_manager", "#newspaper_page_file", 1000, "#progress", data, loadPages);

    loadPages();


    $('#pages').sortable({

        update: function (event, ui) {
            var data = $(this).sortable('serialize');

            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'post',
                url: "/form/admin/impresso/paginas/ordena/",
                dataType: "text",
                success: function (data) {
                    console.log(data);
                }, error: function (data) {
                    console.log(data);
                }
            });
        }

    });

});

function loadPages() {

    $.ajax({
        url: "/services/admin/impresso/paginas/",
        data: {newspaper_id: $("#newspaper_id").val()},
        dataType: "json",
        type: "get",
        success: function (data) {
            var html = "";

            if (data.boolean) {


                $.each(data.items, function (i, obj) {

                    html += "<div class='page' id='page_" + obj.newspaper_page_id + "'>"

                    html += "<img src='/img/newspaper_page/sm/" + obj.newspaper_page_file + "' class='img-responsive center block'>"

                    html += "<dib class='page-footer'>";
                    html += "Página " + obj.newspaper_page_number + "°";

                    html += "<br><button class='btn btn-danger center-block' onclick='deletePage(" + obj.newspaper_page_id + ")'>Deletar</button>";

                    html += "</div>";


                    html += "</div>";


                });


            } else {

                html = "Este Jornal não nenhuma página";
            }

            $("#pages").html(html);


        }, error: Megaic.ajax.error


    });


}


function deletePage(id) {



        $.ajax({
            url: "/form/admin/impresso/paginas/deletar/",
            data: {newspaper_page_id: id},
            dataType: "json",
            type: "post",
            success: function (data) {
                console.log(data);
                if (data[0].boolean) {
                    loadPages();

                }

            }, error: Megaic.ajax.error
        });




}