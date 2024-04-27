<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\OperationReport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OperationTable extends LivewireTableComponent
{
    protected $model = OperationReport::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'operation_reports.add-button';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    // public function resetPage($pageName = 'page')
    // {
    //     $rowsPropertyData = $this->getRows()->toArray();
    //     $prevPageNum = $rowsPropertyData['current_page'] - 1;
    //     $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
    //     $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

    //     $this->setPage($pageNum, $pageName);
    // }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('operation_reports.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.operation_report.case_id'), 'case_id')
                ->view('operation_reports.columns.case_id')
                ->sortable()->searchable(),
            Column::make(__('messages.case.patient'), 'patient_id')->hideIf(1),
            Column::make(__('messages.case.patient'), 'patient.patientUser.first_name')
                ->view('operation_reports.columns.patient_name')
                ->sortable(),
            Column::make('email', 'patient.patientUser.email')->searchable()->hideIf(1),
            Column::make('last_name', 'patient.patientUser.last_name')->searchable()->hideIf(1),
            Column::make(__('messages.case.doctor'), 'doctor.doctorUser.first_name')
                ->view('operation_reports.columns.doctor_name')
                ->sortable()->searchable(),
            Column::make(__('messages.case.patient'), 'doctor_id')->hideIf(1),
            Column::make('email', 'doctor.doctorUser.email')->searchable()->hideIf(1),
            Column::make('last_name', 'doctor.doctorUser.last_name')->searchable()->hideIf(1),
            Column::make(__('messages.operation_report.date'), 'date')
                ->view('operation_reports.columns.date')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('operation_reports.action'),
        ];
    }

    public function builder(): Builder
    {
        if (! getLoggedinDoctor()) {
            $query = OperationReport::where('operation_reports.tenant_id', '=', getLoggedInUser()->tenant_id)->with('patient', 'doctor', 'caseFromOperationReport');
        } else {
            $doctorId = Doctor::where('user_id', getLoggedInUserId())->first();
            $query = OperationReport::with('patient', 'doctor', 'caseFromOperationReport')->where('doctor_id',
                $doctorId->id);
        }

        return $query;
    }
}
