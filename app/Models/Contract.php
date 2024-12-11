<?php

namespace App\Models;

use App\Admin\Enums\Contract\ContractPaymentMethod;
use App\Admin\Enums\Contract\ContractStatus;
use App\Observers\ContractObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#[ObservedBy([ContractObserver::class])]
class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'code',
        'admin_id',
        'contract_type_id',
        'customer_id',
        'currency_id',
        'name',
        'short_name', //Bổ sung thêm tên viết tắt cho tên triển lãm.
        'status',
        'day_begin',
        'day_end',
        'total_amount',
        'sub_total_amount',
        'deposit',
        'payment_method',
        'annex',
        'files',
        'note'
    ];

    protected function casts(): array
    {
        return [
            'day_begin'             => 'date',
            'day_end'               => 'date',
            'total_amount'          => 'double',
            'sub_total_amount'      => 'double',
            'deposit'               => 'double',
            'status'                => ContractStatus::class,
            'payment_method'        => ContractPaymentMethod::class,
            'annex'                 => AsArrayObject::class,
            'files'                 => AsArrayObject::class
        ];
    }
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'annex' => '[]',
        'files' => '[]'
    ];

    public function statusValid()
    {
        return now()->lessThan($this->day_end);
    }

    public function canShare()
    {
        return $this->isCreator() || auth('admin')->user()->checkIsSuperAdmin() || auth('admin')->user()->managerCustomer();
    }

    public function isCreator()
    {
        return $this->admin_id === auth('admin')->id();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function type()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function payments()
    {
        return $this->hasMany(ContractPayment::class, 'contract_id')->orderBy('period', 'asc');
    }

    public function exhibitionLocations()
    {
        return $this->belongsToMany(ExhibitionLocation::class, 'contracts_exhibition_locations', 'contract_id', 'exhibition_location_id');
    }

    public function sectors()
    {
        return $this->belongsToMany(CustomerSector::class, 'contracts_to_sectors', 'contract_id', 'sector_id');
    }

    public function sharers()
    {
        return $this->belongsToMany(Admin::class, 'contracts_share_admins', 'contract_id', 'admin_id');
    }

    public function scopeCurrentAuth($q)
    {
        $auth = auth('admin')->user();

        if($auth->managerContract() == false && $auth->checkIsSuperAdmin() == false)
        {
            $q->where(function($query) use($auth) {

                $query->where('admin_id', $auth->id)
                ->orWhereHas('sharers', fn($q) => $q->where('admins.id', $auth->id));
            });
        }
    }
}
