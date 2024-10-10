<?php

namespace App\Models;

use App\Core\Enums\Gender;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'admin_id',
        'customer_type_id',
        'fullname',
        'shortname',
        'phone',
        'gender',
        'fax',
        'email',
        'taxcode',
        'logo',
        'address',
        'address_vat',
        'delegate',
        'website',
        'files',
        'note'
    ];

    protected function casts(): array
    {
        return [
            'files' => AsArrayObject::class,
            'gender' => Gender::class
        ];
    }

    public function isCreator()
    {
        return $this->admin_id === auth('admin')->id();
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function sectors(): BelongsToMany
    {
        return $this->belongsToMany(CustomerSector::class, 'customers_to_sectors', 'customer_id', 'sector_id');
    }

    public function type()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id');
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
