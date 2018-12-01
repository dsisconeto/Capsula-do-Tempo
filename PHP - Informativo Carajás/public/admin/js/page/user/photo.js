/**
 * Created by dejair on 18/04/16.
 */


var optionsForm = {
    dataType: "json",
    success: function (data) {

        if (data[0].boolean) {

            Megaic.alert.notify(true, data[0].msg);
            Megaic.location("/admin/usuario/todos/", 3000)

        } else {

            Megaic.alert.notify(false, resError(data));

        }


        console.log(data);
    }, error: function (data) {
        console.log(data);
        alert(faltaErrorFun);
    }

};

$(function () {

    var cropperOptions = {
        uploadUrl: '/form/admin/imagem/upload/temp/',
        cropUrl: '/form/admin/imagem/upload/croppic/',
        modal: true,
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
            $("#user_photo_file h2").text("Foto do Perfil");
            $("#user_photo_file").css("display", "block");

            var cover = $("#system_user_profile_photo").val();

            cover = cover.split("/");

            var coverOk = "/img/sys-avatar/" + cover[5];

            $("#form_user_photo").ajaxSubmit(optionsForm);

            setTimeout(function () {
                $("#user_photo_file img").attr("src", coverOk);
            }, 1000);


        },
        onReset: function () {
            console.log('onReset')
        },
        onError: function (errormessage) {
            console.log('onError:' + errormessage)
        },
        outputUrlId: "system_user_profile_photo"


    };

    var cropperHeader = new Croppic('show_cover', cropperOptions);


});