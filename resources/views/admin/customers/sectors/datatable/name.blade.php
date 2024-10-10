@adminaccessroutename('admin.customer_sector.edit')
    <a href="{{ route('admin.customer_sector.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
