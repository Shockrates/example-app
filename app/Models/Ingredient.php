<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    /**
     * The attributes that are NOT mass assignable. 
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    //protected $hidden = ['pivot'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_ingredients')
        ->withPivot('quantity')
        ->withTimestamps();;
    }
}
