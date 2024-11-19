<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionLocation extends Model
{
    use HasFactory;

    protected $table = 'exhibition_locations';

    protected $fillable = [
        'admin_id',
        'fullname',
        'stretch',
        'location',
        'classroom',
        'theater',
        'screen_projector',
        'screen_backdrop',
        'sound',
        'light',
        'wifi',
        'air_conditioner',
        'screen_backdrop',
        'desc'
    ];
}
