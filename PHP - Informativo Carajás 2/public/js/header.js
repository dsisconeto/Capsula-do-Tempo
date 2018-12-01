$(function () {


    $.ajax({
        url: "/services/regiao/sub/",
        cache: true,
        data: {geo_region_id: 6002},
        type: "get",
        dataType: "json",
        success: function (data) {

            var html = $("#geo_region_id").html();

            if (data.boolean) {


                $.each(data.items, function (i, obj) {
                    html += "<option value='" + obj.geo_region_id + "'>" + obj.geo_region_name + "</option>";


                });

                html += "<option value='6002'>Outra Cidade</option>";
                $("#geo_region_id").html(html);
                $("#geo_region_id").select2();

            }
        }, error: Megaic.ajax.error
    });


    $("#geo_region_id").change(function (event) {
        $("#form_region").ajaxSubmit({
            dataType: "json",
            success: function (data) {
                if (data[0].boolean) {
                    Megaic.location(location.href, 500);
                }
                Megaic.alert.notify(true, data[0].msg);
            }

        });
    });

    var navMain = $("#menubar");
    navMain.on("click", "a", null, function () {
        navMain.collapse('hide');
    });

    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("in");
        if (!$(event.target).closest('.navbar').length && _opened === true && !clickover.hasClass("navbar-toggle")) {
            $(".navbar-collapse").collapse('toggle');
        }
    });

    $("#back-top").click(function () {
        $("#space-top").ScrollTo();

    });

    $(window).scroll(function () {
        var windowsTop = $(window).scrollTop();
        if (windowsTop >= 500) {
            $("#back-top").show(500);
        } else {
            $("#back-top").hide(500);
        }
    });


});





