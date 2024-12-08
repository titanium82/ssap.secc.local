@adminaccessroutename('admin.electrical_equipment_order.edit')
<button type="button" data-route="{{ route('admin.electrical_equipment_order.edit', $id) }}" class="btn btn-icon btn-warning open-modal-form">
    <i class="ti ti-edit"></i>
</button>
@endadminaccessroutename
@adminaccessroutename('admin.electrical_equipment_order.delete')
    <button class="btn btn-icon btn-danger open-modal-delete" data-load-dt="true" data-table-id="electrical_equipment_order'" data-route="{{ route('admin.electrical_equipment_order.delete', $id) }}" data-target="#modalAjaxDelete">
        <i class="ti ti-trash"></i>
    </button>
@endadminaccessroutename
