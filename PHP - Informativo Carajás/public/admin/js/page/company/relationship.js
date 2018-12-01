var CompanyGallery = {

    loadTable: function () {
        var url = "/services/empresa/galeria/";
        var data = {company_id: companyId};

        $.ajax({
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                var html = "";
                if (data.boolean) {
                    $.each(data.items, function (i, obj) {

                        html += "<tr id='tr_company_gallery_" + obj.company_gallery_id + "'>"
                            + "<td><img src='/img/company_gallery/sm/" + obj.company_gallery_file + "' class='img-responsive center-block'> </td>"
                            + "<td><button class='btn btn-danger pull-right' onclick='CompanyGallery.delete(" + obj.company_gallery_id + ")'><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deletar</button></td>"
                            + "</tr>";

                    });


                    $("#table_company_gallery").html(html);
                } else {

                    $("#table_company_gallery").html("Que tal adicionar uma imagem ?");
                }

            }, error: Megaic.ajax.error

        });

    },

    delete: function (companyGalleryId) {
        var url = "/form/admin/empresa/galeria/deletar/";

        var data = {company_gallery_id: companyGalleryId};

        $.ajax({
            url: url,
            data: data,
            type: "post",
            dataType: "json",
            success: function (data) {
                console.log(data);

                if (data[0].boolean) {

                    $("#tr_company_gallery_" + companyGalleryId).hide(500);

                } else {
                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }

            }, error: function (data) {

                console.log(data);

                alert("Falta Error !!");
            }

        });
    }

};


var CompanySocialNetwork = {

    registerForm: function (form) {


        $(form).ajaxForm({
            beforeSubmit: function (formData, jqForm, options) {
                console.log(formData);
                Megaic.form.blockForm(form);
            },
            dataType: "json",
            success: function (data) {

                if (data[0].boolean) {

                    CompanySocialNetwork.loadTable();
                    Megaic.alert.notify(true, data[0].msg);
                    $(form).resetForm();

                } else {


                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }

                Megaic.form.desBlockForm(form);
            }, error: Megaic.ajax.error

        });


    },
    loadTable: function () {

        var url = "/services/empresa/social/";
        var data = {company_id: companyId};

        $.ajax({
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                var html = "";
                if (data.boolean) {

                    $.each(data.items, function (i, obj) {

                        html += "<tr style='color:#fff' id='tr_company_social_" + obj.company_social_network_id + "'>"
                            + "<td style='background:#" + obj.system_social_network_color + "'><i class=\"" + obj.system_social_network_icon + "\" aria-hidden=\"true\"></i> " + obj.system_social_network_name + ": " + obj.company_social_network_link + "</td>"
                            + "<td><button class='btn btn-danger pull-right' onclick='CompanySocialNetwork.delete(" + obj.company_social_network_id + ")'><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deletar</button></td>"
                            + "</tr>";

                    });


                    $("#table_company_social").html(html);
                } else {

                    $("#table_company_social").html("Que tal adicionar uma Rede ?");
                }

            }, error: Megaic.ajax.error

        });
    },

    loadSelect: function () {

        var url = "/services/sistema/redesocial/";

        var dataType = "json";

        var successFun = function (data) {

            if (data.boolean) {

                var html = "<option value=''>-- Selecione a Rede --</option>";

                $.each(data.items, function (i, obj) {

                    html += "<option value='" + obj.system_social_network_id + "'>" + obj.system_social_network_name + "</option>";

                });

                $("#system_social_network_id").html(html);

            }

        };

        $.ajax({
            url: url,
            dataType: dataType,
            success: successFun,
            error: Megaic.ajax.error
        });
    },

    delete: function (companySocialNetworkId) {

        var url = "/form/admin/empresa/redesocial/deletar/";
        var data = {system_social_network_id: companySocialNetworkId};

        $.ajax({
            url: url,
            data: data,
            type: "post",
            dataType: "json",
            success: function (data) {
                console.log(data);

                if (data[0].boolean) {
                    $("#tr_company_social_" + companySocialNetworkId).hide(500);

                } else {
                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }

            }, error: Megaic.ajax.error

        });
    }

};


