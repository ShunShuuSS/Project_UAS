<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'id_booking',
        'id_hotel',
        'id_user',
        'name',
        'phonenumber',
        'email',
        'check_in',
        'check_out',
        'total_room',
        'price'
    ];
}
