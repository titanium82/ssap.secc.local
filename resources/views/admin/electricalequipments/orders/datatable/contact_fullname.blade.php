@adminaccessroutename('admin.electrical_equipment_order.edit')
    <a href="{{ route('admin.electrical_equipment_order.edit', $id) }}">{{ $contact_fullname }}</a>
@elseadminaccessroutename
    <span>{{ $contact_fullname }}</span>
@endadminaccessroutename
