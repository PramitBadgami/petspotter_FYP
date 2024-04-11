<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favouritelist extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'pet_id'];

    public function pet() {
        return $this->belongsTo(Pet::class);
    }
}
