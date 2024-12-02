@adminaccessroutename('admin.electrical_equipment.edit')
    <a href="{{ route('admin.electrical_equipment.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
