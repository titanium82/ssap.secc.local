@if($department_id)
    @adminaccessroutename('admin.department.edit')
        <a href="{{ route('admin.department.edit', $department_id) }}">{{ $departments['shortname'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $departments['shortname'] ?? '' }}</span>
    @endadminaccessroutename
@endif
