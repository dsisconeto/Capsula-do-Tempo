var Site = {
    GEO_REGION_ID: 0,
    IS_MOBILE: 0,
    HOST_IMG:"",
    HOST_MAIN:"",
    URL: "",
    hideLoading: function (callBack) {

        $("#loading-page").animateCss("fadeOutDown");

        $('#loading-page').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $("#loading-page").css("display", "none");

            callBack ? callBack() : null;
        });

    },
    getRandom: function (max) {
        return Math.floor(Math.random() * max + 0);
    }
};
