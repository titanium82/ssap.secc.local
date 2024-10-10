<div class="d-flex gap-1 flex-wrap">
    @foreach ($sectors as $sector)
        <span class="badge bg-blue">{{ $sector['name'] ?? '' }}</span>
    @endforeach
</div>
