function loadListImgContent() {

    var url = "/services/admin/noticia/imagem/conteudo/";
    $.ajax({
        dataType: "json",
        url: url,
        success: function (data) {
            var html = "";
            if (data.boolean) {

                $.each(data.items, function (i, obj) {

                    html += '<div class="col-sm-4 col-md-2" id="news_content_img_id_' + obj.news_content_img_id + '"> '
                        + '<img class="img-responsive thumbnail" src="/img/news_content/md/' + obj.news_content_img_file + '" style="cursor: move">'
                        + '</div>';

                });


            } else {
                console.log("Imagens adicionais vazias");
            }

            $("#row_content_img").html(html);

        }, error: function () {

        }

    });


}


$(function () {

    var progressImgContent = $("#news_content_img_progress");
    var barImgContent = $("#bar_news_content_img_bar");
    loadListImgContent();
    $('#form_news_content_img').ajaxForm({
        clearForm: true,       // clear all form fields after successful submit
        resetForm: true,
        beforeSend: function () {

            $('#news_content_img_file').hide(200);
            var percentVal = '0%';
            progressImgContent.width(percentVal);
            progressImgContent.attr("aria-valuenow", 0);

            barImgContent.html(percentVal);
        },
        uploadProgress: function (event, position, total, percentComplete) {

            var percentVal = percentComplete + '%';
            progressImgContent.width(percentVal);
            progressImgContent.attr("aria-valuenow", percentComplete);

            barImgContent.html(percentVal);
        },
        success: function () {
            var percentVal = '100%';
            progressImgContent.width(percentVal);
            progressImgContent.attr("aria-valuenow", 100);
            barImgContent.html(percentVal);
            loadListImgContent();


        },
        complete: function (xhr) {
            var percentVal = '0%';
            progressImgContent.width(percentVal);
            progressImgContent.attr("aria-valuenow", 0);
            barImgContent.html(percentVal);
            $('#news_content_img_file').show(200);
        }
    });


});

