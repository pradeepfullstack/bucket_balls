<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ball extends Model
{
    protected $fillable = ['name', 'size', 'color'];

    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }

}
