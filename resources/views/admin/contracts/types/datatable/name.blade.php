@adminaccessroutename('admin.contract_type.edit')
    <a href="{{ route('admin.contract_type.edit', $id) }}">{{ $name }}</a>
@elseadminaccessroutename
    <span>{{ $name }}</span>
@endadminaccessroutename
