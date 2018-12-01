/**
 * Created by dsisconeto on 04/09/16.
 */

var Event = {
    updateStatus: function (eventId, eventStatus, btn) {

        $(btn).html("Espere <i class=\"fa fa-hourglass\" aria-hidden=\"true\"></i>");
        $.ajax({
            method: "post",
            url: "/form/evento/status/",
            dataType: "json",
            data: {event_id: eventId, event_status: eventStatus},
            success: function (data) {

                if (data[0].boolean) {


                    if (eventStatus == 3) {

                        $(btn).attr("onclick", "Event.updateStatus(" + eventId + ", 1, this)");
                        $(btn).html("Despublicar");

                    } else {

                        $(btn).attr("onclick", "Event.updateStatus(" + eventId + ", 3, this)");
                        $(btn).html("Públicar");

                    }


                } else {


                    MegaIc.alert.notify(false, data[0].msg);

                }

            },
            error: Megaic.ajax.error
        });

    }
};
