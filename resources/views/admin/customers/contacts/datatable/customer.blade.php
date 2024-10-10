@adminaccessroutename('admin.customer.edit')
    @if ($admin_id === auth('admin')->id() || auth('admin')->user()->checkIsSuperAdmin()  || auth('admin')->user()->managerCustomer())
        <a href="{{ route('admin.customer.edit', $customer_id) }}">{{ $customer['fullname'] }}</a>
    @else
        <span>{{ $customer['fullname'] }}</span>
    @endif
@elseadminaccessroutename
    <span>{{ $customer['fullname'] }}</span>
@endadminaccessroutename
