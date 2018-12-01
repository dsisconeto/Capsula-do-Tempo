/**
 * Created by dejai on 10/09/2016.
 */


$(function () {
    setTimeout(function () {

        $("#system_user_login").val('');
        $("#system_user_password").val('');

    }, 400);

    $("#form_user_manager").ajaxForm({
        dataType: "json",
        success: function (data) {

            if (data[0].boolean) {


                Megaic.alert.notify(true, data[0].msg);
                Megaic.location("/admin/usuario/todos/", 2000);

            } else {

                Megaic.alert.notify(false, Megaic.form.returnError(data));

            }

        }, error: Megaic.ajax.error


    });

});