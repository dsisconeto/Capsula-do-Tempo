/**
 * Created by Dejair Sisconeto on 23/05/2016.
 */
$.fn.extend({
    animateCss: function (animationName, fun) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function () {
            $(this).removeClass('animated ' + animationName);
        });

        if (fun) {

            fun();
        }
    },

    animateCssRandom: function (animationArray) {
        var number = animationArray.length;
        var index = getRandom(number);

        var animationName = animationArray[index];
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function () {
            $(this).removeClass('animated ' + animationName);
        });
    }
});