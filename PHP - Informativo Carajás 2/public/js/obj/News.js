var News = {
    Manchete: {
        hideLoading: function () {
            $("#news_manchete_loading").hide(500);
            $("#news-manchete").css("display", "block");
            $('#news-manchete ').animateCss('zoomIn');

            if ($("#news-wall").length) {
                $("#news-wall").css("display", "block");
                $("#news-wall").animateCss('bounceInLeft');
            }

        },
        showLoading: function () {
            $("#news_manchete_loading").show(500);
            $("#news-manchete").css("display", "none");

            if ($("#news-wall").length) {
                $("#news-wall").css("display", "none");
            }

        },
        categoryId: null,
        tagId: null,
        setTagId: function (id) {
            News.Manchete.tagId = id;
        },

        setCategoryI: function (id) {

            News.Manchete.categoryId = id;
        }, mountBoxNews: function (obj, i) {

            var style = "";
            var pathImg = "";
            if (i === 1) {
                style = "box-news-lg";
                pathImg = "lg";
            }
            if (i >= 2 && i <= 3) {
                style = "";
                pathImg = "md";
            }

            if (i >= 4 && i <= 6) {
                style = "box-news-md";
                pathImg = "sm";
            }

            if (i >= 7) {
                style = "box-news-sm";
                pathImg = "xs";
            }


            var quadro = '<a href="/' + obj.system_url_url + '"  class="box-news ' + style + '">'
                + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/' + pathImg + '/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                + '<div class="box-news-text">'
                + '<p>'
                + '<span class="tagId-text tagId-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                + obj.news_title
                + '</p>'
                + '</div></a>';


            if (i === 1) {
                $(".quadro-mega-" + i).html(quadro);
            }

            if (i >= 2 && i <= 3) {
                $(".quadro-grande-" + i).html(quadro);

            }

            if (i >= 4 && i <= 6) {
                $(".quadro-medio-" + i).html(quadro);
            }

            if (i >= 7) {
                $(".quadro-pequeno-" + i).html(quadro);
            }


        },
        panel: function (preback, posbeck) {
            News.Manchete.showLoading();
            preback ? preback() : null;
            var url = "/services/noticia/painel/show/";
            $.ajax({
                url: url,
                dataType: "json",
                data: {geo_region_id: Site.GEO_REGION_ID},
                success: function (data) {

                    if (data.boolean) {
                        $.each(data.items, function (i, obj) {

                            News.Manchete.mountBoxNews(obj, parseInt(i.slice(6)));
                        });


                        posbeck ? posbeck() : null;

                        News.Manchete.hideLoading();
                    }
                }


            });

            return true;
        },

        loadByCategory: function (prebeck, posbeck) {

            News.Manchete.showLoading();

            prebeck ? prebeck() : null;

            var url = "/services/noticia/por-categoria/";
            var data;
            if (News.Manchete.tagId) {

                data = {
                    news_tag_id: News.Manchete.tagId,
                    geo_region_id: Site.GEO_REGION_ID,
                    page: 1,
                    limit_by_page: 20
                };
            } else {
                data = {
                    news_category_id: News.Manchete.categoryId,
                    geo_region_id: Site.GEO_REGION_ID,
                    page: 1,
                    limit_by_page: 20
                };
            }
            $.ajax({
                url: url,
                data: data,
                dataType: "json",
                success: function (data) {
                    if (data.boolean) {
                        var k = 1;
                        $.each(data.items, function (i, obj) {
                            News.Manchete.mountBoxNews(obj, k);
                            k++;
                        });

                        posbeck ? posbeck() : null;
                        News.Manchete.hideLoading();
                    }


                }
            });


        },
        requestNews: {
            loading: 1,
            page: 1,
            limitByPage: 9,
            skip: 18,
            load: function () {

                if (News.Manchete.requestNews.loading) {
                    News.Manchete.requestNews.loading = 0;
                    var url = "/services/noticia/por-categoria/";
                    if (News.Manchete.tagId) {

                        data = {
                            news_tag_id: News.Manchete.tagId,
                            page: 1

                        };
                    } else {
                        data = {
                            news_category_id: News.Manchete.categoryId,
                            page: 1

                        };
                    }
                    $(".news-wall-loading").css("display", "table");
                    $.ajax({
                        url: url,
                        data: {
                            news_category_id: News.Manchete.categoryId,
                            page: News.Manchete.requestNews.page,
                            limit_by_page: News.Manchete.requestNews.limitByPage,
                            skip: News.Manchete.requestNews.skip
                        },
                        dataType: "json",
                        success: function (data) {

                            var html = $("#news-wall").html();

                            if (data.boolean) {


                                $.each(data.items, function (i, obj) {

                                    html += '<div class="col-md-4"><a href="/' + obj.system_url_url + '"  class="box-news box-news-md margin-bottom-20">'
                                        + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/sm/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                                        + '<div class="box-news-text">'
                                        + '<p>'
                                        + '<span class="tagId-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                                        + obj.news_title
                                        + '</p>'
                                        + '</div>'
                                        + '</a></div>   ';


                                });

                                $("#news-wall").html(html);
                                News.Manchete.requestNews.loadAds();
                                $("#news-wall").css("display", "block");
                                $(".news-wall-loading").css("display", "none");
                                News.Manchete.requestNews.loading = 1;
                                News.Manchete.requestNews.page++;
                            } else {
                                News.Manchete.requestNews.loading = 1;
                                console.log(News.Manchete.requestNews.loading);
                            }

                        }, error: Megaic.ajax.error


                    });
                }
                return true;
            },
            loadAds: function () {

                var url;

                if (Site.IS_MOBILE) {
                    url = '/services/anuncio/1/json/?url=' + Site.url;
                } else {
                    url = '/services/anuncio/2/json/?url=' + Site.url;
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
        }


    },
    Single: {},

};

