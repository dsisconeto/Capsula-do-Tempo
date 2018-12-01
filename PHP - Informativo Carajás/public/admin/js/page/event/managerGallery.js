function loadShared(eventId) {
    var data = {event_id: eventId};
    var url = "/form/admin/evento/galeria/shared/";

    $.ajax({
        type: "post",
        data: data,
        url: url,
        dataType: "json",
        success: function (data) {
            if (data[0].boolean) {
                Megaic.alert.notify(true, data[0].msg);
            } else {
                Megaic.alert.notify(false, Megaic.form.returnError(data));
            }
        }, error: Megaic.ajax.error
    });


}

//
function deleteAllGallery(eventId) {
    if (prompt("digite DELETAR") == "DELETAR") {

        var data = {event_id: eventId};
        var url = "/form/admin/evento/galeria/deletar/todas/";
        $.ajax({
            type: "post",
            data: data,
            url: url,
            dataType: "json",
            success: function (data) {
                if (data[0].boolean) {
                    $(".gallery_img").hide(500);
                } else {
                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }
            }, error: Megaic.ajax.error
        });
    }
}
function deleteGallery(galleryId) {

    var data = {event_gallery_id: galleryId};
    var url = "/form/evento/galeria/deletar/";
    $.ajax({
        type: "post",
        data: data,
        url: url,
        dataType: "json",
        success: function (data) {
            console.log(data);

            if (data[0].boolean) {

                $("#gallery-" + galleryId).hide(200);
            } else {
                alert("Erro ao deletar");

            }


        }, error: Megaic.ajax.error

    });


}

function loadList() {
    var data = {event_id: $("#event_id").val()};
    var url = "/services/admin/evento/galeria/";
    $.ajax({
        data: data,
        url: url,
        dataType: "json",
        success: function (data) {

            if (data.boolean) {

                var html = "";
                $.each(data.items, function (i, obj) {

                    html += "<li id='gallery-" + obj.event_gallery_id + "' class='gallery_img'>"
                        + "<img src='/img/event_gallery/xs/" + obj.event_gallery_file + "'>"
                        + "<button class='btn btn-danger form-control' onclick='deleteGallery(" + obj.event_gallery_id + ")'>Deletar</button>"
                        + "</li>";


                });

                $("#list_gallery").html(html);

                iniSortable();
            } else {
                $("#list_gallery").html("Nada Encontrado");

            }


        }, error: Megaic.ajax.error

    });


}


// Iniciando biblioteca
var resize = new window.resize();
resize.init();

// Declarando variáveis
var imagens;
var imagem_atual;

// Quando carregado a página
$(function ($) {

    // Quando enviar o formulario
    $('#form_event_gallery').on('submit', function (event) {
        event.preventDefault();
        enviar();
    });

});

/*
 Envia os arquivos selecionados
 */
function enviar() {
    // Verificando se o navegador tem suporte aos recursos para redimensionamento
    if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
        alert('O navegador não suporta os recursos utilizados pelo aplicativo');
        return;
    }

    // Alocando imagens selecionadas
    imagens = $('#event_gallery_file')[0].files;

    // Se selecionado pelo menos uma imagem
    if (imagens.length > 0) {
        // Definindo progresso de carregamento

        $('#event_gallery_progresso').attr('aria-valuenow', 0).css('width', '0%');

        // Escondendo campo de imagem
        $('#event_gallery_file').hide();

        // Iniciando redimensionamento
        imagem_atual = 0;
        redimensionar();
    }
}

/*
 Redimensiona uma imagem e passa para a próxima recursivamente
 */
function redimensionar() {
    // Se redimensionado todas as imagens
    if (imagem_atual > imagens.length) {
        // Definindo progresso de finalizado
        $('#event_gallery_progresso').html('Imagen(s) enviada(s) com sucesso');

        // Limpando imagens
        limpar();

        // Exibindo campo de imagem
        $('#event_gallery_file').show();

        // Finalizando
        return;
    }

    // Se não for um arquivo válido
    if ((typeof imagens[imagem_atual] !== 'object') || (imagens[imagem_atual] == null)) {
        // Passa para a próxima imagem
        imagem_atual++;
        redimensionar();
        return;
    }

    // Redimensionando
    resize.photo(imagens[imagem_atual], 1200, 'dataURL', function (imagem) {

        var url = "/form/evento/galeria/upload/";
        var data = {
            event_gallery_file: imagem,
            event_id: $("#event_id").val()
        };
        // Salvando imagem no servidor
        $.ajax({
            url: url,
            dataType: "json",
            type: "POST",
            data: data,
            success: function (data) {

                console.log(data);
                if (data.boolean) {

                    if (data[0].boolean) {

                        Megaic.alert.notify(true, data[0].msg);
                    } else {
                        Megaic.alert.notify(false, Megaic.form.returnError(data));
                    }
                }

                // Definindo porcentagem
                var porcentagem = (imagem_atual + 1) / imagens.length * 100;

                // Atualizando barra de progresso
                $('#event_gallery_progresso').text(Math.round(porcentagem) + '%').attr('aria-valuenow', porcentagem).css('width', porcentagem + '%');

                // Aplica delay de 1 segundo
                // Apenas para evitar sobrecarga de requisições
                // e ficar visualmente melhor o progresso
                setTimeout(function () {
                    // Passa para a próxima imagem
                    imagem_atual++;
                    redimensionar();
                }, 1000);

            }, error: Megaic.ajax.error

        });


    });
}

/*
 Limpa os arquivos selecionados
 */
function limpar() {
    var input = $("#event_gallery_file");
    input.replaceWith(input.val('').clone(true));
    loadList();
    $('#event_gallery_progresso').attr('aria-valuenow', 0).css('width', '0%');
}


$(function () {
    loadList();

    $("#event_gallery_file").change(function () {
        $(this).prev().html($(this).val());
    });


});


function iniSortable() {

    $('#list_gallery').sortable({
        update: function (event, ui) {
            var data = $(this).sortable('serialize');

            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'post',
                url: "/form/evento/galeria/serializar/",
                dataType: "text",
                success: function (data) {
                    console.log(data);
                }, error: function (data) {
                    console.log(data);
                }
            });
        }

    });

}