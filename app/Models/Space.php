<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price_per_day',
        'is_available',
        'category_id'
    ];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_space');
    // }

    public function owner()
    {
        return $this->hasOne(Booking::class)->latestOfMany('created_at');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_space', 'space_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
