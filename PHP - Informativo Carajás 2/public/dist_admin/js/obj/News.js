/**
 * Created by dsisconeto on 04/09/16.
 */


var News = {

    delete: function (newsId, callback) {

        if (confirm("Tem certeza que deseja deletar a notícia de ID " + newsId + "?")) {

            var url = "/form/admin/noticia/deletar/";
            $.ajax({
                url: url,
                data: {news_id: newsId},
                dataType: "json",
                type: "post",
                delay: 1000,

                success: function (data) {
                    data = data[0];

                    if (data.boolean) {
                        callback ? callback() : null;
                    } else {

                        alert(data.msg);
                    }

                },
                error: Megaic.ajax.error


            })
            ;

        }
    },
    updateStatus: function (newsId, status, callback, btn) {

        $.ajax({
            data: {news_id: newsId, news_status: status},
            url: "/form/admin/noticia/status/",
            dataType: "json",
            type: "post",
            delay: 500,
            success: function (data) {
                if (data[0].boolean) {

                    Megaic.alert.notify(true, data[0].msg);
                    if (btn) {

                        if (status === 3) {
                            $(btn).html("Despublicar");
                            $(btn).attr("onclick", "News.updateStatus(" + newsId + ", 1, " + callback + ",this)");
                        } else {

                            $(btn).html("Públicar");

                            $(btn).attr("onclick", "News.updateStatus(" + newsId + ", 3, " + callback + ",this)");

                        }
                    }

                    callback ? callback() : null;

                } else {
                    Megaic.alert.notify(false, data[0].msg);
                }
            },
            error: Megaic.ajax.error
        });
    }
};