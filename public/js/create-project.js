function togglePaymentField() {
    var negotiableRadio = document.getElementById('negotiable');
    var paymentField = document.getElementById('paymentField');
    var negotiableText = document.getElementById('negotiableText');

    if (negotiableRadio.checked) {
        paymentField.style.display = 'none';
        negotiableText.style.display = 'block';
    } else {
        paymentField.style.display = 'block';
        negotiableText.style.display = 'none';
    }
}
