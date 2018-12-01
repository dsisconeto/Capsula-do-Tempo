


$(function () {
    var navMain = $(".navbar-collapse"); // avoid dependency on #id
    // "a:not([data-toggle])" - to avoid issues caused
    // when you have dropdown inside navbar
    navMain.on("click", "a:not([data-toggle])", null, function () {
        setTimeout(function () {
            navMain.collapse('hide');
        }, 1000)
    });


    $(window).scroll(function () {
        var windowsTop = $(window).scrollTop();
        if (windowsTop >= 500) {
            $("#voltar-topo").show(500);
        } else {
            $("#voltar-topo").hide(500);
        }
    });

    $("#voltar-topo").click(function () {

        $(window).scrollTo("#nav-main", {
            duration: 800
        });
    });


});

