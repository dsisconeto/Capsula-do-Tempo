/**
 * Created by dsisconeto on 04/09/16.
 */


$(function () {
    Megaic.html.centralize('#box_login');
    $("#form_login").ajaxForm({
        dataType: "json",
        success: function (data) {


            if (data[0].boolean) {

                Megaic.alert.notify(true, data[0].msg)


                if (conti) {
                    Megaic.location(conti, 2000);
                } else {
                    Megaic.location("/admin/", 2000);
                }
            } else {

                Megaic.alert.notify(false, data[0].msg)

            }


        }, error: Megaic.ajax.error


    });
});