<?php

return [
    [
        'title' => 'Dashboard',
        'route_name' => 'admin.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'sub' => []
    ],
    [
        'title' => 'Contracts',
        'route_name' => '',
        'icon' => '<i class="ti ti-file-text"></i>',
        'sub' => [
            [
                'title' => 'Add',
                'route_name' => 'admin.contract.create',
                'icon' => '<i class="ti ti-plus"></i>'
            ],
            [
                'title' => 'List',
                'route_name' => 'admin.contract.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Contract Payment',
                'route_name' => 'admin.contract_payment.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Contract Type',
                'route_name' => 'admin.contract_type.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],

        ]
    ],
    [
        'title' => 'Customers',
        'route_name' => '',
        'icon' => '<i class="ti ti-users"></i>',
        'sub' => [
            [
                'title' => 'Add',
                'route_name' => 'admin.customer.create',
                'icon' => '<i class="ti ti-plus"></i>'
            ],
            [
                'title' => 'List',
                'route_name' => 'admin.customer.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Contact',
                'route_name' => 'admin.customer_contact.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Customer Type',
                'route_name' => 'admin.customer_type.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Customer Sector',
                'route_name' => 'admin.customer_sector.index',
                'icon' => '<i class="ti ti-list"></i>'
            ]
        ]
    ],
    [
        'title' => 'Exhibition',
        'route_name' => '',
        'icon' => '<i class="ti ti-image-in-picture"></i>',
        'sub' => [

            [
                'title' => 'Exhibition Event',
                'route_name' => 'admin.exhibition_event.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Exhibition Calendar',
                'route_name' => '',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Exhibition Location',
                'route_name' => 'admin.exhibition_location.index',
                'icon' => '<i class="ti ti-list"></i>'
            ]
        ]
    ],
    [
        'title' => 'Services',
        'route_name' => '',
        'icon' => '<i class="ti ti-image-in-picture"></i>',
        'sub' => [

            [
                'title' => 'Order Event Services',
                'route_name' => '',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Event Services',
                'route_name' => 'admin.event_service.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Event Service Type',
                'route_name' => 'admin.event_service_type.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Event Services Unit',
                'route_name' => 'admin.event_service_unit.index',
                'icon' => '<i class="ti ti-list"></i>'
            ]
        ]
    ],
    [
        'title' => 'Admins',
        'route_name' => '',
        'icon' => '<i class="ti ti-user"></i>',
        'sub' => [
            [
                'title' => 'add',
                'route_name' => 'admin.admin.create',
                'icon' => '<i class="ti ti-plus"></i>'
            ],
            [
                'title' => 'list',
                'route_name' => 'admin.admin.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Department',
                'route_name' => 'admin.department.index',
                'icon' => '<i class="ti ti-list"></i>'
            ]
        ]
    ],
    [
        'title' => 'Roles And Permissions',
        'route_name' => '',
        'icon' => '<i class="ti ti-shield-lock"></i>',
        'sub' => [
            [
                'title' => 'Roles',
                'route_name' => 'admin.role.index',
                'icon' => '<i class="ti ti-list"></i>'
            ],
            [
                'title' => 'Permissions',
                'route_name' => 'admin.permission.index',
                'icon' => '<i class="ti ti-list"></i>'
            ]
        ]
    ]
];
