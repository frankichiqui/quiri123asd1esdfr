/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var cancel = $('<button/>').attr('type', 'button').attr('class', 'btn .btn-default').attr('data-dismiss', 'modal').html('Cancel');
var progress_bar_active = '<div class="progress "><div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active"><span class="sr-only">Process</span></div></div>';

function formAjax(e, form) {
    e.preventDefault();

    showDialog(true, 'Processing your request...Please wait');
    var formSerialize = form.serialize();
    $.post($(form).attr('action'), formSerialize,
            function (data) {
                if (data.success) {
                    setContentDialog(data.content, '<b>' + data.title + '</b>');
                    form.find('button[type="submit"]').attr('disabled', 'disabled');
                    UpdateCart();
                } else {
                    console.log("error");
                }
            }, 'JSON');
}
function showDialog(ajaxinit, title, content) {
    modal = $('#generic_modal');
    modal.find('#title-modal').html(title);
    if (ajaxinit) {
        modal.find('.progress').removeClass('hidden');

        modal.modal({
            keyboard: false
        });
    }

}
function hideDialog() {
    modal = $('#generic_modal');
    modal.modal({
    });
    modal.modal('hide');

}
function setContentDialog(content, title) {
    modal = $('#generic_modal');
    modal.find('#title-modal').html(title);
    modal.find('.modal-body').html(content);
}
function showConfirDialog(path, text) {
    modal = $('#generic_modal');
    modal.find('.progress').addClass('hidden');
    modal.find('#title-modal').html('Confirm');
    modal.find('.modal-body').html(text);
    ok = $('<button/>').attr('type', 'button').attr('class', 'btn btn-success').html('Ok, Proced');
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
                    UpdateCart();
                    addCustomButtton(null, 'btn-success', null);
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
    modal.find('.modal-footer').empty();
    modal.find('.modal-footer').append(ok);
    modal.find('.modal-footer').append(cancel);
    modal.modal('show');

}
function showConfirDialogCartDetailDeleteAll(path, text, that) {
    modal = $('#generic_modal');
    modal.find('.progress').addClass('hidden');
    modal.find('#title-modal').html('Confirm');
    modal.find('.modal-body').html(text);
    ok = $('<button/>').attr('type', 'button').attr('class', 'btn btn-success').html('Ok, Proced');

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
                    UpdateCart();
                    addCustomButtton(null, 'btn-success', null);
                    that.parentsUntil('.content-wrapper').find('div.box').slideUp();
                    $('.well-small.form-actions').slideUp();
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
    modal.find('.modal-footer').empty();
    modal.find('.modal-footer').append(ok);
    modal.find('.modal-footer').append(cancel);
    modal.modal('show');
}
function showConfirDialogCartDetailDeleteItem(path, text, that) {
    modal = $('#generic_modal');
    modal.find('.progress').addClass('hidden');
    modal.find('#title-modal').html('Confirm');
    modal.find('.modal-body').html(text);
    ok = $('<button/>').attr('type', 'button').attr('class', 'btn btn-success').html('Ok, Proced');

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
                    UpdateCart();
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
    modal.find('.modal-footer').empty();
    modal.find('.modal-footer').append(ok);
    modal.find('.modal-footer').append(cancel);
    modal.modal('show');

}
function setContentByError() {
    modal = $('#generic_modal');
    modal.find('.modal-body').html('<i class="fa fa-error"> </i> Estamos teniendo error en la comunicacion con el servidor..');

}

function setConteDialogByProgressBar() {
    modal = $('#generic_modal');
    modal.find('#title-modal').html('Removing items');
    modal.find('.modal-body').html(progress_bar_active);

}
function setConteDialogByProgressBarLoading() {
    modal = $('#generic_modal');
    modal.find('#title-modal').html('Loading...');
    conte = modal.find('.modal-body').html();


    modal.find('.modal-body').html(progress_bar_active);

}

function bottomLoading() {
   
}
function disableAllBottons() {
    modal = $('#generic_modal');
    modal.find('.modal-footer button').attr('disabled', true);
}
function enableAllBottons() {
    modal = $('#generic_modal');
    modal.find('.modal-footer button').attr('disabled', false);

}
function deleteAllBottons() {
    modal = $('#generic_modal');
    modal.find('.modal-footer').empty();
    modal.find('.modal-footer').append(cancel.html('Ok'));
}
function OnlyCancelBotton() {
    modal = $('#generic_modal');
    modal.find('.modal-footer').empty();
    modal.find('.modal-footer').append(cancel.html('Cancel'));
}
function addCustomButtton(text, type, onclick) {
    if (text != null) {
        cancel.html(text);
    }
    if (type != null) {
        cancel.removeClass('btn-default').addClass(type);
    }
    if (onclick != null) {
        cancel.html(text).onclik = onclik;
    }
    return cancel;
}
function ajax_function(url, data, success_function, error_function, complete_function) {
    $.ajax({
        // la URL para la petición
        url: url,
        // la información a enviar
        // (también es posible utilizar una cadena de datos)
        data: data,
        // especifica si será una petición POST o GET
        type: 'POST',
        // el tipo de información que se espera de respuesta
        dataType: 'json',
        // código a ejecutar si la petición es satisfactoria;
        // la respuesta es pasada como argumento a la función
        success: success_function(data),
        // código a ejecutar si la petición falla;
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error: error_function(xhr, status),
        // código a ejecutar sin importar si la petición falló o no
        complete: complete_function(xhr, status)
    });
}

 