@adminaccessroutename('admin.role.edit')
    <a href="{{ route('admin.role.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
