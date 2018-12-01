/**
 * Created by dsisconeto on 04/09/16.
 */


var News = {

    delete: function (newsId, fun) {

        if (confirm("Tem certeza que deseja deletar a notícia de ID " + newsId + "?")) {

            var url = "/form/admin/noticia/deletar/";
            $.ajax({
                url: url,
                data: {news_id: newsId},
                dataType: "json",
                type: "post",
                delay: 250,

                success: function (data) {
                    data = data[0];
                    console.log(data);
                    if (data.boolean) {
                        fun();
                    } else {

                        alert(data.msg);
                    }

                },
                error: Megaic.ajax.error


            })
            ;

        }
    },
    updateStatus: function (newsId, newsStatus, element, fun) {

        $(element).attr("disabled", "disabled");

        $.ajax({
            data: {news_id: newsId, news_status: newsStatus},
            url: "/form/admin/noticia/status/",
            dataType: "json",
            type: "post",
            success: function (data) {
                console.log(data);
                if (data[0].boolean) {
                    if (fun) {
                        fun();
                    }

                    if (newsStatus == 1) {
                        $(element).html("Públicar");
                        $(element).attr("onclick", "News.updateStatus(" + newsId + ", 3, this)");
                    } else {
                        $(element).html("Despublicar");
                        $(element).attr("onclick", "News.updateStatus(" + newsId + ", 1, this)");
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