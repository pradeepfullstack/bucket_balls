<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'ball_id',
        'bucket_id',
    ];

    public function ball()
    {
        return $this->belongsTo(Ball::class);
    }

    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }
}
