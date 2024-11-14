@if($customer_type_id)
    @adminaccessroutename('admin.customer_type.edit')
        <a href="{{ route('admin.customer_type.edit', $customer_type_id) }}">{{ $type['name'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $type['name'] ?? '' }}</span>
    @endadminaccessroutename
@endif