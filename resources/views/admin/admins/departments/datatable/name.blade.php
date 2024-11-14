@adminaccessroutename('admin.department.edit')
    <a href="{{ route('admin.department.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
