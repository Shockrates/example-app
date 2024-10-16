<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * The attributes that are NOT mass assignable. 
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'manufacturing_date' => 'datetime',
        'expiration_date' => 'datetime',
    ];

    protected $hidden = ['pivot'];
    
    public function researchStatus(){
        return $this->belongsTo(ResearchStatus::class, 'research_status_id', 'id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'products_ingredients')
        ->withPivot('quantity')
        ->withTimestamps();
    }

    // Override the toArray() method to include only the status name
    public function toArray()
    {
        $array = parent::toArray();
        $array['research_status'] = $this->researchStatus ? $this->researchStatus->name : null;
        return $array;
    }

}
