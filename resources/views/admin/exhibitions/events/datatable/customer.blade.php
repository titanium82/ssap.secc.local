@if($customer_id)
    @adminaccessroutename('admin.customer.edit')
        <a href="{{ route('admin.customer.edit', $customer_id) }}">{{ $customer['shortname'] ?? '' }}</a>
    @elseadminaccessroutename
        <span>{{ $customer['shortname'] ?? '' }}</span>
    @endadminaccessroutename
@endif
