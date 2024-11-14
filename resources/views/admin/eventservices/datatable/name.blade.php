@adminaccessroutename('admin.event_service.edit')
    <a href="{{ route('admin.event_service.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
