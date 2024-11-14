@adminaccessroutename('admin.contract.edit')
    <a href="{{ route('admin.contract.edit', $contract_id) }}">{{ $contract['short_name'] ?? null }}</a>
@elseadminaccessroutename
    <span>{{ $contract['short_name'] ?? null }}</span>
@endadminaccessroutename
