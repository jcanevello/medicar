jQuery(document).ready(function ($) {

    $('.select-parent3').change(function () {
        var $this = $(this)
        var child = $this.data('childid')
        $this.get_data(child)
        var child_child = $('#' + child).data('childid')
        if (child_child)
            $('#' + child_child).select()
    })

    $('.select-selected').each(function () {
        var $this = $(this)
        $this.select()
        if ($this.hasClass('select-parent3'))
            $this.trigger('change')
    });

    $('.modal-ajax').on('show.bs.modal', function (e) {
        $(this).modal_ajax();
    })

    $('.modal').on('show.bs.modal', function (e) {
        $('html').css('overflow', 'hidden')
    })

    $('.modal').on('hidden.bs.modal', function (e) {
        $('html').css('overflow', 'auto')
        $('.modal-body').html('<span>Cargando...</span>');
        if ($(this).children('.modal-dialog').hasClass('modal-reload..'))
            window.location.reload(true)
    })

    $('.inactive').each(function () {
        $(this).remove()
    })

    $('#sidebar-menu').removeClass('hidden')

    $('.btn-modal-global').modal2_ajax()

    $('body').on('submit', '#search-surety', function () {
        var $this = $(this)
        var id_request = $this.data('id')

        $.ajax({
            type: "POST",
            url: '/credit/surety/' + id_request,
            data: {s: $('#surety_search').val()},
            dataType: 'json',
            success: function (response) {
                if (response.status == 'OK') {
                    $('#result-search-surety').html(response.data)
                    $('.btn-garante[type=submit]').attr('disabled', false)
                } else
                {
                    alert('Se ha presentado un error al obtener los datos.')
                }
            }
        });
        return false;
    })

    $('body').on('submit', '#search-pareja', function () {
        var $this = $(this)
        var id_client = $this.data('id')

        $.ajax({
            type: "POST",
            url: '/client/resultSearch/' + id_client,
            data: {s: $('#pareja_search').val()},
            dataType: 'json',
            success: function (response) {
                if (response.status == 'OK') {
                    $('#result-search-pareja').html(response.data)
                    $('.btn-garante[type=submit]').attr('disabled', false)
                } else
                {
                    alert('Se ha presentado un error al obtener los datos.')
                }
            }
        });
        return false;
    })

    $('body').on('submit', 'form', function () {
        $(this).find('button[type=submit]').attr('disabled', 'disabled')
    })

    $('body').on('submit', 'form.btn-no-disabled', function () {
        $(this).find('button[type=submit]').removeAttr('disabled')
    })

    /*
     * Mostrar mensajes de error
     */
    if ($('.msj-show').length)
    {
        var tipo = $('.msj-show').data('type')

        switch (tipo)
        {
            case "error":
                showError($('.msj-show').val());
                break;
            case "info":
                showInfo($('.msj-show').val());
                break;
            case "success":
                showSuccess($('.msj-show').val());
                break;
            case "warning":
                showWarning($('.msj-show').val());
                break;
            default:
                showWarning($('.msj-show').val())
                break;
        }

    }/*Fin*/


});

function showError(msj)
{
    $.Notification.notify('error', 'top center', 'Mensaje de Error', msj)
}
function showInfo(msj)
{
    $.Notification.notify('info', 'top center', 'Mensaje', msj)
}
function showSuccess(msj)
{
    $.Notification.notify('success', 'top center', 'Mensaje', msj)
}
function showWarning(msj)
{
    $.Notification.notify('warning', 'top center', 'Mensaje', msj)
}

