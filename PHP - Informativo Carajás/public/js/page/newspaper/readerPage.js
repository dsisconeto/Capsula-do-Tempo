/**
 * Created by dsisconeto on 23/09/16.
 */

$(function () {
    Megaic.html.mid(".back_page", "fixed");
    Megaic.html.mid(".next_page", "fixed");

    vericationBtn();
    loadPage();

    $(".next_page").click(function (event) {
        $("#page").hide(0);
        $("#page").animateCss("zoomOutRight");
        $("#page").show(0);
        number++;
        loadPage();


    });

    $(".back_page").click(function () {
        $("#page").animateCss("zoomOutLeft");
        $("#page").hide(0);
        $("#page").show(0);

        if (number > 1) {

            number--;
        }
        loadPage();


    });

});


function vericationBtn() {

    if (number <= 1) {
        $(".back_page").css("display", "none ");
    } else {

        $(".back_page").css("display", "block ");
    }

    if (number >= countPage) {

        $(".next_page").css("display", "none ");

    } else {

        $(".next_page").css("display", "block ");

    }


}


function loadPage() {

    vericationBtn();

    if (!pages[number].length) {
        number++;
    }
    setTimeout(function () {
        $("#page").attr("src", "/img/newspaper_page/lg/" + pages[number]);


    }, 500);

}




