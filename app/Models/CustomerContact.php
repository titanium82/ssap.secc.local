<?php

namespace App\Models;

use App\Core\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    use HasFactory;

    protected $table = 'customer_contacts';

    protected $fillable = [
        'admin_id',
        'customer_id',
        'fullname',
        'phone',
        'phone_second',
        'phone_third',
        'phone',
        'email',
        'adddress',
        'avatar',
        'birthday',
        'gender',
        'position',
        'desc'
    ];

    protected function casts(): array
    {
        return [
            'gender' => Gender::class
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function scopeCurrentAuth($q)
    {
        $auth = auth('admin')->user();
        if(!$auth->managerContract() && !$auth->checkIsSuperAdmin())
        {
            $q->where('admin_id', $auth->id);
        }
    }
}
