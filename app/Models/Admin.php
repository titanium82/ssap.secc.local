<?php

namespace App\Models;

use App\Admin\Enums\Role\RoleManager;
use App\Admin\Supports\Authorization\AccessRoute;
use App\Admin\Supports\Authorization\Manager;
use App\Core\Enums\Gender;
use App\Observers\AdminObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([AdminObserver::class])]
class Admin extends Authenticatable
{
    use HasFactory, Notifiable, AccessRoute, Manager;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'username',
        'fullname',
        'phone',
        'email',
        'birthday',
        'gender',
        'avatar',
        'status',
        'birthday',
        'is_superadmin',
        'access_route_names',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_superadmin' => 'boolean',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gender' => Gender::class,
            'access_route_names'=> AsArrayObject::class
        ];
    }

    public function contractPaymentShares()
    {
        return $this->belongsToMany(ContractPayment::class, 'contract_paymens_share_admins', 'admin_id', 'contract_payment_id');
    }

    public function contractShares()
    {
        return $this->belongsToMany(Contract::class, 'contracts_share_admins', 'admin_id', 'contract_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'admin_has_roles', 'admin_id', 'role_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'admin_has_permissions', 'admin_id', 'permission_id');
    }
    public function departments():BelongsTo
    {
        return $this->belongsTo(Department::class, foreignKey:'department_id');
    }

    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['fullname'] ?: $attributes['username'] ?: $attributes['email']
        );
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value ?: config('core.images.avatar'))
        );
    }

    public function getRoleNames()
    {
        if($this->checkIsSuperAdmin())
        {
            return trans('Super Admin');
        }

        $roles = $this->loadMissing(['roles'])->roles;

        return implode(', ', $roles->pluck('name')->toArray());
    }

    public function scopeManager($q, RoleManager $manager)
    {
        $q->whereJsonContains('access_route_names', $this->getConfigManager($manager));
    }
}
