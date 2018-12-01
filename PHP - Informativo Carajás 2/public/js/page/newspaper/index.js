$(function () {
    carregarEstante();
});




function carregarEstante() {


    $.ajax({
        dataType: "json",
        url: "/services/impresso/todos/",
        success: function (data) {
            var html = "";
            console.log(data);
            if (data.boolean) {

                $.each(data.items, function (i, obj) {


                    html += "<div class='col-md-3 col-sm-4'><a href='/impresso/ler/" + obj.newspaper_id + "/pagina/1/' class='newspaper'>";
                    html += "<img src='/img/newspaper_page/sm/" + obj.newspaper_cover + "' class='img-responsive center-block'>";
                    html += "</a></div>";
                });

            } else {


            }


            $("#newspapers").html(html);
        },
        error: Megaic.ajax.error
    });

}