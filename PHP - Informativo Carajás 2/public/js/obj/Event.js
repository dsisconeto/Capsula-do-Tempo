var Event = {


    Single: {
        gallery: null,
        page: 1,
        loading: 1,
        countAds: 1,
        eventId: null,
        mountGallery: function () {

            if (Event.Single.gallery && Event.Single.loading) {

                Event.Single.loading = 0;
                $(".loading-gallery").css("display", "block");
                var html = $("#links").html();
                var k = 0;
                var i;
                var obj;


                for (i = 0; i < Event.Single.gallery.length; i++) {

                    if (Event.Single.gallery[i] && k < 4) {

                        obj = Event.Single.gallery[i];

                        html += '<div class="col-md-3">'
                            + '<div class="event-gallery-card">'
                            + '<a  href="/img/event_gallery/lg/' + obj.event_gallery_file + '"  class="link-gallery">'
                            + '<img src="/img/event_gallery/xs/' + obj.event_gallery_file + '" class="img-responsive">'
                            + '</a>'
                            + '<div class="event-gallery-card-text">'
                            + '<a href="/services/evento/galeria/foto/download/?file=' + obj.event_gallery_file + '" target="_blank" class="btn btn-primary"><i class="fa fa-cloud-download" aria-hidden="true"></i>'
                            + ' Baixar'
                            + '</a>'
                            + "<a onclick=\"window.open('https://www.facebook.com/sharer/sharer.php?u=" + Site.URL + "?photo=" + obj.event_gallery_id + "', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');\" class=\"btn btn-primary\"><i class=\"fa fa-share-alt-square\" aria-hidden=\"true\"></i>"
                            + ' Compartilhar'
                            + '</a>'
                            + '</div>'
                            + '</div>'
                            + '</div>';
                        k++;
                        Event.Single.gallery[i] = null;
                    }

                }


                for (i = 0; i < Event.Single.gallery.length; i++) {
                    if (Event.Single.gallery[i]) break;
                }

                if (i >= Event.Single.gallery.length) {

                    Event.Single.gallery = null;

                }


                if (Event.Single.countAds >= 2) {

                    Event.Single.loadAdsGallery();
                    Event.Single.countAds = 1;

                }
                else Event.Single.countAds++;

                $(".loading-gallery").css("display", "none");
                $("#links").html(html);


                    Event.Single.loading = 1;

            }


        }, loadAdsGallery: function () {
            var url;

            if (Site.IS_MOBILE) {
                url = '/services/anuncio/1/json/?url=' + Site.URL;
            } else {
                url = '/services/anuncio/2/json/?url=' + Site.URL;
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


    }


};



