@adminaccessroutename('admin.event_service_unit.edit')
    <a href="{{ route('admin.event_service_unit.edit', $id) }}">{{ $unit }}</a>
@elseadminaccessroutename
    <span>{{ $unit }}</span>
@endadminaccessroutename
