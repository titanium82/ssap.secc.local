@adminaccessroutename('admin.admin.edit')
    <a href="{{ route('admin.admin.edit', $id) }}">{{ $fullname }}</a>
@elseadminaccessroutename
    <span>{{ $fullname }}</span>
@endadminaccessroutename
