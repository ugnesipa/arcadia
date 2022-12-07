<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//model for plant
class Plant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'climate_id', 'origin', 'description'];
    //protected $guarded = [];

    //one climate to many plants collection
    public function climate()
    {
        return $this->belongsTo(Climate::class);

    }

}
