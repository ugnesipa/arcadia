<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Climate extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function plants() {
        return $this->hasMany(Plant::class);
    }
}
