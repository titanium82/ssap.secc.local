@adminaccessroutename('admin.electrical_equipment.edit')
    <a href="{{ route('admin.electrical_equipment.edit', $id) }}">{{ $price }}</a>
@elseadminaccessroutename
    <span>{{ $price }}</span>
@endadminaccessroutename
