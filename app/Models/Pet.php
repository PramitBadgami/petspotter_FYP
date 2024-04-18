<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = ['name','slug', 'description', 'short_description', 'related_pets', 'age', 'adoption_status', 'adoption_date', 'category_id ', 'breed_id', 'is_featured','gender', 'status'];


    public function pet_images()
    {
        return $this->hasMany(PetImage::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
