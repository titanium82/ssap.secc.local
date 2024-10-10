<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'username' => 'admin',
            'fullname' => 'Ssap Admin',
            'email' => 'admin@gmail.com',
            'status' => 1,
            'is_superadmin' => true,
            'password' => '123456'
        ]);

        DB::insert("INSERT INTO `permissions` (`id`, `name`, `route_names`, `created_at`, `updated_at`) VALUES
            (6, 'Thêm, Xóa, Sửa, DS loại HĐ', '[\"admin.contract_type.index\",\"admin.contract_type.create\",\"admin.contract_type.store\",\"admin.contract_type.update\",\"admin.contract_type.edit\",\"admin.contract_type.delete\"]', '2024-05-25 13:23:45', '2024-05-25 13:28:53'),
            (7, 'Thêm, xem và úp chứng từ đợt TT HĐ', '[\"admin.contract.search_select\",\"admin.contract_payment.index\",\"admin.contract_payment.create\",\"admin.contract_payment.store\",\"admin.contract_payment.show\"]', '2024-05-25 13:28:05', '2024-05-25 13:28:05'),
            (8, 'Thêm, xem, DS HĐ', '[\"admin.contract.index\",\"admin.contract.create\",\"admin.contract.store\",\"admin.contract.show\",\"admin.customer.search_select\"]', '2024-05-25 13:34:41', '2024-05-25 13:46:41'),
            (10, 'Sửa, Xóa, Duyệt đợt TT HĐ', '[\"admin.contract_payment.update\",\"admin.contract_payment.accept\",\"admin.contract_payment.edit\",\"admin.contract_payment.delete\"]', '2024-05-25 13:37:52', '2024-05-25 13:37:52'),
            (11, 'Sửa, Xóa HĐ', '[\"admin.contract.update\",\"admin.contract.edit\",\"admin.contract.delete\"]', '2024-05-25 13:38:53', '2024-05-25 13:38:53'),
            (12, 'Gửi mail đợt TT HĐ', '[\"admin.contract.payment_send_email\",\"admin.contract.handle_payment_send_email\"]', '2024-05-25 13:39:11', '2024-05-25 13:39:11'),
            (13, 'Thêm, xóa, sửa, DS Lĩnh vực KH', '[\"admin.customer_sector.index\",\"admin.customer_sector.create\",\"admin.customer_sector.store\",\"admin.customer_sector.update\",\"admin.customer_sector.edit\",\"admin.customer_sector.delete\"]', '2024-05-25 13:48:14', '2024-05-25 13:48:14'),
            (14, 'Thêm, xóa, sửa, DS loại KH', '[\"admin.customer_type.index\",\"admin.customer_type.create\",\"admin.customer_type.store\",\"admin.customer_type.update\",\"admin.customer_type.edit\",\"admin.customer_type.delete\"]', '2024-05-25 13:48:31', '2024-05-25 13:48:31'),
            (15, 'Thêm, xóa, sửa, DS LH KH', '[\"admin.customer.search_select\",\"admin.customer_contact.index\",\"admin.customer_contact.create\",\"admin.customer_contact.store\",\"admin.customer_contact.update\",\"admin.customer_contact.edit\",\"admin.customer_contact.delete\"]', '2024-05-25 13:49:08', '2024-05-25 13:49:08'),
            (16, 'Thêm, xem, DS KH', '[\"admin.customer.index\",\"admin.customer.create\",\"admin.customer.store\",\"admin.customer.show\",\"admin.customer.render_contact_dt\",\"admin.customer.render_contract_dt\"]', '2024-05-25 13:51:00', '2024-05-25 13:51:00'),
            (17, 'Sửa KH', '[\"admin.customer.update\",\"admin.customer.edit\"]', '2024-05-25 13:51:37', '2024-05-25 13:51:37'),
            (18, 'Xóa KH', '[\"admin.customer.delete\"]', '2024-05-25 13:51:46', '2024-05-25 13:51:46'),
            (19, 'upload Chứng từ đợt TT HĐ', '[\"admin.contract_payment.upload_license\",\"admin.contract_payment.handle_upload_license\"]', '2024-05-25 14:40:06', '2024-05-25 14:40:06')"
        );
    }
}
