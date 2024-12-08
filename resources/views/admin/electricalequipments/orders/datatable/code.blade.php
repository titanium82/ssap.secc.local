@adminaccessroutename('admin.electrical_equipment_order.edit')
    <a href="{{ route('admin.electrical_equipment_order.edit', $id) }}">{{ $code }}</a>
@elseadminaccessroutename
    <span>{{ $code }}</span>
@endadminaccessroutename
