<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetImage extends Model
{
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
