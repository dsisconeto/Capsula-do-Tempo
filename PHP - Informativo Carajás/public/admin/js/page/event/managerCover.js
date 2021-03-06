function loadCover() {
    var url = "/services/admin/evento/capa/" + $("#event_id").val() + "/";
    $.ajax({
        url: url,
        dataType: "json",
        success: function (data) {

            if (data.boolean) {

                var html = "";
                $.each(data.items, function (i, obj) {
                    html = "<img src='" + obj.event_cover + "' class='img-responsive center-block'>";
                });

                $("#div_event_cover").html(html);

            } else {
                $("#div_event_cover").html("Nao foi possivel carregar a capa.");

            }

        }, error: Megaic.ajax.error


    });


}


var optionsForm = {
    dataType: "json",
    success: function (data) {
        if (data[0].boolean) {
            Megaic.alert.notify(true, data[0].msg);
        } else {
            Megaic.alert.notify(false, Megaic.form.returnError(data));
        }

        console.log(data);
    }, error: Megaic.ajax.error

};

$(function () {

    var cropperOptions = {
        uploadUrl: '/form/admin/imagem/upload/temp/',
        cropUrl: '/form/admin/imagem/upload/croppic/',
        modal: false,
        processInline: true,
        onBeforeImgUpload: function () {
            console.log('onBeforeImgUpload')
        },
        onAfterImgUpload: function () {
            console.log('onAfterImgUpload')
        },
        onImgDrag: function () {
            console.log('onImgDrag')
        },
        onImgZoom: function () {
            console.log('onImgZoom')
        },
        onBeforeImgCrop: function () {
            console.log('onBeforeImgCrop')
        },
        onAfterImgCrop: function () {
            console.log('onAfterImgCrop');


            var cover = $("#event_cover").val();
            cover = cover.split("/");

            var coverOk = "/img/event_cover/lg/" + cover[5];


            setTimeout(function () {
                $("#form_event_cover").ajaxSubmit(optionsForm);
            }, 100);

            setTimeout(function () {
                $("#news_cover_file").attr("src", coverOk);
            }, 1000);


        },
        onReset: function () {
            console.log('onReset')
        },
        onError: function (errormessage) {
            console.log('onError:' + errormessage)
        },
        outputUrlId: "event_cover"


    };

    var cropperHeader = new Croppic('show_cover', cropperOptions);


});