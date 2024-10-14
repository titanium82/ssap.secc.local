@adminaccessroutename('admin.event_service_type.edit')
    <a href="{{ route('admin.event_service_type.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
