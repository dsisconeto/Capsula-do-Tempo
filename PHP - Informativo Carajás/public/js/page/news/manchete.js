var page = 1;
var limitByPage = 9;
var skip = 18;
var loading = 1;


function loadNewsByCategory(newsCategoryId, ini) {


    newsCategoryId = newsCategoryId;
    var url = "/services/noticia/news-all-paginate/";

    $.ajax({
        url: url,
        data: {news_category_id: newsCategoryId},
        dataType: "json",
        success: function (data) {


            countG = 1;
            countP = 1;
            countM = 1;
            countMM = 1;

            if (data.boolean) {

                $("#news-manchete").css("display", "none");
                $("#news-wall").css("display", "none");
                $(".news-category-btn").removeClass("active");
                $(".btn_news_category_" + newsCategoryId).addClass("active");


                $.each(data.items, function (i, obj) {

                    if (countMM <= 1) {
                        var quadro = '<a href="' + obj.system_url_url + '"  class="box-news box-news-lg">'
                            + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/lg/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                            + '<div class="box-news-text">'
                            + '<p>'
                            + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                            + obj.news_title
                            + '</p>'
                            + '</div>'
                            + '</a>';

                        $(".quadro-mega-" + countMM).html(quadro);
                        countMM++;

                    } else {
                        if (countG <= 2) {

                            var quadro = '<a href="' + obj.system_url_url + '"  class="box-news">'
                                + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/sm/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                                + '<div class="box-news-text">'
                                + '<p>'
                                + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                                + obj.news_title
                                + '</p>'
                                + '</div>'
                                + '</a>';


                            $(".quadro-grande-" + countG).html(quadro);
                            countG++;

                        } else {
                            if (countM <= 3) {

                                var quadro = '<a href="' + obj.system_url_url + '"  class="box-news">'
                                    + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/sm/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                                    + '<div class="box-news-text">'
                                    + '<p>'
                                    + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                                    + obj.news_title
                                    + '</p>'
                                    + '</div>'
                                    + '</a>';


                                $(".quadro-medio-" + countM).html(quadro);
                                countM++;

                            } else {
                                if (countP <= 16) {
                                    var quadro = '<a href="' + obj.system_url_url + '"  class="box-news box-news-sm">'
                                        + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/sm/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                                        + '<div class="box-news-text">'
                                        + '<p>'
                                        + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                                        + obj.news_title
                                        + '</p>'
                                        + '</div>'
                                        + '</a>';
                                    $(".quadro-medio-" + countP).html(quadro);
                                    countP++;
                                }
                            }


                        }

                    }


                });

                if (ini) {

                    hideLoading(function () {
                        $("#news-manchete").css("display", "block");

                        $('#news-manchete ').animateCss('zoomIn');
                        $('.bxslider').bxSlider({
                            adaptiveHeight: true,
                            auto: true,
                            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'

                        });

                    });


                } else {

                    $("#news-manchete").css("display", "block");
                    $("#news-wall").css("display", "block");

                    $("#news-wall").animateCss('bounceInLeft');
                    $('#news-manchete ').animateCss('bounceInLeft');

                }
            }


        }


    });


}

function lastNews(click, fun) {
    var url = "/services/noticia/news-all/";
    $.ajax({
        url: url,
        dataType: "json",
        success: function (data) {

            if (data.boolean) {
                if (click) {
                    $("#news-manchete").css("display", "none");
                    if ($("#news-wall").length) {
                        $("#news-wall").css("display", "none");
                    }

                }
                $(".news-category-btn").removeClass("active");
                $(".btn_news_category_0").addClass("active");


                $.each(data.items, function (i, obj) {

                    if (obj.news_local_id == 1) {
                        var quadro = '<a href="' + obj.system_url_url + '"  class="box-news">'
                            + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/sm/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                            + '<div class="box-news-text">'
                            + '<p>'
                            + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                            + obj.news_title
                            + '</p>'
                            + '</div>'
                            + '</a>';
                        $(".quadro-grande-" + obj.news_order).html(quadro);

                    }

                    if (obj.news_local_id == 2) {
                        var quadro = '<a href="' + obj.system_url_url + '"  class="box-news box-news-sm">'
                            + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/xs/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                            + '<div class="box-news-text">'
                            + '<p>'
                            + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                            + obj.news_title
                            + '</p>'
                            + '</div>'
                            + '</a>';

                        $(".quadro-pequeno-" + obj.news_order).html(quadro);
                    }


                    if (obj.news_local_id == 4) {
                        var quadro = '<a href="' + obj.system_url_url + '"  class="box-news box-news-md">'
                            + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/sm/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                            + '<div class="box-news-text">'
                            + '<p>'
                            + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                            + obj.news_title
                            + '</p>'
                            + '</div>'
                            + '</a>';

                        $(".quadro-medio-" + obj.news_order).html(quadro);
                    }

                    if (obj.news_local_id == 3) {

                        var quadro = '<a href="' + obj.system_url_url + '"  class="box-news box-news-lg">'
                            + '<img src="/img/hahahaieie.png" class="img-responsive" style="background: url(\'/img/news_cover/lg/' + obj.news_cover + '\'); background-position: center; background-size: cover" >'
                            + '<div class="box-news-text">'
                            + '<p>'
                            + '<span class="tag-text tag-text-' + obj.news_category_color + '">' + obj.news_tag_name + '</span><br>'
                            + obj.news_title
                            + '</p>'
                            + '</div>'
                            + '</a>';

                        $(".quadro-mega-" + obj.news_order).html(quadro);
                    }


                });

                if (click) {

                    $("#news-manchete").css("display", "block");

                    if ($("#news-wall").length) {
                        $("#news-wall").css("display", "block");
                        $("#news-wall").animateCss('bounceInLeft');
                    }

                    $('#news-manchete ').animateCss('bounceInLeft');

                } else {
                    hideLoading(function () {
                        $("#news-manchete").css("display", "block");
                        $('#news-manchete ').animateCss('zoomIn');

                        $('.bxslider').bxSlider({
                            adaptiveHeight: true,
                            auto: true,
                            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'

                        });

                        if (fun) {

                            fun();

                        } else {

                            if ($("#news-wall").length) {


                                requestNews();
                            }
                        }

                    });

                }


            }


        }


    });

    return true;
}

