@adminaccessroutename('admin.electrical_equipment_order.edit')
    <a href="{{ route('admin.electrical_equipment_order.edit', $id) }}">{{ $booth_no }}</a>
@elseadminaccessroutename
    <span>{{ $booth_no }}</span>
@endadminaccessroutename
