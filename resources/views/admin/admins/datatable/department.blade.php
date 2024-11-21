@if($department_id)
    @adminaccessroutename('admin.department.edit')
        <a href="{{ route('admin.department.edit', $department_id) }}">{{ $department['name'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $department['name'] ?? '' }}</span>
    @endadminaccessroutename
@endif
