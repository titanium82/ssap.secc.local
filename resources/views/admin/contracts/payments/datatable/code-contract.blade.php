@adminaccessroutename('admin.contract.edit')
    <a href="{{ route('admin.contract.edit', $contract_id) }}">{{ $contract['code'] ?? null }}</a>
@elseadminaccessroutename
    <span>{{ $contract['code'] ?? null }}</span>
@endadminaccessroutename
