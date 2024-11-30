@adminaccessroutename('admin.warehouse.edit')
    <a href="{{ route('admin.warehouse.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
