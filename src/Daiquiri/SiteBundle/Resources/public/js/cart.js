var cancel = $('<button/>').attr('type', 'button').attr('class', 'mfp-close1 btn .btn-default margin-left-40').attr('data-dismiss', 'modal').html('Cancel');
var progress_bar_active = '<div class="progress "><div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active"><span class="sr-only">Process</span></div></div>';

function formAjaxFront(e, form) {
    e.preventDefault();
    //setContentByError();
    genericModal(true, 'Processing your request', 'Please wait...');
    var formSerialize = form.serialize();
    $.post($(form).attr('action'), formSerialize,
            function (data) {
                if (data.success) {
                    setContentDialog(data.content, data.title);
                    form.find('button[type="submit"]').attr('disabled', 'disabled');
                    UpdateCartFront();
                } else {
                    console.log("error");
                }
            }, 'JSON');
}



function genericModal(ajaxinit, title, content) {
    modal = $('#generic_modal');
    modal.find('#title_modal').html(title);
    modal.find('.body_modal').html('<div class="row" style="margin-left:1.5%"><h4>' + content + '</h4></div>');
    if (ajaxinit) {
    }
    $('#a_modal').click();
}

function confirmationModal(ajaxinit, title, content) {
    modal = $('#confirmation_modal');
    modal.find('#title_modal').html(title);
    modal.find('.body_modal').html('<div class="row" style="margin-left:1.5%"><h4>' + content + '</h4></div>');
    if (ajaxinit) {
    }
    $('#c_modal').click();
}


function setContentDialog(content, title) {
    modal = $('#generic_modal');
    modal.find('#title_modal').html(title);
    modal.find('.body_modal').html(content);
}

function setContentByError() {
    modal = $('#generic_modal');
    modal.find('#title_modal').html('Conection Error');
    modal.find('.body_modal').html('<div class="row" style="margin-left:1.5%"><i class="fa fa-error"> </i> Estamos teniendo error en la comunicacion con el servidor...</div>');

}


function showConfirDialogCartDetailDeleteAllFront(path, title, content, that, url) {
    confirmationModal(true, title, content);
    ok = $('<button/>').attr('type', 'button').attr('class', 'mfp-close1 btn btn-success').html('Ok, Proced');

    ok.click(function () {
        setConteDialogByProgressBar();
        $.ajax({
            // la URL para la petición
            url: path,
            // especifica si será una petición POST o GET
            type: 'POST',
            // el tipo de información que se espera de respuesta
            dataType: 'json',
            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success: function (data) {
                if (data.success) {
                    setContentDialog(data.msg, 'Successfull');
                    deleteAllBottons();
                    UpdateCartFront();
                    addCustomButtton(null, 'btn-success', null);
                    that.parentsUntil('.content-wrapper').find('div.box').slideUp();
                    $('.well-small.form-actions').slideUp();
                    window.location = url;
                    //console.log(that.parentsUntil('.item_cart'));
                }
            },
            // código a ejecutar si la petición falla;
            // son pasados como argumentos a la función
            // el objeto de la petición en crudo y código de estatus de la petición
            error: function (xhr, status) {
                setContentByError();
                console.log('xhr: ' + xhr);
                console.log('status: ' + status);
            }
            // código a ejecutar sin importar si la petición falló o no
            //complete: complete_function(xhr, status)
        });
    });
    modal.find('.modal_footer').empty();   
    modal.find('.modal_footer').append(ok);
    modal.find('.modal_footer').append(cancel);    
}
function showConfirDialogCartDetailDeleteItemFront(path, title, content, that) {
    console.log("akiiii")
    confirmationModal(true, title, content);
    ok = $('<button/>').attr('type', 'button').attr('class', 'mfp-close1 btn btn-success').html('Ok, Proced');

    ok.click(function () {
        setConteDialogByProgressBar();
        $.ajax({
            // la URL para la petición
            url: path,
            // especifica si será una petición POST o GET
            type: 'POST',
            // el tipo de información que se espera de respuesta
            dataType: 'json',
            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success: function (data) {
                if (data.success) {
                    setContentDialog(data.msg, 'Successfull');
                    deleteAllBottons();
                    UpdateCartFront();
                    addCustomButtton(null, 'btn-success', null);
                    id = that.attr('id');
                    $('div[data-id="' + id + '"]').slideUp();
                    updateValues();
                    // console.log(that.parentsUntil('.item_cart'));
                }
            },
            // código a ejecutar si la petición falla;
            // son pasados como argumentos a la función
            // el objeto de la petición en crudo y código de estatus de la petición
            error: function (xhr, status) {
                setContentByError();
                console.log('xhr: ' + xhr);
                console.log('status: ' + status);
            }
            // código a ejecutar sin importar si la petición falló o no
            //complete: complete_function(xhr, status)
        });
    });
     
    modal.find('.modal_footer').empty();
    modal.find('.modal_footer').append(ok);
    modal.find('.modal_footer').append(cancel);
}

function setConteDialogByProgressBar() {
    modal = $('#confirmation_modal');
    modal.find('#title_modal').html('Removing items');
    modal.find('.body_modal').html(progress_bar_active);

}
function setConteDialogByProgressBarLoading() {
    modal = $('#confirmation_modal');
    modal.find('#title_modal').html('Loading...');
    conte = modal.find('.body_modal').html();
    modal.find('.body_modal').html(progress_bar_active);
}