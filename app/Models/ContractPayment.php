<?php

namespace App\Models;

use App\Admin\Enums\Contract\ContractPaymentStatus;
use App\Observers\ContractPaymentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#[ObservedBy([ContractPaymentObserver::class])]
class ContractPayment extends Model
{
    use HasFactory;

    protected $table = 'contract_payments';

    protected $fillable = [
        'admin_id',
        'contract_id',
        'contract_shortname',
        'expired_at',
        'period',
        'amount',
        'status',
        'license',
        'approved_by',
        'license_files', // bổ sung upload chứng từ thanh toán dạng file
        'file_send_mail'
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'date',
            'period' => 'integer',
            'amount' => 'double',
            'status' => ContractPaymentStatus::class,
            'license' => AsArrayObject::class,
            'license_files' => AsArrayObject::class
        ];
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'license' => '[]',
        'license_files'=> '[]'
    ];

    public function canUploadLicense()
    {
        return $this->status == ContractPaymentStatus::Unpaid || $this->status == ContractPaymentStatus::Late;
    }

    public function getEmailCustomer(): string|null
    {
        return optional(optional($this->contract)->customer)->email;
    }

    public function sharers()
    {
        return $this->belongsToMany(Admin::class, 'contract_payments_share_admins', 'contract_payment_id', 'admin_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function unpaid()
    {
        return $this->status == ContractPaymentStatus::Unpaid;
    }

    public function paid()
    {
        return $this->status == ContractPaymentStatus::Paid;
    }

    public function canAccept()
    {
        return !$this->paid() && $this->license?->count();
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

    public function scopeUnpaid($q)
    {
        $q->where('status', ContractPaymentStatus::Unpaid);
    }

    public function scopeLate($q, $status_wrong = false)
    {
        if($status_wrong)
        {
            $q->unpaid();
        }
        $q->whereDate('expired_at', '<', now());
    }
}
