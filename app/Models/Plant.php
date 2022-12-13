<?php

namespace App\Models;

use App\Models\Climate;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

//model for plant
class Plant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'climate_id', 'origin', 'description'];
    //protected $guarded = [];

    //one climate to many plants relationship definition
    public function climate()
    {
        return $this->belongsTo(Climate::class);
    }

    //many to many relationship definition
    public function categories()
    {
        return $this->belongstoMany(Category::class)->withTimestamps();
    }
}
