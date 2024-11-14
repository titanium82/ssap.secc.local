@adminaccessroutename('admin.customer.edit')
    <a href="{{ route('admin.customer.edit', $customer_id) }}">{{ $customer['fullname'] }}</a>
@elseadminaccessroutename
    <span>{{ $customer['fullname'] }}</span>
@endadminaccessroutename
