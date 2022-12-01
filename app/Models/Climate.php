<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//model for climate
class Climate extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];
    //protected $guarded = [];
}
