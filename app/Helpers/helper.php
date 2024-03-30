<?php

use App\Models\ProductCategory;

function getCategories(){
    return ProductCategory::orderByRaw("name='dog' DESC")
                        ->orderByRaw("name='cat' DESC")
                        ->orderBy('name', 'ASC')
                        ->with('sub_category')
                        ->orderBy('id','DESC')
                        ->where('status',1)
                        ->where('showHome','Yes')
                        ->get();
}
?>