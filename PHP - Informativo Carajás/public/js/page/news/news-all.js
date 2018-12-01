/**
 * Created by Dejair Sisconeto on 22/05/2016.
 */


$(function () {


    $(".news-category-btn").click(function (event) {
        event.preventDefault();
        if ($("#collapseOne").hasClass("in")) {
            $('#news-manchete ').animateCss('bounceOut');
            $("#collapseOne").removeClass("in");
        }

    });

    if (newsCategoryId) {
        requestNews();
        loadNewsByCategory(newsCategoryId, true);
    } else {

        lastNews();
    }
});


$(window).scroll(function () {

    var windowsTop = $(window).scrollTop();
    var newsWall = $("#news-wall").height() + $("#news-manchete").height() - 450;

    if (windowsTop >= newsWall) {
        if (loading == 1) {
            loading = 0;
            requestNews();
        }

    }
});

function requestNews() {

    var url = "/services/noticia/news-all-paginate/";
    $(".news-wall-loading").css("display", "table");
    $.ajax({
        url: url,
        data: {news_category_id: newsCategoryId, page: page, limit_by_page: limitByPage, skip: skip},
        dataType: "json",
        success: function (data) {
            var html = $("#news-wall").html();

            if (data.boolean) {

                $(".news-category-btn").removeClass("active");
                $("#btn_news_category_" + newsCategoryId).addClass("active");


                $.each(data.items, function (i, obj) {

                    html += '<div class="col-md-4"><a href="' + obj.system_url_url + '"  class="box-news box-news-md margin-bottom-20">'
                        + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/xs/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                        + '<div class="box-news-text">'
                        + '<p>'
                        + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                        + obj.news_title
                        + '</p>'
                        + '</div>'
                        + '</a></div>   ';


                });

                $("#news-wall").html(html);
                loadAds();
                $("#news-wall").css("display", "block");

                loading = 1;
                page++;
            }
            else {

            }


        }, error: function (data) {

        }


    });

    return true;
}


function loadAds() {

    var url;

    if (isMobile) {
        url = '/services/anuncio/1/json/?url='+metaUrl;
    } else {
        url = '/services/anuncio/2/json/?url='+metaUrl;
    }
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        success: function (data) {
            var html = $("#news-wall").html();
            html += '<div class="col-md-12">'
                + '<div class="ads">'
                + data.ads_content
                + '</div>'
                + '</div>';
            $("#news-wall").html(html);

        }
    });


}