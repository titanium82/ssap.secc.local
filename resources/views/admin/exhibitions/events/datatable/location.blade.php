@if($exhibition_location_id)
    @adminaccessroutename('admin.exhibition_location.edit')
        <a href="{{ route('admin.exhibition_location.edit', $exhibition_location_id) }}">{{ $exhibitionlocation['name'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $exhibitionlocation['name'] ?? '' }}</span>
    @endadminaccessroutename
@endif
