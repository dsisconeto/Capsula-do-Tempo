var Megaic = {

        html: {

            pagination: function (page, numberPage) {
                var pagination = ""; // guarda o html
                var pageMax, pageInit;
                page = parseInt(page);
                if (page >= 10) {
                    pageInit = page - 5;
                    pageMax = page + 5;
                } else {
                    pageInit = 1;
                    pageMax = 10;
                }

                for (var i = pageInit; i <= pageMax; i++) {
                    if (i <= numberPage) { // não pode passar do numero de paginas
                        if (page == i) {
                            // marcar com página atual  e remover click
                            pagination += "<li class=\"active\" >";
                        } else {
                            pagination += "<li>";
                        }
                        pagination += " <a href=\"#pagination\" onclick='pageFlip(" + i + ")'>";
                        pagination += i + "</a></li>";
                    }
                }
                return pagination;
            },
            centralize: function (element) {

                var top = (($(window).height() - $(element).height()) / 2);
                var left = (($(window).width() - $(element).width()) / 2);

                $(element).css({
                    top: top,
                    left: left,
                    margin: 0,
                    position: "relative"

                });
            },
            mid: function (element, position) {
                var pos;
                if (position) {

                    pos = position;

                } else {
                    pos = "relative";
                }
                var top = (($(window).height() - $(element).height()) / 2);

                $(element).css({
                    top: top,

                    margin: 0,
                    position: pos

                });
            }
        },


        ajax: {
            error: function (data) {
                alert("Ouve um erro ao na transação consulte o log do navegador para mais detalhes.");
                console.log(data);
                if (data.responseText) {
                    console.log(data.responseText);
                }

            }
        },

        form: {

            blockBtn: function (btn) {
                $(btn).attr("disabled", "disabled");

            },
            desBlockBtn: function (btn) {
                $(btn).removeAttr("disabled");
            },

            blockForm: function (form) {

                $(form + " button[type='submit']").attr("disabled", "disabled");
                $(form + " button[type='submit']").html("<i class=\"fa fa-hourglass\" aria-hidden=\"true\"></i> Enviando...");

            },
            desBlockForm: function (form) {

                $(form + " button[type='submit']").removeAttr("disabled");
                $(form + " button[type='submit']").html("<i class=\"fa fa-paper-plane-o\" aria-hidden=\"true\"></i>  Enviar");


            },
            processReturnNoty: function (data) {


                if (data[0].boolean) {
                    Megaic.alert.notify(true, data[0].msg)
                } else {
                    Megaic.alert.notify(false, Megaic.returnError(data))
                }

            },
            returnError: function (error) {

                var html = "<ul class='text-left'>";

                $.each(error, function (i, obj) {

                    html += "<li>" + obj.msg + "</li>";

                });

                html += "</ul>";

                return html;
            },
            imgMultiUpload: {
                trava: 1,
                imgCount: 0,
                send: function (form, inputFile, maxWith, barProgress, data2, fun) {
                    /*
                     * o action da função é definido no form
                     * É obrigatorio ter um progress bar do BootStrap
                     * é canvas-to-blob.min.js e resize.js
                     */
                    var este = this;
                    $(form).on('submit', function (event) {
                        event.preventDefault();
                        $(barProgress).text('0%').attr('aria-valuenow', 0).css('width', '0%');
                        // Verificando se o navegador tem suporte aos recursos para redimensionamento
                        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                            alert('O navegador não suporta os recursos utilizados pelo aplicativo');
                            return true;
                        }
                        Megaic.form.blockForm(form);

                        este.resize(form, inputFile, maxWith, barProgress, data2, fun);
                    });


                },
                resize: function (form, inputFile, maxWith, barProgress, data2, fun) {
                    var este = this;

                    if (este.trava) {
                        este.trava = 0;
                        var resize = new window.resize();

                        resize.init();
                        var imagens = $(inputFile)[0].files;

                        var lenImg = imagens.length;


                        if (lenImg > 0 && este.imgCount < lenImg) {
                            $(inputFile).hide(500);
                            if ((typeof imagens[este.imgCount] !== 'object') || (imagens[este.imgCount] == null)) {

                            } else {
                                // Redimensionando
                                resize.photo(imagens[este.imgCount], maxWith, 'dataURL', function (imagem) {

                                    var url = $(form).attr("action");
                                    var type = $(form).attr("method");


                                    var data = {
                                        image_base64: imagem
                                    };


                                    var data3 = Megaic.jsonConcat(data, data2);


                                    // Salvando imagem no servidor
                                    $.ajax({
                                        url: url,
                                        dataType: "json",
                                        type: type,
                                        data: data3,
                                        success: function (data) {
                                            Megaic.alert.notify(data[0].boolean, data[0].msg, "BottomRight");
                                            if (fun) {

                                                fun();
                                            }

                                            // Definindo porcentagem
                                            var porcentagem = (este.imgCount + 1) / lenImg * 100;

                                            // Atualizando barra de progresso
                                            $(barProgress).text(Math.round(porcentagem) + '%').attr('aria-valuenow', porcentagem).css('width', porcentagem + '%');


                                        },
                                        error: Megaic.ajax.error
                                    }).done(function () {
                                        este.imgCount++;
                                        este.trava = 1;
                                        setTimeout(function () {
                                            este.resize(form, inputFile, maxWith, barProgress, data2, fun);
                                        }, 1000);


                                    });

                                });


                            }
                        } else {


                            var input = $(inputFile);

                            input.replaceWith(input.val('').clone(true));

                            Megaic.form.desBlockForm(form);

                            $(barProgress).text('0%').attr('aria-valuenow', 0).css('width', '0%');

                            $(inputFile).show(500);
                        }


                    } else {

                        setTimeout(function () {
                            este.resize(form, inputFile, maxWith, barProgress, data2, fun);
                        }, 1000);

                    }
                }

            }


        },
        alert: {

            notify: function (type, text) {

                var alert = {
                    0: "success",
                    1: "error",
                    2: "warning",
                    3: "information",
                    4: "notification"
                };
                if (type === true) {
                    text = '<i class="fa fa-check" aria-hidden="true"></i> ' + text;
                    type = "success";
                } else {
                    if (type === false) {

                        type = "error";
                    } else {
                        if (alert[type].length) {

                            type = alert[type];

                        }
                    }

                }
                var n = noty({

                    text: text,
                    type: type,
                    dismissQueue: true,
                    layout: "topRight",
                    closeWith: ['click'],
                    theme: 'relax',
                    maxVisible: 10,
                    animation: {
                        open: 'animated rubberBand',
                        close: 'animated fadeOutDown',
                        easing: 'swing',
                        speed: 500
                    }
                });

                setTimeout(function () {
                    $.noty.close(n.options.id);

                    console.log("notification id = " + n.options.id);
                }, 3000);


            }


        }
        ,
        jsonConcat: function (o1, o2) {


            for (var key in o2) {
                o1[key] = o2[key];
            }
            return o1;


        }


        ,
        location: function (url, mileSegundos) {

            setTimeout(function () {
                window.location.href = url;

            }, mileSegundos);
        }


    }
;

