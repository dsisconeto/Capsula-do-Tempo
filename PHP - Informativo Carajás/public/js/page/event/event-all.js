/**
 * Created by Dejair Sisconeto on 22/06/2016.
 */

var page = 1;
var loading = 1;


function loadAllEvents() {


    if (loading) {
        loading = 0;
        $(".loading").show(0);
        var url = "/services/evento/pagina/" + page;
        $.ajax({
            url: url,
            dataType: "json",
            success: function (data) {
                if (data.boolean) {
                    var html = $("#events-all").html();

                    $.each(data.items, function (i, obj) {
                        html += '<div class="col-md-3 col-sm-4">'
                            + '<a href="' + obj.system_url_url + '" class="card-event">'
                            + '<img src="/img/event_cover/sm/' + obj.event_cover + '" class="img-responsive">'
                            + '<div class="card-event-text">'
                            + obj.event_name + "<br><small>" + obj.geo_region_name + "</small>"
                            + '</div>'
                            + '</a>'
                            + '</div>';
                    });

                    $("#events-all").html(html);
                    loading = 1;
                    page++;
                    $(".loading").hide(0);

                } else {
                    console.log("Error ao carregar eventos");
                    $(".loading").hide(0);

                }
            },
            error: function (date) {
                console.log("Error ao carregar eventos");
                $(".loading").hide(0);

            }


        });


    }
}


$(window).scroll(function () {
    var windowsTop = $(window).scrollTop();
    var newsWall = $("#events").height() + $("#events-all").height() - 650;
    console.log(windowsTop + ">=" + newsWall);
    if (windowsTop >= newsWall) {
        loadAllEvents();
    }
});

$(function () {
    loadAllEvents();

});