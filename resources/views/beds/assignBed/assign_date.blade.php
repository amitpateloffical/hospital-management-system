<div class="badge bg-light-info">
    <div class="mb-2">{{ \Carbon\Carbon::parse($row->assign_date)->isoFormat('LT')}}</div>
    <div>{{ \Carbon\Carbon::parse($row->assign_date)->translatedFormat('jS M, Y')}}</div>
</div>
