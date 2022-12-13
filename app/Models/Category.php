<?php

namespace App\Models;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

//model for category
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];
    //protected $guarded = [];

    //many to many plants realtionship definition
    public function plants()
    {
        return $this->belongstoMany(Plant::class)->withTimestamps();

    }
}
