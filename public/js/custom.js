var lastBillNumber = 1;

$('body').on('focus', '.bill-date', function() {
    $(this).datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd.mm.yyyy',
    });
});

function loadUrl(url) {
    $('#add-modal .modal-content').load(url, function() {
        calcFeeAmount();
        $('#add-modal').modal('show');
    });
}

function calcFeeAmount() {
    var feeAmount = $('#amount').val() * $('#fee').val() / 100;
    $('#feeAmount').val(numeral(feeAmount).format('0,0.00') + ' €');
    $('.bill-amount').attr('max', feeAmount);
    checkMaxFee();
}

function checkMaxFee() {
    var billSum = 0;
    var totalFee = numeral($('#feeAmount').val()).value();
    $('.bill-amount').each(function(i, obj){
        billSum += numeral($(obj).val()).value();
        var n = i+1;
        var billPercent = numeral(numeral($(obj).val()).value() * 100 / totalFee).format('0.00');
        $('#bill'+n+' .bill-percent').val(billPercent);
    });
    if(billSum > totalFee) {
        $('.alert-danger').show();
        $('.alert-danger').html('<p>Bill sum exceeded total fee amount.</p>');
        return false;
    } else {
        $('.alert-danger').hide();
        $('.alert-danger').html('');
    }
    return true;
}

function addBill() {
    var billNumber = lastBillNumber + 1;
    $('.bills').append('<fieldset id="bill'+billNumber+'">' + $('#bill' + lastBillNumber).html() + '</fieldset>');
    $('#bill'+billNumber+' legend').text('Bill ' + billNumber);
    $('#bill'+billNumber+' input').val('');
    lastBillNumber = billNumber;
}