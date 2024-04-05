<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public function pet_images()
    {
        return $this->hasMany(PetImage::class);
    }
}
