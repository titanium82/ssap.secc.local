<?php

return [
    'contract' => [
        'code' => [
            'title' => 'Contract Code',
            'orderable' => true,
        ],
        'name' => [
            'title' => 'Contract Name',
            'orderable' => false,
        ],
        'short_name' => [
            'title' => 'Contract Short Name',
            'orderable' => false,
        ],
        'contract_type_id' => [
            'title' => 'Contract Type',
            'orderable' => false,
        ],
        'customer_id' => [
            'title' => 'Customer',
            'orderable' => false,
        ],
        'status' => [
            'title' => 'Status',
            'orderable' => false,
        ],
        'admin_id' => [
            'title' => 'Created by',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'contract_payment' => [
        'contract_id' => [
            'title' => 'Contract Code',
            'orderable' => true,
        ],
        'contract_short_name' => [
            'title' => 'Contract Short Name',
            'orderable' => false,
            'width' => '200px',
        ],
        'period' => [
            'title' => 'Period',
            'orderable' => false,
            'width' => '100px',
        ],
        'amount' => [
            'title' => 'Amount',
            'orderable' => false,
        ],
        'expired_at' => [
            'title' => 'Expired at',
            'orderable' => false,
        ],
        'status' => [
            'title' => 'Status',
            'orderable' => false,
        ],
        'admin_id' => [
            'title' => 'Created by',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'exhibition_location' => [
        'fullname' => [
            'title' => 'Exhibition Location Name',
            'orderable' => false,
            'width' => '200px',
        ],
        'stretch' => [
            'title' => 'Exhibition Location Stretch',
            'orderable' => false,
            'width' => '100px',

        ],
        'location' => [
            'title' => 'Exhibition Location Area',
            'orderable' => false,
            'width' => '200px',

        ],
        'classroom' => [
            'title' => 'Exhibition Location Classroom',
            'orderable' => false,
            'width' => '200px',

        ],
        'theater' => [
            'title' => 'Exhibition Location Theater',
            'orderable' => false,
            'width' => '200px',

        ],
        'screen_backdrop' => [
            'title' => 'Screen Backdrop',
            'orderable' => false,
            'width' => '100px',

        ],
        'screen_projector' => [
            'title' => 'Screen Projector',
            'orderable' => false,
            'width' => '100px',

        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'exhibition_event' => [
        'name' => [
            'title' => 'Exhibition Event Name',
            'orderable' => false,
            'width' => '200px',
        ],
        'shortname' => [
            'title' => 'Exhibition Event Short Name',
            'orderable' => false,
            'width' => '100px',

        ],
        'exhibitionlocations' => [
            'title' => 'Exhibition Location Area',
            'orderable' => false,
            'width' => '250px',

        ],
        'customer_id' => [
            'title' => 'Customer',
            'orderable' => false,
            'width' => '150px',

        ],
        'day_begin' => [
            'title' => 'Exhibition Event Day Begin',
            'orderable' => false,
            'width' => '180px',

        ],
        'day_end' => [
            'title' => 'Exhibition Event Day End',
            'orderable' => false,
            'width' => '180px',

        ],
        'status' => [
            'title' => 'Status',
            'orderable' => false,
            'addClass' => 'text-center'
        ],
        'event_manager' => [
            'title' => 'Event Manager',
            'orderable' => false,
            'width' => '200px',

        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'admin_id' => [
            'title' => 'Created by',
            'orderable' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'contract_type' => [
        'name' => [
            'title' => 'Contract Type Name',
            'orderable' => false,
        ],
        'short_name' => [
            'title' => 'Short name',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'customer' => [
        'fullname' => [
            'title' => 'Fullname Customer',
            'orderable' => false,
            'width' => '300px',
        ],
        'shortname' => [
            'title' => 'Shortname Customer',
            'orderable' => false,
            'width' => '200px',
        ],
        'email' => [
            'title' => 'Email',
            'orderable' => false,
        ],
        'phone' => [
            'title' => 'Phone',
            'orderable' => false,
        ],
        'customer_type_id' => [
            'title' => 'Customer Type',
            'orderable' => false,
        ],
        'sectors' => [
            'title' => 'Customer Sector',
            'orderable' => false,
            'width' => '800px',
        ],
        'admin_id' => [
            'title' => 'Created by',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'customer_contact' => [
        'fullname' => [
            'title' => 'Fullname Contact',
            'orderable' => false,
        ],
        'email' => [
            'title' => 'Email',
            'orderable' => false,
        ],
        'phone' => [
            'title' => 'Phone',
            'orderable' => false,
        ],
        'birthday' => [
            'title' => 'Birthday',
            'orderable' => false,
        ],
        'gender' => [
            'title' => 'Gender',
            'orderable' => false,
        ],
        'position' => [
            'title' => 'Position',
            'orderable' => false,
        ],
        'customer_id' => [
            'title' => 'Customer',
            'orderable' => false,
        ],
        'admin_id' => [
            'title' => 'Created by',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'customer_sector' => [
        'name' => [
            'title' => 'Customer Sector Name',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'customer_type' => [
        'name' => [
            'title' => 'Customer Type Name',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'event_service' => [
        'name' => [
            'title' => 'Event Service Name',
            'orderable' => false,
        ],
        'event_service_type_id' => [
            'title' => 'Event Service Types',
            'orderable' => false,
            'width' => '400px',
        ],
        'desc' => [
            'title' => 'Event Service Desc',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'event_service_unit' => [
        'event_service_type_id' => [
            'title' => 'Event Service Types',
            'orderable' => true,
            'width' => '300px',
        ],
        'name' => [
            'title' => 'Event Service Name',
            'orderable' => false,
            'width' => '400px',
        ],
        'unit' => [
            'title' => 'Event Service Unit',
            'orderable' => false,
            'width' => '100px',
        ],
        'desc' => [
            'title' => 'Event Service Unit Desc',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'event_service_type' => [
        'name' => [
            'title' => 'Event Service Type Name',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'electrical_equipment_type' => [
        'name' => [
            'title' => 'Electrical Equipment Type Name',
            'orderable' => false,
        ],
        'desc' => [
            'title' => 'Electrical Equipment Type Desc',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'warehouse'=>[
        'name' => [
            'title' => 'name',
            'orderable' => false,
        ],
        'shortname' => [
            'title' => 'shortname',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'role' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'permission' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'department'=>[
        'name' => [
            'title' => 'name',
            'orderable' => false,
        ],
        'shortname' => [
            'title' => 'shortname',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'admin' => [
        'fullname' => [
            'title' => 'fullname',
            'orderable' => false,
        ],
        'phone' => [
            'title' => 'phone',
            'orderable' => false,
            'width'=>'200px',
        ],
        'email' => [
            'title' => 'email',
            'orderable' => false,
        ],
        'gender' => [
            'title' => 'Gender',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
        ],
        'department_id' => [
            'title' => 'Department',
            'orderable' => false,
            'width'=>'300px',
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
];
