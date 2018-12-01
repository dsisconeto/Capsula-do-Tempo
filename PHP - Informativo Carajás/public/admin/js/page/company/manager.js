/**
 * Created by dejai on 21/07/2016.
 */

var trava = 0;
$(function () {

    CKEDITOR.replace('company_description');

    $('#form_company_register').ajaxForm({
        beforeSerialize: function(form, options) {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
        },
        dataType: "json",
        delay: 3000,
        success: function (data) {

            if (data[0].boolean) {

                Megaic.alert.notify(true, data[0].msg);

                Megaic.location('/admin/empresa/todas/', 2000);

            } else {

                Megaic.alert.notify(false, Megaic.form.returnError(data));

            }
        }, error: Megaic.ajax.error
    })
    ;


});


$("#company_nivel").keypress(function () {
    companyLevel();
});

$("#company_nivel").click(function () {
    companyLevel();
});

$("#company_nivel").keydown(function () {
    companyLevel();
});

function companyLevel() {
    var url = "/form/admin/empresa/";

    var companyNivel = $("#company_nivel").val();

    if (edit) {

        url += "editar/";

    } else {

        url += "cadastrar/";

    }

    if (companyNivel == 1) {
        url += "simples/";
        $("#company_cnpj_or_cpf").attr("disabled", "disabled");
        $("#company_name").attr("disabled", "disabled");
        $("#company_address_embed").attr("disabled", "disabled");
        $("#system_url_url").attr("disabled", "disabled");
        $("#post").hide(500);

    } else {
        url += "completo/";

        if (userCompany) {

            $("#company_cnpj_or_cpf").attr("disabled", "disabled");
            $("#company_name").attr("disabled", "disabled");
            $("#system_url_url").attr("disabled", "disabled");


        } else {

            $("#company_cnpj_or_cpf").removeAttr("disabled", "disabled");
            $("#company_name").removeAttr("disabled", "disabled");
            $("#company_address_embed").removeAttr("disabled", "disabled");
            $("#system_url_url").removeAttr("disabled", "disabled");
            $("#post").show(500);
        }


    }

    $("#form_company_register").attr("action", url);

}