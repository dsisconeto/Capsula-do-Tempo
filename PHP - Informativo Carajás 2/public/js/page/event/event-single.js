$(function () {

    setInterval(
        function () {
            Event.Single.mountGallery()
        }, 1000);

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

});