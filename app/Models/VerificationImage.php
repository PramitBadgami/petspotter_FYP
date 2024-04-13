<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationImage extends Model
{
    use HasFactory;
    
    public function verification()
    {
        return $this->belongsTo(Verification::class);
    }
}
