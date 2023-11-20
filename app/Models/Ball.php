<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ball extends Model
{
    protected $fillable = ['name', 'size', 'color'];

    // Relationship: One-to-Many with Bucket (Each ball belongs to a bucket)
    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }

}
