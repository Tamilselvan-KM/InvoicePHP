$(document).on('click', '.delClient', function () {
    $(this).closest('tr').remove();
    calculateTotal();
});