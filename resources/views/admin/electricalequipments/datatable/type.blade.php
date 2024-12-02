@if($electrical_equipment_type_id)
    @adminaccessroutename('admin.electrical_equipment_type.edit')
        <a href="{{ route('admin.electrical_equipment_type.edit', $electrical_equipment_type_id) }}">{{ $type['name'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $type['name'] ?? '' }}</span>
    @endadminaccessroutename
@endif