var companyRelationRegion = {

    select2: function (form) {

        $(form).select2({
                ajax: {
                    url: "/services/admin/regiao/select2/permissao/company/",
                    dataType: 'json',
                    delay: 250,
                    type:"get",
                    data: function (params) {
                        return {
                            geo_region_name: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true,

                },

                minimumInputLength: 1

            }
        );

    },
    registerForm: function (form) {

        $(form).ajaxForm({

            beforeSubmit: function (formData, jqForm, options) {
                console.log(formData);
                Megaic.form.blockForm(form);
            },
            dataType: "json",
            success: function (data) {

                if (data[0].boolean) {

                    companyRelationRegion.loadTable();
                    Megaic.alert.notify(true, data[0].msg);
                    $(form).resetForm();
                } else {


                    Megaic.alert.notify(false, Megaic.form.returnError(data));

                }

                Megaic.form.desBlockForm(form);
                console.log(data);
            }, error: Megaic.ajax.error
        });


    },

    loadTable: function () {

        var url = "/services/empresa/regiao/";
        var data = {company_id: companyId};
        var dataType = "json";

        var successFun = function (data) {

            if (data.boolean) {
                var html = "";

                $.each(data.items, function (i, obj) {

                    html += "<tr id='tr_geo_region_" + obj.geo_region_id + "'>"
                        + "<td>"
                        + obj.geo_region_name
                        + "</td>"
                        + "<td>"
                        + "<button class='btn btn-danger pull-right' onclick='companyRelationRegion.delete(" + obj.geo_region_id + ")'><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deletar</button>"
                        + "</td>"
                        + "</tr>";

                });

                $("#table_geo_region").html(html);

            } else {

                $("#table_geo_region").html("Que tal adicionar uma relação com uma região ?");
            }


        };

        $.ajax({
            url: url,
            data: data,
            dataType: dataType,
            success: successFun,
            error: Megaic.ajax.error
        });
    },
    delete: function (geoRegionId) {

        var url = "/form/admin/empresa/regiao/deletar/";
        var data = {geo_region_id: geoRegionId, company_id: companyId};

        $.ajax({
            url: url,
            data: data,
            dataType: "json",
            type: "post",
            success: function (data) {
                console.log(data);

                if (data[0].boolean) {

                    $("#tr_geo_region_" + geoRegionId).hide(500);

                } else {
                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }

            }, error: Megaic.ajax.error

        });

    }
};


var companyRelationSegment = {


    registerForm: function (form) {

        $(form).ajaxForm({

            beforeSubmit: function (formData, jqForm, options) {
                console.log(formData);
                Megaic.form.blockForm(form);
            },
            dataType: "json",

            success: function (data) {

                if (data[0].boolean) {

                    companyRelationSegment.loadSelect();

                    Megaic.alert.notify(true, data[0].msg);

                    $(form).resetForm();
                } else {

                    Megaic.alert.notify(false, Megaic.form.returnError(data));

                }

                Megaic.form.desBlockForm(form);
            }, error: function (data) {
                Megaic.form.desBlockForm(form);
                console.log(data);
                alert(faltaErrorFun);
            }
        });
    },


    loadSelect: function () {

        var url = "/services/empresa/relacao/segmento/";
        var data = {company_id: $("#company_id").val()};

        $.ajax({
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {

                if (data.boolean) {
                    var html = "";
                    $.each(data.items, function (i, obj) {
                        html += "<tr id='tb_company_segment_" + obj.company_segment_id + "'>" +
                            "<td>" + obj.company_segment_name + "</td>" +
                            "<td><button class='btn btn-danger pull-right' onclick='companyRelationSegment.delete(" + obj.company_segment_id + ")'><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deletar</button></td>" +
                            "</tr>";
                    });


                    $("#table_segment").html(html);
                } else {

                    $("#table_segment").html("Que tal adicionar uma relação ?");
                }

            }, error: Megaic.ajax.error

        });

    },

    delete: function (segmentId) {

        var url = "/form/admin/empresa/segmento/deletar/relacao/";
        var data = {company_segment_id: segmentId, company_id: companyId};

        $.ajax({
            url: url,
            data: data,
            type: "post",
            dataType: "json",
            success: function (data) {
                console.log(data);

                if (data[0].boolean) {
                    $("#tb_company_segment_" + segmentId).hide(500);

                } else {
                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }

            }, error: Megaic.ajax.error

        });
    }

};


var companyDepartment = {


        registerForm: function (form) {

            $(form).ajaxForm({

                beforeSubmit: function (formData, jqForm, options) {
                    console.log(formData);
                    Megaic.form.blockForm(form);

                },
                dataType: "json",
                success: function (data) {

                    if (data[0].boolean) {

                        companyDepartment.loadTable();
                        companyDepartment.loadSelect();

                        Megaic.alert.notify(true, data[0].msg);
                        $(form).resetForm();

                    } else {

                        Megaic.alert.notify(false, Megaic.form.returnError(data));
                    }

                    Megaic.form.desBlockForm(form);

                }, error: Megaic.ajax.error
            });
        },

        loadTable: function () {
            var url = "/services/empresa/departamento/";
            var data = {company_id: $("#company_id").val()};
            var dataType = "json";

            var successFun = function (data) {

                if (data.boolean) {
                    var html = "";

                    $.each(data.items, function (i, obj) {

                        html += "<tr id='tr_company_department_" + obj.company_department_id + "'>"
                            + "<td>"
                            + obj.company_department_name
                            + "</td>"
                            + "<td>"
                            + "<button class='btn btn-danger pull-right' onclick='companyDepartment.delete(" + obj.company_department_id + ")'><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deletar</button>"
                            + "</td>"
                            + "</tr>"
                        ;

                    });

                    $("#table_department").html(html);

                } else {

                    $("#table_department").html("Que tal adicionar um departamento ?");
                }


            };

            $.ajax({
                url: url,
                data: data,
                dataType: dataType,
                success: successFun,
                error: Megaic.ajax.error
            });

        }
        ,
        loadSelect: function () {

            var url = "/services/empresa/departamento/";
            var data = {company_id: $("#company_id").val()};
            var dataType = "json";
            var successFun = function (data) {

                if (data.boolean) {
                    var html = "<option value=''>-- Selecione o Departamento --</option>";
                    $.each(data.items, function (i, obj) {
                        html += "<option value='" + obj.company_department_id + "'>"
                            + obj.company_department_name
                            + "</option>";

                    });


                    $(".company_department_id").html(html);

                } else {

                    var html = "<option value=''>-- Que tal adicionar um departamento ? --</option>";
                    $(".company_department_id").html(html);
                }


            };

            $.ajax({
                url: url,
                data: data,

                dataType: dataType,
                success: successFun,
                error: Megaic.ajax.error
            })

        }
        ,

        delete: function (departmentId) {
            var url = "/form/admin/empresa/departamento/deletar/";
            var data = {company_department_id: departmentId};
            var dataType = "json";
            var successFun = function (data) {

                if (data[0].boolean) {
                    $("#tr_company_department_" + departmentId).hide(1000);
                    companyPhone.loadTable();
                    companyEmail.loadTable();
                    companyDepartment.loadSelect();

                } else {
                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }


            };

            $.ajax({
                url: url,
                data: data,
                dataType: dataType,
                method: "post",
                success: successFun,
                error: function (data) {
                    console.log(data);
                    alert("Falta error!!! Verifique o console para mais detalhes");
                }
            });

        }


    }
    ;


var companyEmail = {

    registerForm: function (form) {

        $(form).ajaxForm({

            beforeSubmit: function (formData, jqForm, options) {
                console.log(formData);

                Megaic.form.blockForm(form);
            },
            dataType: "json",

            success: function (data) {

                if (data[0].boolean) {

                    companyEmail.loadTable();
                    Megaic.alert.notify(true, data[0].msg);
                    $(form).resetForm();

                } else {

                    Megaic.alert.notify(false, Megaic.form.returnError(data));
                }
                Megaic.form.desBlockForm(form);

            }, error: function (data) {
                Megaic.form.desBlockForm(form);
                console.log(data);
                alert(faltaErrorFun);

            }
        });
    },

    loadTable: function () {
        var url = "/services/empresa/email/";
        var data = {company_id: $("#company_id").val()};
        var dataType = "json";
        var successFun = function (data) {

            if (data.boolean) {

                var html = "";
                $.each(data.items, function (i, obj) {
                    html += "<tr id='tr_company_email_" + obj.company_email_id + "'>"
                        + "<td>"
                        + obj.company_email
                        + "</td>"
                        + "<td>"
                        + "<button class='btn btn-danger pull-right' onclick='companyEmail.delete(" + obj.company_email_id + ")'><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deletar</button>"
                        + "</td>"
                        + "</tr>";

                });

                $("#table_email").html(html);
            } else {

                $("#table_email").html("Que tal adicionar um email ?");
            }


        };

        $.ajax({
            url: url,
            data: data,
            dataType: dataType,
            success: successFun,
            error: Megaic.ajax.error
        })
        ;
    },

    delete: function (emailId) {

        var url = "/form/admin/empresa/email/deletar/";
        var data = {company_email_id: emailId};
        var dataType = "json";
        var successFun = function (data) {

            if (data[0].boolean) {
                $("#tr_company_email_" + emailId).hide(1000);
            } else {
                Megaic.alert.notify(false, Megaic.form.returnError(data));
            }


        };

        $.ajax({
            url: url,
            data: data,
            dataType: dataType,
            method: "post",
            success: successFun,
            error: function (data) {
                console.log(data);
                alert("Falta error!!! Verifique o console para mais detalhes");
            }
        });

    }

};


var companyPhone = {

    registerForm: function (form) {
        $(form).ajaxForm({

            beforeSubmit: function (formData) {
                console.log(formData);
                Megaic.form.blockForm(form);
            },
            dataType: "json",
            success: function (data) {

                if (data[0].boolean) {
                    companyPhone.loadTable();
                    Megaic.alert.notify(true, data[0].msg);
                    $("#form_company_phones").resetForm();
                } else {

                    Megaic.alert.notify(false, Megaic.form.returnError(data));

                }

                Megaic.form.desBlockForm(form);
            }, error: function (data) {
                Megaic.form.desBlockForm(form);
                console.log(data);
                alert(faltaErrorFun);
            }
        });
    },

    loadTable: function () {

        var url = "/services/empresa/telefone/";
        var data = {company_id: $("#company_id").val()};
        var dataType = "json";
        var successFun = function (data) {

            if (data.boolean) {
                var html = "";
                $.each(data.items, function (i, obj) {
                    html += "<tr id='tr_company_phone_" + obj.company_phone_id + "'>"
                        + "<td>"
                        + obj.company_phone
                        + "</td>"
                        + "<td>"
                        + "<button class='btn btn-danger pull-right' onclick='companyPhone.delete(" + obj.company_phone_id + ")'><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deletar</button>"
                        + "</td>"
                        + "</tr>"
                    ;

                });


                $("#table_phone").html(html);

            } else {
                $("#table_phone").html("Que tal adicionar um telefone ?");

            }


        };

        $.ajax({
            url: url,
            data: data,
            dataType: dataType,
            success: successFun,
            error: Megaic.error
        });

    },

    delete: function (phoneId) {

        var url = "/form/admin/empresa/telefone/deletar/";
        var data = {company_phone_id: phoneId};
        var dataType = "json";
        var successFun = function (data) {


            if (data[0].boolean) {

                $("#tr_company_phone_" + phoneId).hide(1000);

            } else {

                Megaic.alert.notify(false, Megaic.form.returnError(data));

            }


        };

        $.ajax({
            url: url,
            data: data,
            dataType: dataType,
            success: successFun,
            type: "post",
            error: Megaic.ajax.error
        });

    }


};

var company = {

    loadCover: function () {

        var url = "/services/empresa/capa/";
        var data = {company_id: companyId};

        $.ajax({
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                var html = "<tr>";
                if (data.boolean) {

                    $.each(data.items, function (i, obj) {

                        html += "<td><img  class='img-responsive center-block' src='/img/company_cover/sm/" + obj.company_cover + "'></td>";

                    });

                    html += "</tr>";

                    $("#table_company_cover").html(html);
                } else {

                    $("#table_company_cover").html("Que tal adicionar uma capa ?");
                }

            }, error: Megaic.ajax.error

        });

    },


    registerLogo: function (form) {

        $(form).ajaxForm({
            beforeSubmit: function (formData, jqForm, options) {
                console.log(formData);
                Megaic.form.blockForm(form);
            },
            dataType: "json",
            success: function (data) {

                if (data[0].boolean) {

                    company.loadLogo();
                    Megaic.alert.notify(true, data[0].msg);
                    $(form).resetForm();

                } else {


                    Megaic.alert.notify(false, Megaic.form.returnError(data));

                }

                Megaic.form.desBlockForm(form);
            }, error: function (data) {
                Megaic.form.desBlockForm(form);

              Megaic.ajax.error(data);
            }
        });

    },


    registerCover: function (form) {

        $(form).ajaxForm({

            beforeSubmit: function (formData, jqForm, options) {
                console.log(formData);
                Megaic.form.blockForm(form);

            },
            dataType: "json",
            success: function (data) {

                if (data[0].boolean) {

                    company.loadCover();
                    Megaic.alert.notify(true, data[0].msg);
                    $(form).resetForm();

                } else {


                    Megaic.alert.notify(false, Megaic.form.returnError(data));

                }

                Megaic.form.desBlockForm(form);

            }, error: Megaic.ajax.error
        });

    },

    loadLogo: function () {

        var url = "/services/empresa/logo/";
        var data = {company_id: companyId};

        $.ajax({
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                var html = "<tr>";
                if (data.boolean) {

                    $.each(data.items, function (i, obj) {

                        html += "<td><img  class='img-responsive center-block' src='/img/company_logo/sm/" + obj.company_logo + "'></td>";

                    });

                    html += "</tr>";

                    $("#table_company_logo").html(html);
                } else {

                    $("#table_company_logo").html("Que tal adicionar um logo ?");
                }

            }, error: Megaic.ajax.error

        });

    }

};


