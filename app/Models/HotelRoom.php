<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $table = 'hotel_room';

    protected $fillable = [
        'id_hotel_room',
        'id_hotel',
        'id_room_type',
        'price'
    ];
}
