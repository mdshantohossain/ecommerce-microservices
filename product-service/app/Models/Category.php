<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = [];

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

    public  function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
