@adminaccessroutename('admin.warehouse.edit')
    <a href="{{ route('admin.warehouse.edit', $id) }}">{{ $short_name }}</a>
@elseadminaccessroutename
    <span>{{ $short_name }}</span>
@endadminaccessroutename
