
require("./bootstrap");
require("lightgallery");
require("lg-zoom");
require("lg-thumbnail");

$(document).ready(function () {

    $("#galleria-content").lightGallery({
        "selector": ".evento-content-image-box",
        mode: 'lg-fade'
    });


    let split = window.location.href.split("#");

    if (split[1] === "galeria") {
        $(window).scrollTo("#galeria", {
            duration: 800
        });
    }

    $("#galeria-btn").click(function (event) {
        event.preventDefault();

        $(window).scrollTo("#galeria", {
            duration: 800
        });

    });

});