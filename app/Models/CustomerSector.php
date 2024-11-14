<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSector extends Model
{
    use HasFactory;

    protected $table = 'customer_sectors';

    protected $fillable = [
        'name',
        'position'
    ];
    
}
