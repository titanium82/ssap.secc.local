@adminaccessroutename('admin.warehouse.edit')
    <a href="{{ route('admin.warehouse.edit', $id) }}">{{ $shortname }}</a>
@elseadminaccessroutename
    <span>{{ $shortname }}</span>
@endadminaccessroutename
