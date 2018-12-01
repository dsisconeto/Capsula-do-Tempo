/**
 * Created by dsisconeto on 04/09/16.
 */


var NewsTag = {


        register: function (form, fun) {

            var op = {
                dataType: "json",
                success: function (data) {
                    if (fun) {

                        fun();
                    }

                    Megaic.alert.notify(data[0].boolean, data[0].msg)


                }, error: Megaic.ajax.error


            };

            $(form).ajaxForm(op);


        }, delete: function (newTagId, fun) {


            var url = "/form/admin/noticia/tag/deletar/";

            $.ajax({
                data: {news_tag_id: newTagId},
                url: url,
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (fun) {

                        fun();
                    }
                    Megaic.alert.notify(data[0].boolean, data[0].msg);

                }, error: Megaic.ajax.error


            })
            ;


        }
    }
    ;