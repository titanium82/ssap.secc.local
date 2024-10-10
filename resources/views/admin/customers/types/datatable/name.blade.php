@adminaccessroutename('admin.customer_type.edit')
    <a href="{{ route('admin.customer_type.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
