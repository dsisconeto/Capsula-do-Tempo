$(function () {


    var options = {
        dataType: "json",
        success: function (data) {

            console.log(data);
            var html = "";
            $("#table_permission").html(html);

            if (data.boolean) {
                var user = data.items.user;
                $.each(data.items.user_login, function (i, login) {
                    var issetRegion = user[login.geo_region_id];
                    var perRegion;
                    issetRegion ? perRegion = user[login.geo_regoin_id] : false;

                    html += "<tr>";
                    html += "<td>" + login.geo_region_name + "</td>";
                    html += "<td>";

                    html += '<label class="checkbox-inline" id="check_event">';
                    html += '<input type="checkbox"';
                    (issetRegion) && perRegion.event == "1" ? html += "checked='checked' " : false;

                    html += 'id="event" value="1" name="event"> Eventos </label>';
                    //
                    html += "<label class=\"checkbox-inline\"> <input type=\"checkbox\" ";
                    (issetRegion) && perRegion.news == "1" ? html += "checked='checked' " : false;
                    html += "id=\"news\" value=\"1\"> Notícias </label>";
                    //
                    html += "<label class=\"checkbox-inline\"> <input type=\"checkbox\" ";
                    user.newspaper == "1" ? html += "checked='checked' " : false;
                    html += "id=\"newspaper\" value=\"1\">  Jornais Impresso </label>";

                    //
                    html += "<label class=\"checkbox-inline\"> <input type=\"checkbox\" ";
                    (issetRegion) && perRegion.ads == "1" ? html += "checked='checked' " : false;
                    html += "id=\"ads\" value=\"1\"> Empresas </label>";

                    html += "<label class=\"checkbox-inline\"> <input type=\"checkbox\" ";
                    (issetRegion) && perRegion.company == "1" ? html += "checked='checked' " : false;
                    html += "id=\"company\" value=\"1\"> Anúncios </label>";
                    html += "</td>";
                    html += "<td><button class='btn btn-primary' type='submit'>Editar</button></td>";

                    html += "</tr>";


                });


            }

            $("#table_permission").html(html);

        }, error: Megaic.ajax.error
    };

    $("#search_region").ajaxForm(options);

    $("#search_region").ajaxSubmit(options);
});