$(function () {
    companyDepartment.registerForm("#form_company_department");
    companyPhone.registerForm("#form_company_phones");
    companyEmail.registerForm("#form_company_email");
    companyRelationSegment.registerForm("#form_company_segment");
    CompanySocialNetwork.registerForm("#form_company_social_network");
    companyRelationRegion.registerForm("#form_company_relationship_geo_region");
    company.registerCover("#form_company_cover");
    company.registerLogo("#form_company_logo");

    $('#company_segment_id').select2();
    $('#system_social_network_id').select2();

    companyRelationRegion.select2("#geo_region_id");

    companyDepartment.loadSelect();
    companyDepartment.loadTable();
    companyRelationRegion.loadTable();
    companyRelationSegment.loadSelect();
    companyPhone.loadTable();
    companyEmail.loadTable();
    company.loadLogo();
    company.loadCover();
    CompanySocialNetwork.loadSelect();
    CompanySocialNetwork.loadTable();
    CompanyGallery.loadTable();


});

// Iniciando biblioteca
var resize = new window.resize();
resize.init();

// Declarando variáveis
var imagens;
var imagem_atual;

// Quando carregado a página
$(function ($) {

    // Quando enviar o formulario
    $('#form_company_gallery').on('submit', function (event) {
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
    imagens = $('#company_gallery_file')[0].files;

    // Se selecionado pelo menos uma imagem
    if (imagens.length > 0) {
        // Definindo progresso de carregamento

        $('#company_gallery_progresso').attr('aria-valuenow', 0).css('width', '0%');

        // Escondendo campo de imagem
        $('#company_gallery_file').hide();

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
        $('#company_gallery_progresso').html('Imagen(s) enviada(s) com sucesso');

        // Limpando imagens
        limpar();

        // Exibindo campo de imagem
        $('#company_gallery_file').show();

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
    resize.photo(imagens[imagem_atual], 1000, 'dataURL', function (imagem) {

        var url = '/form/admin/empresa/galeria/cadastrar/';
        var data = {
            company_gallery_file: imagem,
            company_id: companyId
        };
        // Salvando imagem no servidor
        $.ajax({
            url: url,
            dataType: "json",
            type: "POST",
            data: data,
            success: function (data) {

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
                $('#company_gallery_progresso').text(Math.round(porcentagem) + '%').attr('aria-valuenow', porcentagem).css('width', porcentagem + '%');

                // Aplica delay de 1 segundo
                // Apenas para evitar sobrecarga de requisições
                // e ficar visualmente melhor o progresso
                setTimeout(function () {
                    // Passa para a próxima imagem
                    imagem_atual++;
                    redimensionar();
                }, 1000);
                CompanyGallery.loadTable();
            }
        });


    });
}

/*
 Limpa os arquivos selecionados
 */
function limpar() {
    var input = $("#company_gallery_file");
    input.replaceWith(input.val('').clone(true));

    $('#company_gallery_progresso').attr('aria-valuenow', 0).css('width', '0%');
}