$.fn.extend({
    resetSession: function () {
        var sto = sessionStorage.getItem('exc')

        if (sto)
            sessionStorage.removeItem('exc')
    },
    verificarActivarBotonConfirm: function () {
        var sto = sessionStorage.getItem('exc')

        if (sto)
        {
            data = JSON.parse(sto)

            if (data.e.length >= $('.exc').length)
                if ($('#btn-submit-confirmation').length <= 0)
                    $('.block-submit-confirm').append('<button class="btn btn-success waves-effect waves-light" id="btn-submit-confirmation" type="submit">Confirmar</button>')


//                    console.log('activar boton')
//                } else
//                    console.log('el boton ya está activado')
//            else
//                console.log('no activar boton')
        }
    },
    expireSession: function (exc) {
        var sto = sessionStorage.getItem(exc)

        if (sto)
        {
            data = JSON.parse(sto)
            fecha = data.f

            var now = $.now()
            var min_fecha = fecha / 60000
            var min_now = now / 60000

            if ((min_now - min_fecha) > 10)
                sessionStorage.removeItem(exc)
        }
    },
    addStorage: function (id_client, exc) {

        var sto = sessionStorage.getItem('exc')
        var array_exc = [];
        var data = null

        if (sto)
        {
            data = JSON.parse(sto)
            array_exc = data.e

            if (data.c == id_client)
            {
                if (array_exc.indexOf(exc) < 0)
                {
                    array_exc.push(exc)
                    $.extend(data.exc, array_exc)
                } else
                {
//                    alert('la excepción ya fue incluida a la lista')
                }
            } else
            {
                data = {
                    c: id_client,
                    e: [exc],
                    f: (new Date()).getTime()
                }
            }
        } else
        {
            data = {
                c: id_client,
                e: [exc],
                f: (new Date()).getTime()
            }
        }

        sessionStorage.setItem('exc', JSON.stringify(data))
    },
    getStorageExc: function () {
        return sessionStorage.getItem('exc')
    },
    select: function (data) {
        var $this = $(this)
        if (!data)
            data = $this.data('info');
        $this.find('option').remove()
        $this.append('<option value="">---</option>')
        var selected = $this.data('selected')
        if (data)
            $.each(data, function (index, value) {
                if (index == selected)
                    $this.append('<option value="' + index + '" selected="selected">' + value + '</option>')
                else
                    $this.append('<option value="' + index + '">' + value + '</option>')
            })
    },
    get_data: function (child) {
        var selected = $(this).val() ? $(this).val() : $(this).data('selected')
        var action = $(this).data('action') ? $(this).data('action') : '/main/ajax'
        var exc = $(this).data('exc') ? $(this).data('exc') : '1'

        $.ajax({
            type: "POST",
            url: action,
            data: {id: selected, exc: exc},
            dataType: 'json',
            success: function (response) {
                if (response.status == 'ERROR')
                    alert('Se ha presentado un error al obtener los datos.')
                else
                    $('#' + child).select(response.data)
            }
        });
    },
    delete: function () {
        $(this).click(function (e) {
            e.stopPropagation()
//            jConfirm('Can you confirm this?', 'Confirmation Dialog', function (r) {
//                jAlert('Confirmed: ' + r, 'Confirmation Results');
//            });
            alert('¿Está seguro de esta acción?')
        })
    },
    get_input_waytopay: function () {
        $(this).change(function () {
            $('.request-form').on('load', '#box-input-pay')
            $('#box-input-pay').load('/pay/get_pay/' + $(this).val(), function (response, status, xhr) {
                if (status == 'success')
                    $(this).html(response)
                else
                    alert('error en las formas de pago')
            })
        })
    },
    get_input_waytopay2: function () {
        $(this).change(function () {
            $('.request-form').on('load', '#box-input-pay')
            $('#box-input-pay').load('/pay/get_pay2/' + $(this).val(), function (response, status, xhr) {
//                console.log('asdS')
                if (status == 'success')
                    $(this).html(response)
                else
                    alert('error en las formas de pago')
            })
        })
    },
    modal_ajax: function () {
        var action = $(this).data('action') ? $(this).data('action') : '/main/ajax'

        $(this).find('.modal-body').load(action, function (response, status, xhr) {
            if (status != 'success')
                alert('error al obtener los datos')
        })
    },
    modal2_ajax: function () {
        $(this).click(function () {
            var action = $(this).data('action') ? $(this).data('action') : '/main/ajax'
            var title = $(this).data('title') ? $(this).data('title') : 'Progresa'
            var id_modal = $(this).data('target') ? $(this).data('target') : '#modal-global'
//            var size = $(this).data('size') ? $(this).data('size') : ''
            $(id_modal + ' .modal-title').html(title);
            $(this).data('size') ? $(id_modal + ' .modal-dialog').addClass($(this).data('size')) : $(id_modal + ' .modal-dialog').removeClass().addClass('modal-dialog')

            $(id_modal + ' .modal-body').load(action, function (response, status, xhr) {
                if (status != 'success')
                    alert('error al obtener los datos')
            })
        })
    },
    inputNumeric: function () {
        $(this).keypress(function (e) {
            console.log($.isNumeric(e.key))
        })
    }
})