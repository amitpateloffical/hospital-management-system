document.addEventListener('turbo:load', loadPaymentReportDate)

function loadPaymentReportDate() {
    $('#filterPaymentAccount').select2({
        width: '100%',
    });
}

listenChange('#filterPaymentAccount', function () {
    Livewire.dispatch('changeFilter', {statusFilter: $(this).val()})
})

listenClick('#resetPaymentReportFilter', function () {
    $('#filterPaymentAccount').val(0).trigger('change');
    hideDropdownManually($('#paymentReportFilter'), $('.dropdown-menu'))
})
