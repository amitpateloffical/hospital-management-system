<div class="d-flex align-items-center">
    <a href="{{route('lab-technicians.edit',$row->id)}}" title="<?php echo __('messages.common.edit') ?>"
        class="btn px-2 text-primary fs-3 ps-0">
         <i class="fa-solid fa-pen-to-square"></i>
     </a>
     <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}"
        class="deleteTechnicianBtn btn px-2 text-danger fs-3 ps-0">
         <i class="fa-solid fa-trash"></i>
     </a>
</div>

