<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ball extends Model
{
    protected $fillable = ['color', 'size', 'bucket_id'];

    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }
}
