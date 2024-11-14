<div class="mt-3 table-responsive position-relative">
    <div class="text-end">
        @adminaccessroutename('admin.customer_contact.create')
        @if($customer->isCreator())
            <button type="button" data-route="{{ route('admin.customer_contact.create', $customer->id) }}" class="btn btn-primary open-modal-form">
                <i class="ti ti-plus"></i>
                <span>@lang('Add contact')</span>
            </button>
        @endif
        @endadminaccessroutename
    </div>
    {{ $customer_contact_datatable->table(['class' => 'table table-bordered'], true) }}
</div>