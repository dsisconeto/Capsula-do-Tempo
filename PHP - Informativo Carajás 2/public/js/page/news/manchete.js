$(function () {

    $("#last_news").click(function (event) {
        event.preventDefault();

        News.Manchete.panel(function () {
            News.Manchete.showLoading();
            $(".news-category-btn").removeClass("active");
            $(".btn_news_category_0").addClass("active");


        });
    });


    $(".btn_news_category").click(function (event) {
        event.preventDefault();

        if ($("#collapseOne").hasClass("in")) {
            $('#news-manchete ').animateCss('bounceOut');
            $("#collapseOne").removeClass("in");
        }

        News.Manchete.loadByCategory(function () {

            $(".news-category-btn").removeClass("active");
            $(".btn_news_category_" + News.Manchete.categoryId).addClass("active");


        });

    });


})
;

