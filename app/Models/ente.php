<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\retiro;

class ente extends Model
{
    use HasFactory;

    public function retiros()
    {
        return $this->hasMany(retiro::class, 'ente_id');
    }
}
