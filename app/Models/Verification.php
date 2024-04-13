<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Verification extends Model
{
    use HasFactory;

    public function verification_images() {
        return $this->hasMany(VerificationImage::class);
    }

    protected $primaryKey = "id";

    protected $table = 'verifications';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
