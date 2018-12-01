require("./bootstrap");

$(document).ready(function () {


    var split = window.location.href.split("#");
    var mover = "#";
    switch (split[1]) {
        case"quemsomos":
            mover += "quem-somos";
            break;
        case"faleconosco":
            mover += "faleconosco";
    }
    if (mover !== "#") {
        setTimeout(function () {
            $(window).scrollTo(mover, {
                duration: 800
            });
        }, 1000);
    }


    $("#btn-quem-somos").click(function () {
        $(window).scrollTo("#quem-somos", {
            duration: 800
        });
    });

    $("#btn-fale-conosco").click(function () {
        $(window).scrollTo("#faleconosco", {
            duration: 800
        });
    });




});