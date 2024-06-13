<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'movie_title',
        'poster',
        'seatArrangement',
        'seats_booked',
        'total_amount',
        'payment_method',
    ];
}
