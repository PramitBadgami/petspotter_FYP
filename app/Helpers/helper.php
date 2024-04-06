<?php

use App\Models\ProductCategory;
use App\Models\PetCategory;

function getCategories(){
    return ProductCategory::orderByRaw("name='dog products' DESC")
                        ->orderByRaw("name='cat products' DESC")
                        ->orderBy('name', 'ASC')
                        ->with('sub_category')
                        ->orderBy('id','DESC')
                        ->where('status',1)
                        ->where('showHome','Yes')
                        ->get();
}

function getPetCategories(){
    return PetCategory::orderByRaw("name='dogs' DESC")
                        ->orderByRaw("name='cats' DESC")
                        ->orderBy('name', 'ASC')
                        ->orderBy('id','DESC')
                        ->where('status',1)
                        ->where('showHome','Yes')
                        ->get();
}
?>