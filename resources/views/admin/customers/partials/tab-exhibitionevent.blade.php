<div class="mt-3 table-responsive position-relative">
    <div class="text-end">
        @adminaccessroutename('admin.exhibition_event.create')
            <a href="{{ route('admin.exhibition_event.create', $customer->id) }}" class="btn btn-primary">
                <i class="ti ti-plus"></i>
                <span>@lang('Add Exhibition Event')</span>
            </a>
        @endadminaccessroutename
    </div>
    {{ $customer_exhibitionevent_datatable->table(['class' => 'table table-bordered'], true) }}
</div>
