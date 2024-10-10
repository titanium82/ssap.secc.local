@adminaccessroutename('admin.contract.edit')
    <a href="{{ route('admin.contract.edit', $id) }}">{{ $code }}</a>
@elseadminaccessroutename
    <span>{{ $code }}</span>
@endadminaccessroutename
