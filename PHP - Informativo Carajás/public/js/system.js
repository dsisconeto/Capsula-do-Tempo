var navMain = $("#menubar");
navMain.on("click", "a", null, function () {
    navMain.collapse('hide');
});
$(document).ready(function () {
    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("in");
        if (!$(event.target).closest('.navbar').length && _opened === true && !clickover.hasClass("navbar-toggle")) {
            $(".navbar-collapse").collapse('toggle');
        }
    });
});


function hideLoading(fun) {

    $("#loading-page").animateCss("fadeOutDown");

    $('#loading-page').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {


        $("#loading-page").css("display", "none");


        fun();
    });

}


function getRandom(max) {
    return Math.floor(Math.random() * max + 0)
}


$(function () {

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





