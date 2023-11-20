<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $fillable = ['name', 'capacity'];

    // Relationship: One-to-Many with Ball (Each bucket has many balls)
    public function balls()
    {
        return $this->hasMany(Ball::class);
    }
}
