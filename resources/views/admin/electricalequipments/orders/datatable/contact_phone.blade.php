@adminaccessroutename('admin.electrical_equipment_order.edit')
    <a href="{{ route('admin.electrical_equipment_order.edit', $id) }}">{{ $contact_phone }}</a>
@elseadminaccessroutename
    <span>{{ $contact_phone }}</span>
@endadminaccessroutename
