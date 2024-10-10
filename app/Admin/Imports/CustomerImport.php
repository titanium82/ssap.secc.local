<?php

namespace App\Admin\Imports;

use App\Core\Enums\Gender;
use App\Models\Customer;

class CustomerImport extends BaseImport
{
    public function model(array $row)
    {
        if(count(array_filter($row)) > 0)
        {
            $adminId = auth('admin')->id();
        
            return new Customer([
                'admin_id' => $adminId,
                'fullname' => $row['company_name'],
                'shortname' => $row['shortname'],
                'phone' => $row['tel'],
                'gender' => Gender::Male,
                'fax' => $row['fax'],
                'email' => $row['email'],
                'taxcode' => $row['mst'],
                'address' => $row['address'],
                'address_vat' => $row['address_vat'],
                'delegate' => $row['delegate'],
                'website' => $row['website'],
                'note' => $row['note']
            ]);
        }
    }
}