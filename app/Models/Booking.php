<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $fillable = [
        'rental_name',
        'booking_date',
        'status'
    ];
}
