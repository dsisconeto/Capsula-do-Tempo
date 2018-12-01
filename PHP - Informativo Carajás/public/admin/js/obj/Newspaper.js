/**
 * Created by dsisconeto on 21/09/16.
 */

var Newspaper = {


    updateStatus: function (id, status, element) {
        $(element).attr("disabled", "disabled");

        $.ajax({
            data: {newspaper_id: id, newspaper_status: status},
            url: "/form/admin/impresso/status/",
            dataType: "json",
            type: "post",
            success: function (data) {
                if (data[0].boolean) {

                    if (status == 1) {
                        $(element).html("Públicar");
                        $(element).attr("onclick", "Newspaper.updateStatus(" + id + ", 3, this)");
                    } else {
                        $(element).html("Despublicar");
                        $(element).attr("onclick", "Newspaper.updateStatus(" + id + ", 1, this)");
                    }

                } else {
                    Megaic.alert.notify(false, data[0].msg);
                }
                $(element).removeAttr("disabled");

            },
            error: Megaic.ajax.error
        });
    }


};