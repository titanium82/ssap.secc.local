@adminaccessroutename('admin.contract_type.edit')
    <a href="{{ route('admin.contract_type.edit', $contract_type_id) }}">{{ $type['name'] }}</a>
@elseadminaccessroutename
    <span>{{ $type['name'] }}</span>
@endadminaccessroutename
