@adminaccessroutename('admin.contract.edit')
    <a href="{{ route('admin.contract.edit', $id) }}">{{ $short_name }}</a>
@elseadminaccessroutename
    <span>{{ $contract['short_name'] }}</span>
@endadminaccessroutename
