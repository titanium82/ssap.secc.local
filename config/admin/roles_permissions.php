<?php

use App\Admin\Enums\Role\RoleManager;

return [
    'cache_name' => 'admin-role-permission-',

    'route_name_prefix' => 'admin.',

    //Loai bo cac route khong duoc ap dung
    'whitelist_routes_name' => [
        'admin.ckfinder.browser',
        'admin.ckfinder.connector',
        'admin.logout',
        'admin.password.update',
        'admin.password.change',
        'admin.profile.update',
        'admin.profile.index',
        'admin.dashboard',
        'admin.login.index',
        'admin.login.handle',
        'admin.home',
        'admin.notification.show',
        'admin.admin.search_select'
    ],
    RoleManager::class => [
        RoleManager::Contract->name => [
            'admin.contract.index',
            'admin.contract.create',
            'admin.contract.store',
            'admin.contract.update',
            'admin.contract.show',
            'admin.contract.edit',
            'admin.contract.delete',
            'admin.contract_payment.index',
            'admin.contract_payment.create',
            'admin.contract_payment.store',
            'admin.contract_payment.edit',
            'admin.contract_payment.show',
            'admin.contract_payment.update',
            'admin.contract_payment.delete',
            'admin.contract_payment.accept',
            'admin.contract_payment.upload_license',
            'admin.contract_payment.handle_upload_license',
            'admin.contract_type.index',
            'admin.contract_type.create',
            'admin.contract_type.store',
            'admin.contract_type.edit',
            'admin.contract_type.update',
            'admin.contract_type.delete',
            'admin.customer.search_select',
            'admin.contract.payment_send_email',
            'admin.contract.handle_payment_send_email',
            'admin.contract.share',
            'admin.contract.handle_share',
            'admin.contract.search_select'

        ],
        RoleManager::Customer->name => [
            'admin.customer.index',
            'admin.customer.create',
            'admin.customer.store',
            'admin.customer.update',
            'admin.customer.edit',
            'admin.customer.show',
            'admin.customer.render_contact_dt',
            'admin.customer.render_contract_dt',
            'admin.customer.delete',
            'admin.customer.search_select',
            'admin.customer_contact.index',
            'admin.customer_contact.create',
            'admin.customer_contact.store',
            'admin.customer_contact.update',
            'admin.customer_contact.edit',
            'admin.customer_contact.delete',
            'admin.customer_sector.index',
            'admin.customer_sector.create',
            'admin.customer_sector.store',
            'admin.customer_sector.update',
            'admin.customer_sector.edit',
            'admin.customer_sector.delete',
            'admin.customer_type.index',
            'admin.customer_type.create',
            'admin.customer_type.store',
            'admin.customer_type.update',
            'admin.customer_type.edit',
            'admin.customer_type.delete',
        ]
    ]
];