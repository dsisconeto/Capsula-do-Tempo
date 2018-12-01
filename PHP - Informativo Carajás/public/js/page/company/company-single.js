$("#form_email").ajaxForm({
    dataType: "json",
    success: function (data) {
        Megaic.form.processReturnNoty(data);
    }, error: Megaic.ajax.error

});

document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};