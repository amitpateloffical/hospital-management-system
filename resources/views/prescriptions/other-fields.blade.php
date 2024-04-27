<div class="row gx-10 mb-5">
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('test', __('messages.prescription.test').(':'), ['class' => 'form-label']) }}
            {{ Form::textarea('test', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => __('messages.prescription.test')]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('advice', __('messages.prescription.advice').(':'), ['class' => 'form-label']) }}
            {{ Form::textarea('advice', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => __('messages.prescription.advice')]) }}
        </div>
    </div>
    <div class="col-md-10">
        <div class="form-group row mb-5">
            {{ Form::label('next_visit', __('messages.prescription.next_visit').(':'), ['class' => 'form-label']) }}
            <div class="col-md-1">
                {{ Form::number('next_visit_qty', null, ['class' => 'form-control', 'placeholder'=>'1']) }}
            </div>
            <div class="col-md-11">
                {{ Form::select('next_visit_time',\App\Models\Prescription::TIME_ARR, null, ['class' => 'form-select','required','id' => 'prescriptionTime']) }}
            </div>
        </div>
    </div>
</div>
<div class="float-end">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'btnSave']) !!}
    <a href="{!! route('prescriptions.index') !!}"
       class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
</div>
