/**
 * Created by dejai on 23/08/2016.
 */
$(function () {
    register("#form_config_region");


});

function register(form) {

    var optinos = {

        dataType: "json",
        success: function (data) {

            Megaic.alert.notify(data[0].boolean, data[0].msg);

        }, error: Megaic.ajax.error


    };


    $(form).ajaxForm(optinos);

}