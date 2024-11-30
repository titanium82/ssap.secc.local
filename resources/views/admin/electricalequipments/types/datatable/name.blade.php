@adminaccessroutename('admin.electrical_equipment_type.edit')
    <a href="{{ route('admin.electrical_equipment_type.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
