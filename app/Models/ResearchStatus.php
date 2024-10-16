<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchStatus extends Model
{
    use HasFactory;

     /**
     * The attributes that are NOT mass assignable. 
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
