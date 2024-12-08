@if($customer_id)
    @adminaccessroutename('admin.customer.edit')
        <a href="{{ route('admin.customer.edit', $customer_id) }}">{{ $customer['short_name'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $customer['short_name'] ?? '' }}</span>
    @endadminaccessroutename
@endif
