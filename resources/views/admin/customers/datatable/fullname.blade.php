@adminaccessroutename('admin.customer.edit')
    @if ($admin_id === auth('admin')->id() || auth('admin')->user()->checkIsSuperAdmin()  || auth('admin')->user()->managerCustomer())
        <a href="{{ route('admin.customer.edit', $id) }}">{{ $fullname }}</a>
    @else
        <span>{{ $fullname }}</span>
    @endif
@elseadminaccessroutename
    <span>{{ $fullname }}</span>
@endadminaccessroutename
