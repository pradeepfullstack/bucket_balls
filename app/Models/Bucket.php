<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $fillable = ['name', 'capacity'];

    public function balls()
    {
        return $this->hasMany(Ball::class);
    }
}
