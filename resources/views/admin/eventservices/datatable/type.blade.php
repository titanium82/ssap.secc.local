@if($event_service_type_id)
    @adminaccessroutename('admin.event_service_type.edit')
        <a href="{{ route('admin.event_service_type.edit', $event_service_type_id) }}">{{ $type['name'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $type['name'] ?? '' }}</span>
    @endadminaccessroutename
@endif
