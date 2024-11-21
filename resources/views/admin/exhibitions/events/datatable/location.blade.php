<div class="d-flex gap-1 flex-wrap">
    @foreach ($exhibitionlocations as $exhibitionlocation)
        <span class="badge bg-blue">{{ $exhibitionlocation['fullname'] ?? '' }}</span>
    @endforeach
</div>
