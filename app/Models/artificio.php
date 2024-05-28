<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artificio extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'artificio'];

    public function stocks()
    {
        return $this->hasMany(stock::class, 'artificio_id');
    }

    public function retiros()
    {
        return $this->hasMany(retiro::class, 'artificio_id');
    }
}
   

