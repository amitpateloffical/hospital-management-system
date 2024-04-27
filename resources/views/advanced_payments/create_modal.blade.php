<div id="addAdvancedPaymentModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.advanced_payment.new_advanced_payment') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addNewAdvancedPaymentForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationAdvancePaymentErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('patient_id', __('messages.advanced_payment.patient').(':'), ['class' => 'form-label required']) }}
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select form-select-solid fw-bold', 'id' => 'advancedPaymentPatientId','placeholder' => 'Select Patient', 'required','data-control' => 'select2']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('receipt_no', __('messages.advanced_payment.receipt_no').(':'),['class' => 'form-label required']) }}
                        {{ Form::text('receipt_no', null, ['class' => 'form-control advancedPaymentReceiptNo','required','readonly','id'=>'advancedPaymentReceiptNo', 'placeholder' => __('messages.advanced_payment.receipt_no')]) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('amount', __('messages.advanced_payment.amount').(':'),['class' => 'form-label required']) }}
                        {{ Form::text('amount', null, ['class' => 'form-control decimal-number','required', 'maxlength' => '7', 'placeholder' => __('messages.advanced_payment.amount')]) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('date', __('messages.advanced_payment.date').(':'),['class' => 'form-label required']) }}
                        {{ Form::text('date', null, ['class' => 'form-control bg-white','required','id' => 'advancedPaymentDate', 'autocomplete' => 'off', 'placeholder' => __('messages.advanced_payment.date')]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'advancedPaymentBtnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
