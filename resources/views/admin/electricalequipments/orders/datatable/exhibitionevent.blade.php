@if($exhibition_event_id)
    @adminaccessroutename('admin.exhibition_event.edit')
        <a href="{{ route('admin.exhibition_event.edit', $exhibition_event_id) }}">{{ $exhibitionevent['short_name'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $exhibitionevent['short_name'] ?? '' }}</span>
    @endadminaccessroutename
@endif
