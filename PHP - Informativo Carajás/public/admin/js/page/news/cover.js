/**
 * Created by dejair on 18/04/16.
 */


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
            $("#news_cover_file h2").text("Capa do Evento");

            var cover = $("#news_cover").val();

            cover = cover.split("/");

            var coverOk = "/img/news_cover/lg/" + cover[5];


            setTimeout(function () {
                $("#form_news_cover").ajaxSubmit(optionsForm);
            }, 100);

            setTimeout(function () {
                $("#news_cover_file img").attr("src", coverOk);
            }, 1000);


        },
        onReset: function () {
            console.log('onReset')
        },
        onError: function (errormessage) {
            console.log('onError:' + errormessage)
        },
        outputUrlId: "news_cover"


    };

    var cropperHeader = new Croppic('show_cover', cropperOptions);


});