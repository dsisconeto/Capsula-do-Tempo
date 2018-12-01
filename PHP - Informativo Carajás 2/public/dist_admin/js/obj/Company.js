/**
 * Created by dejai on 07/09/2016.
 */


var Company = {

    updateStatus: function (companyId, companyStatus, element, fun) {

        $.ajax({
            data: {company_id: companyId, company_status: companyStatus},
            url: "/form/admin/empresa/status/",
            dataType: "json",
            method: "post",
            success: function (data) {

                if (data[0].boolean) {

                    if (fun) {
                        fun();
                    } else {

                        if (companyStatus == 1) {

                            $(element).html("<i class=\"fa fa-times\" aria-hidden=\"true\"></i> Desativar");
                            $(element).attr("onclick", "Company.updateStatus(" + companyId + ", 0, this)");

                            if ($(element).hasClass("btn-primary")) {
                                $(element).removeClass("btn-success");
                            }
                            $(element).addClass("btn-danger");


                        } else {

                            if ($(element).hasClass("btn-danger")) {
                                $(element).removeClass("btn-danger");
                            }
                            $(element).addClass("btn-success");

                            $(element).html("<i class=\"fa fa-check\" aria-hidden=\"true\"></i> Ativar");
                            $(element).attr("onclick", "Company.updateStatus(" + companyId + ", 1, this)");

                        }
                    }


                } else {

                    Megaic.alert.notify(false, data[0].msg);

                }


            },
            error: Megaic.ajax.error
        });


    }
};