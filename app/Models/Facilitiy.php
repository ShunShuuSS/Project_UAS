<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilitiy extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'id_facility',
        'name'
    ];
}
