/**
 * Created by Lisman TS on 9/9/2016.
 */
$(function () {
    $('#modalButton').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});