<?php

namespace App\Models;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Climate extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function plants() {
        return $this->hasMany(Plant::class);
    }
}
