var page = 1;
var loading = 1

if ($("#links").length) {

    document.getElementById('links').onclick = function (event) {

        event = event || window.event;

        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target;
        if ($(link).hasClass("btn")) {
        } else {

            var options = {index: link, event: event},
                links = this.getElementsByClassName("link-gallery");

            blueimp.Gallery(links, options);
        }

    };

}

document.getElementById('poster').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};


$(window).scroll(function () {
    var windowsTop = $(window).scrollTop();
    var newsWall = $("#links").height() - 450;
    console.log(windowsTop + ">=" + newsWall);
    if (windowsTop >= newsWall) {
        requestGalarry();
    }
});

var countAds = 1;
function requestGalarry() {
    if (loading == 1) {
        loading = 0;
        $(".loading-gallery").css("display", "block");

        var url = "/services/evento/galeria/pagina/";
        $.ajax({
            url: url,
            data: {event_id: eventId, page: page},
            dataType: "json",
            success: function (data) {
                if (data.boolean) {
                    page++;
                    var html = $("#links").html();

                    $.each(data.items, function (i, obj) {
                        html += '<div class="col-md-4">'
                            + '<div class="event-gallery-card">'
                            + '<a  href="/img/event_gallery/lg/' + obj.event_gallery_file + '"  class="link-gallery">'
                            + '<img src="/img/event_gallery/xs/' + obj.event_gallery_file + '" class="img-responsive">'
                            + '</a>'
                            + '<div class="event-gallery-card-text">'
                            + '<a href="/services/evento/galeria/foto/download/?file=' + obj.event_gallery_file + '" target="_blank" class="btn btn-primary"><i class="fa fa-cloud-download" aria-hidden="true"></i>'
                            + ' Baixar'
                            + '</a>'
                            + "<a onclick=\"window.open('https://www.facebook.com/sharer/sharer.php?u="+eventUrl+"?photo=" + obj.event_gallery_id + "', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');\" class=\"btn btn-primary\"><i class=\"fa fa-share-alt-square\" aria-hidden=\"true\"></i>"
                            + ' Compartilhar'
                            + '</a>'
                            + '</div>'
                            + '</div>'
                            + '</div>';

                    });

                    if (countAds >= 2) {
                        loadAdsGallery();
                        countAds = 1;

                    } else {
                        countAds++;
                    }

                    $("#links").html(html)
                    loading = 1;
                    $("#event-roof").hide(0);
                    $(".loading-gallery").css("display", "none");
                } else {
                    $(".loading-gallery").css("display", "none");
                }


            }
            ,
            error: function (data) {
                console.log(data);
            }
        });
    }
}

function loadAdsGallery() {
    var url;

    if (isMobile) {
        url = '/services/anuncio/1/json/?url=' + metaUrl;
    } else {
        url = '/services/anuncio/2/json/?url=' + metaUrl;
    }
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        success: function (data) {
            var html = $("#links").html();
            html += '<div class="col-md-12">'
                + '<div class="ads">'
                + data.ads_content
                + '</div>'
                + '</div>';
            $("#links").html(html);

        }
    });
}


$(function () {

    requestGalarry();
});