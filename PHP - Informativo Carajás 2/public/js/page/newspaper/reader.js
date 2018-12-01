

    function loadApp() {

        // Create the flipbook

        $('.flipbook').turn({
            // Width

            width: 922,

            // Height

            height: 600,

            // Elevation

            elevation: 50,

            // Enable gradients

            gradients: true,

            // Auto center this flipbook

            autoCenter: true

        });
    }

yepnope({
    test: Modernizr.csstransforms,
    yep: ['/public/vendor/turnjs4/lib/turn.min.js'],
    nope: ['/public/vendor/turnjs4/lib/turn.html4.min.js'],
    both: ['/public/css/page/newspaper/reader.css'],
    complete: loadApp
});


