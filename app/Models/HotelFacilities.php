<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelFacilities extends Model
{
    use HasFactory;

    protected $table = 'hotel_facilities';

    protected $fillable = [
        'id_hotel',
        'facilities'
    ];
}
