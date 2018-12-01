/**
 * Created by dsisconeto on 01/09/16.
 */





var Ads = {


    managerForm: function (form) {

        $(form).ajaxForm({
            beforeSumit: function (data) {
                console.log(data);
            },

            dataType: "json",
            type: "post",
            success: function (data) {

                if (data[0].boolean) {

                    Megaic.alert.notify(data[0].boolean, data[0].msg);
                    Megaic.location("/admin/anuncio/todos/", 500);

                } else {

                    Megaic.alert.notify(data[0].boolean, Megaic.form.returnError(data));

                }


            }, error: Megaic.ajax.error


        })
        ;


    }


};