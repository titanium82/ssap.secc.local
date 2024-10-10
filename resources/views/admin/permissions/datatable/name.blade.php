@adminaccessroutename('admin.permission.edit')
    <a href="{{ route('admin.permission.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
