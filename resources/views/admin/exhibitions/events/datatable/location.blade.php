@if($exhibition_location_id)
    @adminaccessroutename('admin.exhibition_location.edit')
        <a href="{{ route('admin.exhibition_location.edit', $exhibition_location_id) }}">{{ $exhibitionlocation['fullname'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $exhibitionlocation['fullname'] ?? '' }}</span>
    @endadminaccessroutename
@endif
