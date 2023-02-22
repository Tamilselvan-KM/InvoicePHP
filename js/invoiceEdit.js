var rowCount = $(".itemList").length;
$(document).on('click', '#addRow', function () {
    rowCount++;
    var htmlRows = '';
    htmlRows += '<tr>';
    htmlRows += '<td style="color:#dc3545;padding:5px;" class="itemList"><i class="fa-solid fa-trash" style="margin:15px 0"></i></td>';
    htmlRows += '<td><div class="mb-3"><input type="text" class="form-control" name="itemName[]" id="product_' + rowCount + '" placeholder="Item Name & Description"></div></td>';
    htmlRows += '<td><div class="mb-3"><input type="number" class="form-control"  name="itemQuantity[]" placeholder="Quantity" id="quantity_' + rowCount + '"></div></td>';
    htmlRows += '<td><div class="mb-3"><input type="number" class="form-control" name="itemRate[]"  placeholder="Rate" id="rate_' + rowCount + '"></div></td>';
    htmlRows += '<td><div class="mb-3"><input type="number" class="form-control" name="itemAmt[]" placeholder="0.00" id="amount_' + rowCount + '" value="0"></div></td>';
    htmlRows += '</tr>';
    $('#invoiceItems').append(htmlRows);
});

//delete row
$(document).on('click', '.itemList', function () {
    $(this).closest('tr').remove();
    calculateTotal();
});
//table input changes
$(document).on('keyup', "[id^=quantity_]", function () {
    calculateTotal();
});
$(document).on('keyup', "[id^=rate_]", function () {
    calculateTotal();
});
$(document).on('keyup', "#taxValue", function () {
    calculateTotal();
});
$(document).on('keyup', "#discountValue", function () {
    calculateTotal();
});
function calculateTotal() {
    var total = 0;
    var subTotal = 0;
    $("[id^=rate_]").each(function () {
        var id = $(this).attr('id');
        id = id.replace("rate_", '');
        var rate = $("#rate_" + id).val();
        var quantity = $("#quantity_" + id).val();
        if (!quantity || quantity < 0) {
            quantity = 1;
        }
        var amount = rate * quantity;
        $("#amount_" + id).val(parseFloat(amount));
        subTotal += amount;
        total += amount;

        $("#st").val(parseFloat(subTotal));
        $("#gt").val(parseFloat(total));
        var taxValue = $("#taxValue").val();
        var discountValue = $("#discountValue").val();
        // var subTotal = $("#st").val();
        if (taxValue) {
            var taxedRate = (parseFloat($("#gt").val()) * taxValue) / 100;
            taxedTotal = parseFloat($("#gt").val()) + taxedRate;
            roundOfvalue = parseInt(taxedTotal);
            $("#rt").val(parseFloat(roundOfvalue - taxedTotal).toFixed(2));
            $("#gt").val(roundOfvalue);
        }
        if (discountValue) {

            var discountedRate = (parseFloat($("#gt").val()) * discountValue) / 100;
            discountedTotal = parseFloat($("#gt").val()) - discountedRate;
            roundOfvalue = parseInt(discountedTotal);
            $("#rt").val(parseFloat(roundOfvalue - discountedTotal).toFixed(2));
            $("#gt").val(roundOfvalue);
        }

    });
}
